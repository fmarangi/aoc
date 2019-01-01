<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day13 implements Puzzle
{
    /** @var array */
    private $offset = [[0, -1], [1, 0], [0, 1], [-1, 0]];

    public function part1(string $input)
    {
        return $this->findShortestPath(31, 39, trim($input), 100);
    }

    public function part2(string $input)
    {
        return $this->findLocations(trim($input), 50);
    }

    public function findShortestPath(int $x, int $y, int $favourite, int $max = 20): int
    {
        $isOpenSpace = $this->isOpenSpace($favourite);

        $found = [];
        $paths = [["1,1"]];
        while ($paths) {
            $path = array_pop($paths);
            foreach ($this->next(sscanf($path[count($path) - 1], '%d,%d'), $isOpenSpace) as $next) {
                if ($next[0] === $x && $next[1] === $y) {
                    $found[] = array_merge($path, [implode(',', $next)]);
                    continue;
                }

                if (!in_array(implode(',', $next), $path) && count($path) < $max) {
                    $paths[] = array_merge($path, [implode(',', $next)]);
                }
            }
        }

        return min(array_map('count', $found)) - 1;
    }

    public function findLocations(int $favourite, int $steps): int
    {
        $isOpenSpace = $this->isOpenSpace($favourite);

        $visited = ['1,1'];
        $paths   = [$visited];
        while ($paths) {
            $path = array_pop($paths);
            foreach ($this->next(sscanf($path[count($path) - 1], '%d,%d'), $isOpenSpace) as $next) {
                if (in_array(implode(',', $next), $path)) {
                    continue;
                }

                if (!in_array(implode(',', $next), $visited)) {
                    $visited[] = implode(',', $next);
                }

                $newPath = array_merge($path, [implode(',', $next)]);
                if (count($newPath) <= $steps) {
                    $paths[] = $newPath;
                }

            }
        }

        return count($visited);
    }

    private function next(array $position, callable $filter): array
    {
        return array_filter(array_map(function (array $offset) use ($position): array {
            return [$position[0] + $offset[0], $position[1] + $offset[1]];
        }, $this->offset), $filter);
    }

    private function isOpenSpace(int $favourite): callable
    {
        return function (array $position) use ($favourite): bool {
            list($x, $y) = $position;
            $bin = decbin(($x + 3) * $x + ($y + 1) * $y + 2 * $x * $y + $favourite);
            return substr_count($bin, '1') % 2 === 0 && $x >= 0 && $y >= 0;
        };
    }
}
