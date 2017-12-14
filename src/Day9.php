<?php

namespace Mzentrale\AdventOfCode;

class Day9 implements Puzzle
{
    public function solve($input)
    {
        return $this->calculateScore($input);
    }

    public function removeGarbage(string $stream)
    {
        return preg_replace('#(<[^>]*>)#', '', preg_replace('#(!.)#', '', $stream));
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
}
