<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day4 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getSectors($input);
    }

    public function part2(string $input)
    {
        foreach (explode(PHP_EOL, trim($input)) as $room) {
            preg_match('#([a-z-]+?)-([0-9]+)\[([a-z]+)\]#', $room, $matches);
            list(, $name, $sector) = $matches;
            if ($this->decrypt($name, $sector) === 'northpole object storage') {
                return (int) $sector;
            }
        }
    }

    public function isValid(string $room): bool
    {
        preg_match('#([a-z-]+?)-(?:[0-9]+)\[([a-z]+)\]#', $room, $matches);
        list(, $name, $checksum) = $matches;
        return $this->getChecksum($name) === $checksum;
    }

    private function getChecksum(string $name): string
    {
        $counts = array_combine(range('a', 'z'), array_fill(0, 26, 0));
        for ($i = 0, $num = strlen($name); $i < $num; $i++) {
            if ($name{$i} !== '-') {
                $counts[$name{$i}] += 1;
            }
        }

        $result = [];
        foreach (array_filter($counts) as $letter => $num) {
            $result[$num] = ($result[$num] ?? '') . $letter;
        }
        krsort($result);
        return substr(implode('', $result), 0, 5);
    }

    private function getSection(string $room): int
    {
        preg_match('#-([0-9]+)\[#', $room, $matches);
        return $matches[1] ?? 0;
    }

    public function getSectors(string $input): int
    {
        $rooms = explode(PHP_EOL, trim($input));
        $rooms = array_filter($rooms, [$this, 'isValid']);
        return array_sum(array_map([$this, 'getSection'], $rooms));
    }

    public function decrypt(string $name, int $sector): string
    {
        $sector %= 26;
        for ($i = 0, $num = strlen($name); $i < $num; $i++) {
            $replace  = $name{$i} !== '-' ? chr(((ord($name{$i}) + $sector - 97) % 26) + 97) : ' ';
            $name{$i} = $replace;
        }
        return $name;
    }
}
