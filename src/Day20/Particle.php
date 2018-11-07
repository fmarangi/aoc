<?php

namespace Mzentrale\AdventOfCode\Day20;

class Particle
{
    /** @var int */
    private $id;

    /** @var int[] */
    private $position;

    /** @var int[] */
    private $velocity;

    /** @var int[] */
    private $acceleration;

    public function __construct(int $id, array $position, array $velocity, array $acceleration)
    {
        $this->id           = $id;
        $this->position     = $position;
        $this->velocity     = $velocity;
        $this->acceleration = $acceleration;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPosition(): array
    {
        return $this->position;
    }

    public function getDistance(array $from = [0, 0, 0])
    {
        return array_sum(array_map(function (int $initial, int $current) {
            return abs($initial - $current);
        }, $from, $this->position));
    }

    public function update(): void
    {
        $this->velocity = array_map(function (int $velocity, int $acceleration) {
            return $velocity + $acceleration;
        }, $this->velocity, $this->acceleration);

        $this->position = array_map(function (int $current, int $velocity) {
            return $current + $velocity;
        }, $this->position, $this->velocity);
    }
}
