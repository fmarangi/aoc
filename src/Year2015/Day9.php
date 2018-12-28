<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day9 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getShortestDistance($input);
    }

    public function part2(string $input)
    {
        return $this->getLongestDistance($input);
    }

    public function getShortestDistance(string $input): int
    {
        $distances = $this->parseInput($input);
        $routes    = $this->getRoutes(array_keys($distances));
        return min(array_map($this->getDistance($distances), $routes));
    }

    public function getLongestDistance(string $input): int
    {
        $distances = $this->parseInput($input);
        $routes    = $this->getRoutes(array_keys($distances));
        return max(array_map($this->getDistance($distances), $routes));
    }

    public function getRoutes(array $places): array
    {
        $routes = [];
        foreach ($places as $place) {
            $routes = $routes ? array_merge(...array_map($this->addPlace($place), $routes)) : [[$place]];
        }
        return $routes;
    }

    private function getDistance(array $distances): callable
    {
        return function (array $route) use ($distances): int {
            return array_sum(array_map(function (int $i) use ($distances, $route) {
                return $distances[$route[$i]][$route[$i + 1]];
            }, range(0, count($route) - 2)));
        };
    }

    private function addPlace(string $place): callable
    {
        return function (array $route) use ($place): array {
            return array_map(function (int $i) use ($route, $place) {
                return array_merge(array_slice($route, 0, $i), [$place], array_slice($route, $i));
            }, range(0, count($route)));
        };
    }

    private function parseInput(string $input): array
    {
        return array_reduce(explode(PHP_EOL, trim($input)), function (array $result, string $line) {
            list($from, $to, $distance) = sscanf($line, '%s to %s = %d');
            $result[$from][$to] = $distance;
            $result[$to][$from] = $distance;
            return $result;
        }, []);
    }
}
