<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day9 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->calculateScore($input);
    }

    public function part2(string $input)
    {
        return $this->countGarbage(trim($input));
    }

    public function removeGarbage(string $stream, bool $includeEnclosures = true)
    {
        return preg_replace('#<([^>]*)>#', $includeEnclosures ? '' : '<>', $this->removeCancelled($stream));
    }

    public function countGroups(string $stream): int
    {
        return array_sum($this->getGroups($stream));
    }

    public function calculateScore(string $stream): int
    {
        $groups = $this->getGroups(trim($stream));
        return array_sum(array_map(function ($level, $count) {
            return $level * $count;
        }, array_keys($groups), array_values($groups)));
    }

    public function countGarbage(string $stream): int
    {
        return strlen($this->removeCancelled($stream)) - strlen($this->removeGarbage($stream, false));
    }

    private function getGroups(string $stream): array
    {
        $stream = preg_replace('#[^{}]#', '', $this->removeGarbage($stream));
        $groups = [];
        $level  = 1;
        foreach (str_split($stream) as $char) {
            switch ($char) {
                case '{':
                    $groups[$level] = ($groups[$level] ?? 0) + 1;
                    $level          += 1;
                    break;
                case '}':
                    $level -= 1;
                    break;
            }
        }
        return $groups;
    }

    private function removeCancelled(string $stream): string
    {
        return preg_replace('#(!.)#', '', $stream);
    }
}
