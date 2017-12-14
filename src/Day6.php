<?php

namespace Mzentrale\AdventOfCode;

class Day6 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->debug(preg_split('#\s+#', trim($input)));
    }

    public function part2(string $input)
    {
        return $this->getLoopSize(preg_split('#\s+#', trim($input)));
    }

    public function solve($input)
    {
        return $this->debug(preg_split('#\s+#', trim($input)));
    }

    public function next(array $blocks)
    {
        $blocks           = array_values($blocks);
        $numBlocks        = count($blocks);
        $highest          = $this->highest($blocks);
        $distribute       = $blocks[$highest];
        $blocks[$highest] = 0;

        for ($i = $highest + 1; $distribute > 0; $distribute--) {
            $blocks[$i++ % $numBlocks] += 1;
        }

        return $blocks;
    }

    public function highest(array $blocks)
    {
        return array_search(max($blocks), $blocks);
    }

    public function debug(array $blocks): int
    {
        return $this->getLoopDetails($blocks)[0];
    }

    public function getLoopSize(array $blocks): int
    {
        return $this->getLoopDetails($blocks)[1];
    }

    private function hash(array $blocks): string
    {
        return md5(implode(' ', $blocks));
    }

    private function getLoopDetails(array $blocks): array
    {
        $i = 1;
        $c = [$this->hash($blocks) => $i];
        for ($blocks = $this->next($blocks), $hash = $this->hash($blocks); !array_key_exists($hash, $c); $i++) {
            $c[$hash] = $i;
            $blocks   = $this->next($blocks);
            $hash     = $this->hash($blocks);
        }

        return [$i, $i - $c[$hash]];
    }
}
