<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day11 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getNext(trim($input));
    }

    public function part2(string $input)
    {
        return $this->getNext($this->part1($input));
    }

    public function increment(string $password): string
    {
        $rest = substr($password, 0, -1);
        $char = (ord($password{-1}) - 96) % 26 + 97;
        switch ($char) {
            case 97:
                $rest = $rest ? $this->increment($rest) : $rest;
                break;
            case 105:
            case 108:
            case 111:
                $char += 1;
                break;
        }
        return $rest . chr($char);
    }

    public function getNext(string $password): string
    {
        for ($next = $this->increment($password); !$this->isValid($next); $next = $this->increment($next)) {
            continue;
        }
        return $next;
    }

    public function isValid(string $password): bool
    {
        return $this->hasStraight($password) && $this->hasDouble($password) && !$this->hasForbidden($password);
    }

    private function hasStraight(string $password): bool
    {
        for ($i = 0, $p = $password, $max = strlen($p) - 2; $i < $max; $i++) {
            if (ord($p{$i}) + 1 === ord($p{$i + 1}) && ord($p{$i + 1}) + 1 === ord($p{$i + 2})) return true;
        }
        return false;
    }

    private function hasDouble(string $password): bool
    {
        preg_match_all('#(\w)\1#', $password, $m);
        return count(array_unique($m[1] ?? [])) >= 2;
    }

    private function hasForbidden(string $password): bool
    {
        return preg_match('#[ilo]#', $password) > 0;
    }
}
