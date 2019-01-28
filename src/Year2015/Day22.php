<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use Mzentrale\AdventOfCode\Year2015\Day22\Boss;
use Mzentrale\AdventOfCode\Year2015\Day22\Wizard;

class Day22 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->winBattle([50, 500], $this->parseInput($input));
    }

    public function part2(string $input)
    {
        return $this->winBattle([50, 500], $this->parseInput($input), 1);
    }

    public function winBattle(array $playerStats, array $bossStats, int $pointsLost = 0): int
    {
        $min = 999999;
        $fights = [[0, new Wizard(...$playerStats), new Boss(...$bossStats), []]];
        while ($fights) {
            [$spent, $player, $boss] = array_pop($fights);

            $player->hitPoints -= $pointsLost; // For part 2
            $player->effects($boss);

            $spells = $this->spells($player, min($player->getMana(), $min - $spent));
            foreach ($spells as list($spell, $cost)) {
                $_player = clone $player;
                $_boss   = clone $boss;

                $_player->cast($spell, $cost, $_boss);
                $_player->effects($_boss);
                if ($_boss->hitPoints <= 0) {
                    $min = min($min, $spent + $cost);
                    continue;
                }

                $_boss->attack($_player);
                if ($_player->hitPoints > 0) {
                    $fights[] = [$spent + $cost, $_player, $_boss];
                }
            }
        }
        return $min;
    }

    private function spells(Wizard $wizard, int $maxCost): array
    {
        $spells = [
            ['Magic Missile', 53],
            ['Drain', 73],
            ['Shield', 113],
            ['Poison', 173],
            ['Recharge', 229],
        ];

        return array_filter($spells, function (array $spell) use ($wizard, $maxCost) {
            return !in_array($spell[0], $wizard->getActiveSpells()) && $spell[1] < $maxCost;
        });
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            return (int) explode(': ', $line)[1];
        }, explode(PHP_EOL, trim($input)));
    }
}
