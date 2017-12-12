<?php

namespace Mzentrale\AdventOfCode;

class Day4 implements Puzzle
{
    public function checkPassphrase($passphrase)
    {
        $parts = preg_split('#\s+#', $passphrase);
        return count($parts) === count(array_unique($parts));
    }

    public function countUnique($passprases)
    {
        return count(array_filter(explode(PHP_EOL, trim($passprases)), [$this, 'checkPassphrase']));
    }

    public function solve($input)
    {
        return $this->countUnique($input);
    }
}
