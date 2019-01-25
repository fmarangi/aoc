<?php

namespace Mzentrale\AdventOfCode\Year2015\Day22;

class Wizard
{
    /** @var int */
    public $hitPoints;

    /** @var int */
    private $mana;

    /** @var array */
    private $activeSpells = [];

    public function __construct(int $hitPoints, int $mana)
    {
        $this->hitPoints = $hitPoints;
        $this->mana      = $mana;
    }

    public function effects(Boss $boss): void
    {
        foreach ($this->getActiveSpells() as $spell) {
            switch ($spell) {
                case 'Poison':
                    $boss->hitPoints -= 3;
                    break;
                case 'Recharge':
                    $this->mana += 101;
                    break;
            }
            $this->activeSpells[$spell] -= 1;
        }
        $this->activeSpells = array_filter($this->activeSpells);
    }

    public function cast(string $spell, int $mana, Boss $boss): void
    {
        switch ($spell) {
            case 'Magic Missile':
                $boss->hitPoints -= 4;
                break;
            case 'Drain':
                $boss->hitPoints -= 2;
                $this->hitPoints += 2;
                break;
            default:
                $duration = ['Shield' => 6, 'Poison' => 6, 'Recharge' => 5];
                $this->activeSpells[$spell] = $duration[$spell];
                break;
        }
        $this->mana -= $mana;
    }

    public function armor(): int
    {
        return isset($this->activeSpells['Shield']) ? 7 : 0;
    }

    public function getMana(): int
    {
        return $this->mana;
    }

    public function getActiveSpells(): array
    {
        return array_keys($this->activeSpells);
    }
}
