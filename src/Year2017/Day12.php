<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day12 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->countConnected($input);
    }

    public function part2(string $input)
    {
        return $this->countGroups($input);
    }

    public function countConnected(string $input): int
    {
        return count($this->findNewConnections(0, $this->parseInput($input)));
    }

    public function countGroups(string $input): int
    {
        for ($groups = 0, $programs = $this->parseInput($input); !empty($programs); $groups++) {
            foreach (array_keys($this->findNewConnections(array_keys($programs)[0], $programs)) as $program) {
                unset($programs[$program]);
            }
        }
        return $groups;
    }

    private function findNewConnections(int $program, array $map, array $found = []): array
    {
        if (!isset($found[$program])) {
            $found[$program] = true;
        }
        foreach ($map[$program] as $connection) {
            if (!isset($found[$connection])) {
                $found = $this->findNewConnections($connection, $map, $found);
            }
        }
        return $found;
    }

    private function parseInput(string $input): array
    {
        return array_merge([], ...array_map(function ($line) {
            list ($program, $connected) = explode('<->', $line);
            return [trim($program) => array_map('trim', explode(',', $connected))];
        }, explode(PHP_EOL, trim($input))));
    }
}
