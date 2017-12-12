<?php

namespace Mzentrale\AdventOfCode;

class Day6 implements Puzzle
{
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

    public function debug(array $blocks)
    {
        $c = [$this->hash($blocks) => true];

        $i = 1;
        for ($blocks = $this->next($blocks), $hash = $this->hash($blocks); !array_key_exists($hash, $c); $i++) {
            $c[$hash] = true;
            $blocks   = $this->next($blocks);
            $hash     = $this->hash($blocks);
        }

        return $i;
    }

    private function hash(array $blocks): string
    {
        return md5(implode(' ', $blocks));
    }
}
