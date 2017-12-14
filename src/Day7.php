<?php

namespace Mzentrale\AdventOfCode;

class Day7 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->findBottom($input);
    }

    public function part2(string $input)
    {
        return $this->findWrong($input);
    }

    public function findWrong($input)
    {
        $lines = $this->parseLines($input);
        return $this->checkHierarchy($this->getBottomTower($lines), array_column($lines, 1, 0), array_column($lines, 2, 0));
    }

    public function findBottom($input)
    {
        return $this->getBottomTower($this->parseLines($input));
    }

    public function parse(string $line): array
    {
        $pattern = '#([a-z]+) \(([0-9]+)\)(?: -> (.+))?#i';
        if (preg_match($pattern, $line, $m)) {
            return [trim($m[1]), array_filter(array_map('trim', explode(',', $m[3] ?? ''))), (int) $m[2]];
        }
        return [];
    }

    private function parseLines(string $input): array
    {
        return array_map([$this, 'parse'], explode(PHP_EOL, trim($input)));
    }

    private function checkHierarchy(string $tower, array $subs, array $weights)
    {
        $stacks = [];
        foreach ($subs[$tower] as $child) {
            $stacks[$this->getWeight($child, $subs, $weights)][] = $child;
        }

        if (count($stacks) <= 1) {
            throw new \Exception('All balanced');
        }

        uasort($stacks, function ($a, $b) {
            return count($a) <=> count($b);
        });

        $diff  = array_keys($stacks)[0] - array_keys($stacks)[1];
        $wrong = array_values($stacks)[0][0];

        try {
            return $this->checkHierarchy($wrong, $subs, $weights);
        } catch (\Exception $e) {
            return $weights[$wrong] - $diff;
        }
    }

    private function getBottomTower(array $lines): string
    {
        $children = array_merge(...array_column($lines, 1));
        $parents  = array_values(array_diff(array_column($lines, 0), $children));
        return $parents[0] ?? '';
    }

    private function getHierarchy(string $tower, array $subs)
    {
        return array_merge_recursive([$tower], ...array_map(function ($tower) use ($subs) {
            return $this->getHierarchy($tower, $subs);
        }, $subs[$tower]));
    }

    private function getWeight(string $tower, array $hierarchy, array $weights)
    {
        return array_sum(array_map(function ($tower) use ($weights) {
            return $weights[$tower] ?? 0;
        }, $this->getHierarchy($tower, $hierarchy)));
    }
}
