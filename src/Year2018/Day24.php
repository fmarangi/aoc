<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day24 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getCombatOutcome($input);
    }

    public function part2(string $input)
    {
        $units = $this->parseInput($input);
        $boost = 1;
        while (true) {
            try {
                $winningArmy = $this->fight($units, $boost);
                if (current($winningArmy)[0] === 'Immune System') {
                    return array_sum(array_column($winningArmy, 1));
                }
            } catch (\Exception $e) {
                // Tie, continue...
            }
            $boost++;
        }
        return -1;
    }

    public function getCombatOutcome(string $input, int $boost = 0): int
    {
        $units = $this->parseInput($input);
        return array_sum(array_column($this->fight($units, $boost), 1));
    }

    private function fight(array $units, int $boost): array
    {
        for ($i = 0, $count = count($units); $i < $count; $i++) {
            if ($units[$i][0] === 'Immune System') $units[$i][5] += $boost;
        }

        while (!$this->isOver($units)) {
            $loop = true;
            foreach ($this->getTargets($units) as $j => $k) {
                if ($k < 0 || $units[$j][1] <= 0) continue;
                $killed       = min($units[$k][1], intdiv($this->getDamage($units[$j], $units[$k]), $units[$k][2]));
                $units[$k][1] -= $killed;
                if ($killed > 0) $loop = false;
            }

            if ($loop) throw new \Exception('Tie');
            $units = array_filter($units, function (array $unit): bool {
                return $unit[1] > 0;
            });
        }
        return $units;
    }

    private function getDamage(array $attacker, array $defender): int
    {
        [$attack, $power] = [$attacker[6], $this->getEffectivePower($attacker)];
        return in_array($attack, $defender[3]) ? -1 : $power * (in_array($attack, $defender[4]) ? 2 : 1);
    }

    private function isOver(array $units): bool
    {
        $armies = array_column($units, 0);
        return count(array_unique($armies)) === 1;
    }

    private function getTargets(array $units): array
    {
        uasort($units, function (array $a, array $b): int {
            return $this->getEffectivePower($b) - $this->getEffectivePower($a) ?: $b[7] - $a[7];
        });

        $chosen = [];
        foreach ($units as $i => $unit) {
            $chosen[$i] = $this->selectTarget($units, $unit, $chosen);
        }

        ksort($chosen);
        return $chosen;
    }

    private function selectTarget(array $units, array $attacker, array $chosen): int
    {
        $enemies = array_filter($units, function (array $unit) use ($attacker): bool {
            return $unit[0] !== $attacker[0];
        });

        $targets = [];
        foreach ($enemies as $i => $unit) {
            $damage = $this->getDamage($attacker, $unit);
            if (in_array($i, $chosen) || $damage < 0) continue;
            $targets[] = [$damage, $this->getEffectivePower($unit), $unit[7], $i];
        }

        usort($targets, function (array $a, array $b): int {
            return $b[0] - $a[0] ?: $b[1] - $a[1] ?: $b[2] - $a[2];
        });

        $target = current($targets);
        return $target ? $target[3] : -1;
    }

    private function getEffectivePower(array $unit): int
    {
        return $unit[1] * $unit[5];
    }

    private function parseInput(string $input): array
    {
        $groups = explode(PHP_EOL . PHP_EOL, trim($input));

        $units = [];
        foreach ($groups as $group) {
            $lines = explode(PHP_EOL, $group);
            $army  = trim($lines[0], ':');
            for ($i = 1, $max = count($lines); $i < $max; $i++) {
                $unit = [$army];
                preg_match('#(\d+) units each with (\d+) hit points#', $lines[$i], $match);
                array_push($unit, ...array_slice($match, 1));

                preg_match('#immune to (.+?)(?:;|\))#', $lines[$i], $match);
                array_push($unit, array_filter(explode(', ', $match[1] ?? '')));

                preg_match('#weak to (.+?)(?:;|\))#', $lines[$i], $match);
                array_push($unit, array_filter(explode(', ', $match[1] ?? '')));

                preg_match('#with an attack that does (\d+) (\w+) damage at initiative (\d+)#', $lines[$i], $match);
                array_push($unit, ...array_slice($match, 1));

                $units[] = $unit;
            }
        }

        usort($units, function (array $a, array $b): int {
            return $b[7] - $a[7];
        });
        return $units;
    }
}
