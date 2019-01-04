<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day13 implements Puzzle
{
    const UP    = 0;
    const RIGHT = 1;
    const DOWN  = 2;
    const LEFT  = 3;

    const TURN_LEFT   = 0;
    const GO_STRAIGHT = 1;
    const TURN_RIGHT  = 2;

    public function part1(string $input)
    {
        return implode(',', $this->getFirstCrash($input));
    }

    public function part2(string $input)
    {
        return implode(',', $this->getLastCart($input));
    }

    public function getFirstCrash(string $map): array
    {
        list($grid, $carts) = $this->parseInput($map);
        while (true) {
            foreach ($carts as &$cart) {
                $this->newPosition($cart);
                $current = $grid[$cart[1]]{$cart[0]};
                switch ($current) {
                    case '+':
                        $this->newDirection($cart);
                        break;
                    case '/':
                    case '\\':
                        $this->turn($cart, $current);
                        break;
                }

                if ($crash = $this->getCrash($carts)) {
                    $first = array_pop($crash);
                    return [$carts[$first][0], $carts[$first][1]];
                }
            }

            usort($carts, function (array $a, array $b) {
                return $a[0] <=> $b[0] ?: $a[1] <=> $b[1];
            });
        }
        return [];
    }

    public function getLastCart(string $map): array
    {
        list($grid, $carts) = $this->parseInput($map);
        while (true) {
            $remove = [];
            foreach ($carts as &$cart) {
                $this->newPosition($cart);
                $current = $grid[$cart[1]]{$cart[0]};
                switch ($current) {
                    case '+':
                        $this->newDirection($cart);
                        break;
                    case '/':
                    case '\\':
                        $this->turn($cart, $current);
                        break;
                }

                if ($crash = $this->getCrash($carts)) {
                    array_push($remove, ...$crash);
                }
            }

            foreach ($remove as $i) unset($carts[$i]);
            if (count($carts) === 1) return array_slice(current($carts), 0, 2);

            usort($carts, function (array $a, array $b) {
                return $a[0] <=> $b[0] ?: $a[1] <=> $b[1];
            });
        }
        return [];
    }

    private function turn(array &$cart, string $curve): void
    {
        switch ($cart[2]) {
            case self::RIGHT:
            case self::LEFT:
                $cart[2] += $curve === '/' ? -1 : 1;
                break;
            default:
                $cart[2] += $curve === '/' ? 1 : -1;
                break;
        }
        $cart[2] = ($cart[2] + 4) % 4;
    }

    private function newPosition(array &$cart): void
    {
        $offsets = [
            self::UP    => [0, -1],
            self::RIGHT => [1, 0],
            self::DOWN  => [0, 1],
            self::LEFT  => [-1, 0],
        ];
        $cart[0] += $offsets[$cart[2]][0];
        $cart[1] += $offsets[$cart[2]][1];
    }

    private function newDirection(array &$cart): void
    {
        $turns = [
            self::TURN_LEFT   => -1,
            self::GO_STRAIGHT => 0,
            self::TURN_RIGHT  => 1,
        ];
        $cart[2] = ($cart[2] + 4 + $turns[$cart[3] % 3]) % 4;
        $cart[3] = ($cart[3] + 1) % 3;
    }

    private function getCrash(array $carts): array
    {
        $crash = [];
        for ($j = 0, $max = count($carts); $j < $max; $j++) {
            for ($k = $j + 1; $k < $max; $k++) {
                if ($carts[$j][0] === $carts[$k][0] && $carts[$j][1] === $carts[$k][1]) {
                    array_push($crash, $j, $k);
                }
            }
        }
        return $crash;
    }

    private function parseInput(string $map): array
    {
        $rows = explode(PHP_EOL, $map);
        $dirs = [self::UP => '^', self::RIGHT => '>', self::DOWN => 'v', self::LEFT => '<'];
        for ($i = 0, $carts = []; $i < count($rows); $i++) {
            preg_match_all('#[<>^v]#', $rows[$i], $match, PREG_OFFSET_CAPTURE);
            foreach (($match[0] ?? []) as $cart) {
                $carts[] = [$cart[1], $i, array_search($cart[0], $dirs), self::TURN_LEFT];
                $rows[$i]{$cart[1]} = in_array($cart[0], ['^', 'v']) ? '|' : '-';
            }
        }
        return [$rows, $carts];
    }
}
