<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day7 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getOrder($input);
    }

    public function part2(string $input)
    {
        return $this->orderWithWorkers($input, 5, 60);
    }

    private function parseInput(string $input)
    {
        return array_map(function (string $step): array {
            return sscanf($step, 'Step %1s must be finished before step %1s can begin.');
        }, explode(PHP_EOL, trim($input)));
    }

    public function getOrder(string $input): string
    {
        $steps = $this->parseInput($input);
        $deps  = $this->dependencies($steps);
        $reqs  = $this->prerequisites($steps);
        $first = $this->getFirst($steps);

        $result = '';
        foreach ($this->order(array_shift($first), $first, $deps, $reqs) as $letter) {
            $result .= $letter;
        }

        return $result;
    }

    private function order(string $letter, array $backlog, callable $deps, callable $reqs): \Iterator
    {
        yield $letter;
        $backlog = array_merge($deps($letter), $backlog);
        sort($backlog);
        foreach ($backlog as $next) {
            if (!array_intersect($reqs($next), $backlog)) {
                $backlog = array_diff($backlog, [$next]);
                yield from $this->order($next, $backlog, $deps, $reqs);
                return;
            }
        }

        if ($backlog) {
            yield from $this->order(array_shift($backlog), $backlog, $deps, $reqs);
        }
    }

    private function dependencies(array $steps): callable
    {
        return function (string $step) use ($steps): array {
            return array_column(array_filter($steps, function (array $seq) use ($step) {
                return $seq[0] === $step;
            }), 1);
        };
    }

    private function prerequisites(array $steps): callable
    {
        return function (string $step) use ($steps): array {
            return array_column(array_filter($steps, function (array $seq) use ($step) {
                return $seq[1] === $step;
            }), 0);
        };
    }

    private function getAll(array $steps): array
    {
        $allSteps = array_unique(array_merge([], ...$steps));
        sort($allSteps);
        return $allSteps;
    }

    private function getFirst(array $steps): array
    {
        $after = array_column($steps, 1);
        return array_filter($this->getAll($steps), function (string $step) use ($after): bool {
            return !in_array($step, $after);
        });
    }

    public function orderWithWorkers(string $input, int $numWorkers, int $offset = 0): int
    {
        $steps   = $this->parseInput($input);
        $all     = $this->getAll($steps);
        $todo    = $all;
        $reqs    = $this->prerequisites($steps);
        $workers = array_fill(0, $numWorkers, null);
        $done    = [];
        $time    = 0;

        while (count($done) !== count($all)) {
            // Fill workers
            $free = count($workers) - count(array_filter($workers));
            if ($todo && $free) {
                $workable = array_slice(array_filter($this->getWorkable($todo, $reqs), function (string $letter) use ($reqs, $done) {
                    return !array_diff($reqs($letter), $done);
                }), 0, $free);

                foreach ($workable as $letter) {
                    foreach ($workers as &$worker) {
                        if (!$worker) {
                            $worker = [$letter, $this->getRequiredSeconds($letter, $offset)];
                            break;
                        }
                    }
                }
                $todo = array_diff($todo, $workable);
            }

            // Work
            foreach ($workers as &$worker) {
                if ($worker) {
                    $worker[1]--;
                    if (!$worker[1]) {
                        $done[] = $worker[0];
                        $worker = null;
                    }
                }
            }

            $time++;
        }

        return $time;
    }

    private function getRequiredSeconds(string $letter, int $offset): int
    {
        return $offset + ord($letter) - ord('A') + 1;
    }

    private function getWorkable(array $todo, callable $reqs): array
    {
        return array_filter($todo, function (string $letter) use ($todo, $reqs) {
            return !array_intersect($reqs($letter), $todo);
        });
    }
}
