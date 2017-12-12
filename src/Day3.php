<?php

namespace Mzentrale\AdventOfCode;

class Day3 implements Puzzle
{
    public function distance(int $square): int
    {
        if ($square === 1) {
            return 0;
        }

        $diameter = $this->getDiameter($square);
        $rel      = ($square - pow($diameter - 2, 2)) % ($diameter - 1);
        $radius   = floor($diameter / 2);
        return $radius + abs($rel - $radius);
    }

    public function solve($input)
    {
        return $this->distance($input);
    }

    private function getDiameter($square)
    {
        return ceil(sqrt($square)) | 1;
    }
}
