<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day17 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->findShortestPath(trim($input));
    }

    public function part2(string $input)
    {
        return $this->findLongestPath(trim($input));
    }

    public function findShortestPath(string $passcode): string
    {
        return array_reduce($this->paths($passcode), function (string $result, string $path) {
            return $result && strlen($result) < strlen($path) ? $result : $path;
        }, '');
    }

    public function findLongestPath(string $passcode): int
    {
        return max(array_map('strlen', $this->paths($passcode)));
    }

    private function paths(string $passcode, int $goal = 15): array
    {
        $next  = $this->next($passcode);
        $paths = [['', 0]];
        $found = [];
        while ($paths) {
            list($path, $current) = array_pop($paths);
            foreach ($next($path, $current) as list($dir, $room)) {
                $nextPath = $path . $dir;
                if ($room === $goal) {
                    $found[] = $nextPath;
                    continue;
                }
                $paths[] = [$nextPath, $room];
            }
        }
        return $found;
    }

    private function next(string $passcode): callable
    {
        return function (string $path, int $room) use ($passcode): array
        {
            $codes = str_split(substr(md5($passcode . $path), 0, 4));
            return array_filter($this->getDoors($room), function (int $door) use ($codes): bool {
                return ord($codes[$door]) > 97;
            }, ARRAY_FILTER_USE_KEY);
        };
    }

    private function getDoors(int $room): array
    {
        $row   = (int) floor($room / 4) * 4;
        $doors = [
            ['U', $room - 4],
            ['D', $room + 4],
            ['L', $room - 1],
            ['R', $room + 1],
        ];
        return array_filter($doors, function (array $data) use ($row): bool {
            $lr = $data[1] - $row !== -1 && $data[1] - $row !== 4;
            return $data[1] >= 0 && $data[1] <= 15 && (in_array($data[0], ['L', 'R']) ? $lr : true);
        });
    }
}
