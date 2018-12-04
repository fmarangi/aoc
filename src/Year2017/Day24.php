<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day24 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getStrength($this->getStrongestBridge($input));
    }

    public function part2(string $input)
    {
        return $this->getStrength($this->getLongetBrige($input));
    }

    public function getStrength(array $components): int
    {
        return array_sum(explode('/', implode('/', $components)));
    }

    public function getStrongestBridge(string $input, string $start = '0'): array
    {
        $bridges  = $this->getBridges(explode(PHP_EOL, $input), $start);
        $strength = array_map([$this, 'getStrength'], $bridges);
        return $bridges[array_search(max($strength), $strength)];
    }

    public function getLongetBrige(string $input, string $start = '0'): array
    {
        $bridges  = $this->getBridges(explode(PHP_EOL, $input), $start);
        $max      = max(array_map('count', $bridges));
        $longest  = array_filter($bridges, function (array $bridge) use ($max) {
            return count($bridge) === $max;
        });
        $strength = array_map([$this, 'getStrength'], $longest);
        return $longest[array_search(max($strength), $strength)];
    }

    private function getBridges(array $components, string $start): array
    {
        $next = [];
        foreach ($components as $component) {
            if (in_array($start, explode('/', $component))) {
                $next[] = $component;
            }
        }

        $bridges = [];
        foreach ($next as $component) {
            $others = array_filter($components, function (string $other) use ($component) {
                return $component != $other;
            });
            $ports  = explode('/', $component);
            unset($ports[array_search($start, $ports)]);
            $subs = $this->getBridges($others, implode('', $ports));
            foreach ($subs as $bridge) {
                $bridges[] = array_merge([$component], $bridge);
            }
            if (!$subs) $bridges[] = [$component];
        }

        return $bridges;
    }
}
