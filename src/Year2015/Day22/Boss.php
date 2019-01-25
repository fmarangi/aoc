<?php

namespace Mzentrale\AdventOfCode\Year2015\Day22;

class Boss
{
    /** @var int */
    public $hitPoints;

    /** @var int */
    private $damage;

    public function __construct(int $hitPoints, int $damage)
    {
        $this->hitPoints = $hitPoints;
        $this->damage    = $damage;
    }

    public function attack(Wizard $wizard): void
    {
        $wizard->hitPoints -= $this->damage - $wizard->armor();
    }
}
