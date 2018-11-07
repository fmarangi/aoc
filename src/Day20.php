<?php

namespace Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Day20\Particle;

class Day20 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getClosest($input, 500);
    }

    public function part2(string $input)
    {
        return $this->getRemaining($input, 200);
    }

    public function getClosest(string $input, int $iterations = 3): int
    {
        $particles = $this->getParticles($input);

        for ($i = 0; $i < $iterations; $i++) {
            array_walk($particles, function (Particle $particle) {
                $particle->update();
            });
        }

        return array_reduce($particles, function (?Particle $result, Particle $particle): Particle {
            return $result && $result->getDistance() < $particle->getDistance() ? $result : $particle;
        })->getId();
    }

    public function getRemaining(string $input, int $iterations = 3): int
    {
        $particles = $this->getParticles($input);

        $particles = $this->removeCollisions($particles);
        for ($i = 0; $i < $iterations; $i++) {
            array_walk($particles, function (Particle $particle) {
                $particle->update();
            });
            $particles = $this->removeCollisions($particles);
        }

        return count($particles);
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            preg_match('#p=<(.*?)>, v=<(.*?)>, a=<(.*?)>#', $line, $match);
            if ($match) {
                return [
                    explode(',', trim($match[1])),
                    explode(',', trim($match[2])),
                    explode(',', trim($match[3])),
                ];
            }
            throw new \Exception('Line unreadable: ' . $line);
        }, explode(PHP_EOL, trim($input)));
    }

    private function getParticles(string $input): array
    {
        $particles = [];
        foreach ($this->parseInput($input) as $id => $data) {
            $particles[] = new Particle($id, ...$data);
        }
        return $particles;
    }

    private function removeCollisions(array $particles): array
    {
        $positions = array_reduce($particles, function (array $result, Particle $particle) {
            $key          = implode(',', $particle->getPosition());
            $result[$key] = ($result[$key] ?? 0) + 1;
            return $result;
        }, []);

        return array_filter($particles, function (Particle $particle) use ($positions) {
            return $positions[implode(',', $particle->getPosition())] === 1;
        });
    }
}
