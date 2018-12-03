<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day21 implements Puzzle
{
    /** @var string */
    private $initial;

    public function __construct(string $initial)
    {
        $this->initial = $initial;
    }

    public function part1(string $input)
    {
        return $this->getPixelCount($this->enhance($input, 5));
    }

    public function part2(string $input)
    {
        return $this->getPixelCount($this->enhance($input, 18));
    }

    public function getNumericValue(string $image, string $delimiter = "\n"): int
    {
        return bindec(strtr(str_replace($delimiter, '', $image), '.#', '01'));
    }

    public function rotate(string $image): string
    {
        $cells  = array_map('str_split', explode("\n", $image));
        $rotate = array_map(function (int $column) use ($cells) {
            return array_reverse(array_column($cells, $column));
        }, array_keys($cells[0]));
        return implode("\n", array_map('implode', array_fill(0, count($rotate), ''), $rotate));
    }

    public function flip(string $image): string
    {
        return implode("\n", array_map('strrev', explode("\n", $image)));
    }

    public function getAllValues(string $image): array
    {
        $values = [];
        for ($i = 0; $i < 4; $i++) {
            $values[] = $this->getNumericValue($image);
            $values[] = $this->getNumericValue($this->flip($image));
            $image    = $this->rotate($image);
        }
        return array_values(array_unique($values));
    }

    public function getPixelCount(string $image): int
    {
        return strlen($image) - strlen(str_replace('#', '', $image));
    }

    public function parseRules(string $rules): array
    {
        return array_reduce(explode("\n", trim($rules)), function (array $result, string $rule): array {
            list($from, $to) = explode(' => ', str_replace('/', "\n", $rule));
            $size = $this->getSize($from);
            foreach ($this->getAllValues($from) as $value) {
                $result[$size][$value] = $to;
            }
            return $result;
        }, []);
    }

    public function enhance(string $rules, int $iterations): string
    {
        $image = $this->initial;
        $rules = $this->parseRules($rules);
        for ($i = 0; $i < $iterations; $i++) {
            $parts = array_map(function (string $part) use ($rules) {
                return $rules[$this->getSize($part)][$this->getNumericValue($part)];
            }, $this->split($image));
            $image = $this->join($parts);
        }
        return $image;
    }

    private function getSize(string $image): int
    {
        return strpos($image, "\n");
    }

    public function split(string $image): array
    {
        $size    = $this->getSize($image);
        $side    = $size % 2 === 0 ? 2 : 3;
        $squares = pow($size / $side, 2);
        $result  = array_fill(0, pow($size / $side, 2), '');
        foreach (explode("\n", $image) as $j => $row) {
            $chunks = str_split($row, $side);
            foreach ($chunks as $k => $chunk) {
                $square          = $k + floor($j / $side) * sqrt($squares);
                $result[$square] .= "\n" . $chunk;
            }
        }
        return array_map('trim', $result);
    }

    public function join(array $parts): string
    {
        $side = sqrt(count($parts));
        $size = $this->getSize($parts[0] ?? '');
        $rows = array_fill(0, $size * $side, '');
        foreach ($parts as $j => $part) {
            $row = floor($j / $side) * $size;
            foreach (explode("\n", $part) as $k => $rowPart) {
                $rows[$row + $k] .= $rowPart;
            }
        }
        return implode("\n", $rows);
    }
}
