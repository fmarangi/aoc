<?php

namespace Mzentrale\AdventOfCode\Year2018\Day8;

class Node
{
    /** @var array **/
    private $metadata;

    /** @var array **/
    private $children = [];

    /** @var string **/
    private $remaining;

    public function __construct(string $license)
    {
        list($header, $remaining) = $this->find($license, 2);
        list($numChildren, $metadata) = $header;

        for ($i = 0; $i < $numChildren; $i++) {
            $child     = new self($remaining);
            $remaining = $child->remaining;
            $this->children[] = $child;
        }

        [$this->metadata, $this->remaining] = $this->find($remaining, $metadata);
    }

    public function getMetadataSum(): int
    {
        $sums = array_map(function (Node $child): int {
            return $child->getMetadataSum();
        }, $this->children);
        return array_sum($this->metadata) + array_sum($sums);
    }

    public function getValue(): int
    {
        if (!$this->children) return array_sum($this->metadata);
        return array_sum(array_map(function (int $ref): int {
            return isset($this->children[$ref - 1]) ? $this->children[$ref - 1]->getValue() : 0;
        }, $this->metadata));
    }

    private function find(string $string, int $count): array
    {
        for ($i = 0, $offset = 0; $i < $count; $i++) {
            $offset = strpos($string . ' ', ' ', $offset + 1);
        }
        return [explode(' ', substr($string, 0, $offset)), substr($string, $offset + 1)];
    }
}
