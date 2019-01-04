<?php

namespace Mzentrale\AdventOfCode\Year2018\Day8;

class Node
{
    /** @var array **/
    private $metadata;

    /** @var array **/
    private $children = [];

    /** @var array **/
    private $remaining;

    public function __construct(array $license)
    {
        list($numChildren, $metadata) = $license;

        for ($i = 0, $remaining = array_slice($license, 2); $i < $numChildren; $i++) {
            $child     = new self($remaining);
            $remaining = $child->remaining;
            $this->children[] = $child;
        }

        $this->metadata  = array_slice($remaining, 0, $metadata);
        $this->remaining = array_slice($remaining, $metadata);
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
}
