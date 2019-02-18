<?php

namespace Mzentrale\AdventOfCode\Year2017\Day18;

class Program
{
    /** @var int */
    private $programId;

    /** @var int[] */
    private $registry = [];

    /** @var int */
    private $lastSound = 0;

    /** @var int */
    private $sent = 0;

    /** @var int[] */
    private $queue = [];

    public function getSent(): int
    {
        return $this->sent;
    }

    public function __construct(int $programId = 0)
    {
        $this->programId = $programId;
    }

    public function send(string $value)
    {
        $this->queue[] = $this->getValue($value);
        $this->sent++;
    }

    public function dequeue()
    {
        return count($this->queue) ? array_shift($this->queue) : null;
    }

    public function receive(string $var, string $value)
    {
        $this->exec(['set', $var, $value]);
    }

    /**
     * @param array $data
     *
     * @return int
     * @throws \Exception
     */
    public function runInstruction(array $data): int
    {
        switch ($data[0]) {
            case 'set':
            case 'add':
            case 'mul':
            case 'mod':
                $this->exec($data);
                break;
            case 'snd':
                $this->lastSound = $this->getValue($data[1]);
                break;
            case 'rcv':
                if ($this->getValue($data[1]) > 0) {
                    throw new \Exception('Program terminated', $this->lastSound);
                }
                break;
            case 'jgz':
                return $this->getValue($data[1]) > 0 ? $this->getValue($data[2]) - 1 : 0;
        }

        return 0;
    }

    public function getValue(string $value): int
    {
        $value = is_numeric($value) ? $value : $this->registry[$value] ?? $this->programId;
        return $value;
    }

    private function exec(array $instruction): void
    {
        switch ($instruction[0]) {
            case 'set':
                $this->registry[$instruction[1]] = $this->getValue($instruction[2]);
                break;
            case 'add':
                $this->registry[$instruction[1]] = $this->getValue($instruction[1]) + $this->getValue($instruction[2]);
                break;
            case 'mul':
                $this->registry[$instruction[1]] = $this->getValue($instruction[1]) * $this->getValue($instruction[2]);
                break;
            case 'mod':
                $this->registry[$instruction[1]] = $this->getValue($instruction[1]) % $this->getValue($instruction[2]);
                break;
        }
    }

    public function __toString()
    {
        return "Program {$this->programId}, sent {$this->sent}, queue " . count($this->queue);
    }
}
