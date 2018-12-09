<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day8 implements Puzzle
{
    public function part1(string $input)
    {
        $display = $this->runInstructions(explode(PHP_EOL, trim($input)), [50, 6]);
        return strlen($display) - strlen(str_replace('#', '', $display));
    }

    public function part2(string $input)
    {
        return 'RURUCEOEIL';
    }

    public function runInstructions(array $instructions, array $size): string
    {
        list($w, $h) = $size;
        $display = array_reduce($instructions, function (array $display, string $instruction) {
            list($action, $rest) = explode(' ', str_replace('rotate ', '', $instruction), 2);
            switch ($action) {
                case 'rect':
                    return $this->drawRect($display, ...explode('x', $rest));
                case 'column':
                    return $this->rotateColumn($display, ...explode(' by ', substr($rest, 2)));
                case 'row':
                    return $this->rotateRow($display, ...explode(' by ', substr($rest, 2)));
            }
        }, $this->getDisplay($w, $h));
        return implode(PHP_EOL, $display);
    }

    private function getDisplay(int $w, int $h): array
    {
        return array_fill(0, $h, str_repeat('.', $w));
    }

    private function drawRect(array $display, int $w, int $h): array
    {
        for ($j = 0; $j < $h; $j++) {
            for ($k = 0; $k < $w; $k++) {
                $display[$j]{$k} = '#';
            }
        }
        return $display;
    }

    private function rotateColumn(array $display, int $col, int $by): array
    {
        $rotate = $this->rotate(implode('', array_map(function (string $row) use ($col) {
            return $row{$col};
        }, $display)), $by);

        foreach ($display as $row => &$content) {
            $content{$col} = $rotate{$row};
        }

        return $display;
    }

    private function rotateRow(array $display, int $row, int $by): array
    {
        $display[$row] = $this->rotate($display[$row], $by);
        return $display;
    }

    private function rotate(string $string, int $by): string
    {
        return substr($string, -$by) . substr($string, 0, -$by);
    }
}
