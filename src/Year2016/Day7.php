<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day7 implements Puzzle
{
    public function part1(string $input)
    {
        $ips = explode(PHP_EOL, trim($input));
        return count(array_filter($ips, [$this, 'supportsTls']));
    }

    public function part2(string $input)
    {
        $ips = explode(PHP_EOL, trim($input));
        return count(array_filter($ips, [$this, 'supportsSsl']));
    }

    public function isAbba(string $part): bool
    {
        for ($i = 0, $max = strlen($part) - 3; $i < $max; $i++) {
            if ($this->checkAbba(substr($part, $i, 4))) {
                return true;
            }
        }
        return false;
    }

    private function checkAbba(string $part): bool
    {
        return $part{0} === $part{3} && $part{1} === $part{2} && $part{0} !== $part{1};
    }

    public function supportsTls(string $ip): bool
    {
        preg_match_all('#\[([a-z]+)\]#', $ip, $brackets);
        if ($brackets) {
            $ip = str_replace($brackets[0], ' ', $ip);
            foreach ($brackets[1] as $bracket) {
                if ($this->isAbba($bracket)) {
                    return false;
                }
            }
        }
        return $this->isAbba($ip);
    }

    public function supportsSsl(string $ip): bool
    {
        $brackets = [];
        preg_match_all('#\[([a-z]+)\]#', $ip, $match);
        if ($match) {
            $ip       = str_replace($match[0], ' ', $ip);
            $brackets = $match[1];
        }
        for ($i = 0, $max = strlen($ip) - 2; $i < $max; $i++) {
            if ($this->isAba(substr($ip, $i, 3))) {
                foreach ($brackets as $bracket) {
                    if (strpos($bracket, $this->getBab(substr($ip, $i, 3))) !== false) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function isAba(string $part): bool
    {
        return $part{0} === $part{2} && $part{0} !== $part{1};
    }

    public function getBab(string $aba): string
    {
        return $aba{1} . $aba{0} . $aba{1};
    }
}
