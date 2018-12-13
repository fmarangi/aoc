<?php

namespace Mzentrale\AdventOfCode\Year2018\Day9;

class Marble
{
    /** @var int */
    private $value;

    /** @var Marble */
    private $prev;

    /** @var Marble */
    private $next;

    public function __construct(int $value, ?Marble $prev = null, ?Marble $next = null)
    {
        $this->value = $value;
        $this->prev  = $prev ?? $this;
        $this->next  = $next ?? $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function insertAfter(int $i): Marble
    {
        $marble           = new self($i, $this, $this->next);
        $this->next->prev = $marble;
        $this->next       = $marble;
        return $marble;
    }

    public function delete()
    {
        $this->prev->next = $this->next;
        $this->next->prev = $this->prev;
        return $this->next;
    }

    public function prev(int $n = 1): Marble
    {
        for ($i = 0, $marble = $this; $i < $n; $i++) {
            $marble = $marble->prev;
        }
        return $marble;
    }

    public function next(): Marble
    {
        return $this->next;
    }
}
