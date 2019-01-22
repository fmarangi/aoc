<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day21 implements Puzzle
{
    private $items = [
        'weapon' => [
            'Dagger'     => [8, 4, 0],
            'Shortsword' => [10, 5, 0],
            'Warhammer'  => [25, 6, 0],
            'Longsword'  => [40, 7, 0],
            'Greataxe'   => [74, 8, 0],
        ],

        'armor' => [
            'Leather'    => [13, 0, 1],
            'Chainmail'  => [31, 0, 2],
            'Splintmail' => [53, 0, 3],
            'Bandedmail' => [75, 0, 4],
            'Platemail'  => [102, 0, 5],
        ],

        'rings' => [
            'Damage +1'  => [25, 1, 0],
            'Damage +2'  => [50, 2, 0],
            'Damage +3'  => [100, 3, 0],
            'Defense +1' => [20, 0, 1],
            'Defense +2' => [40, 0, 2],
            'Defense +3' => [80, 0, 3],
        ],
    ];

    public function part1(string $input)
    {
        $boss = $this->parseInput($input);
        return array_reduce($this->items(), function (int $result, array $equipment) use ($boss) {
            $player = $this->player($equipment);
            return $this->fight($player, $boss) === $player ? min($result, $player[3]) : $result;
        }, 99999);
    }

    public function part2(string $input)
    {
        $boss = $this->parseInput($input);
        return array_reduce($this->items(), function (int $result, array $equipment) use ($boss) {
            $player = $this->player($equipment);
            return $this->fight($player, $boss) === $boss ? max($result, $player[3]) : $result;
        }, 0);
    }

    public function fight(array $a, array $b): array
    {
        [$damageA, $damageB] = [max($a[1] - $b[2], 1), max($b[1] - $a[2], 1)];
        return ceil($a[0] / $damageB) >= ceil($b[0] / $damageA) ? $a : $b;
    }

    private function player(array $equipment, int $hp = 100): array
    {
        $player = [$hp, 0, 0, 0];
        foreach ($equipment as $part => $items) {
            foreach ($items as $i) {
                $data = $this->items[$part][$i];
                $player[1] += $data[1];
                $player[2] += $data[2];
                $player[3] += $data[0];
            }
        }
        return $player;
    }

    private function items(): array
    {
        $items = [];
        [$weapons, $armor] = [array_keys($this->items['weapon']), array_keys($this->items['armor'])];

        foreach ($weapons as $weapon) {
            $items[] = [$weapon];
            foreach ($armor as $a) $items[] = [$weapon, $a];
        }

        $equipment = [];
        foreach ($this->allRings() as $rings) {
            foreach ($items as $i) $equipment[] = array_filter([
                'weapon' => [$i[0]],
                'armor'  => isset($i[1]) ? [$i[1]] : [],
                'rings'  => $rings,
            ]);
        }
        return $equipment;
    }

    private function allRings(): array
    {
        $items = array_keys($this->items['rings']);
        for ($combinations = [[]], $j = 0, $max = count($items); $j < $max - 1; $j++) {
            $combinations[] = [$items[$j]];
            for ($k = $j + 1; $k < $max; $k++) $combinations[] = [$items[$j], $items[$k]];
        }
        return $combinations;
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): int {
            return explode(': ', $line)[1];
        }, explode(PHP_EOL, trim($input)));
    }
}
