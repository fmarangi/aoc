<?php

namespace Mzentrale\AdventOfCode;

require_once __DIR__ . '/vendor/autoload.php';

foreach (glob(__DIR__ . '/input/*.txt') as $day) {
    $input  = file_get_contents($day);
    $solver = "Mzentrale\\AdventOfCode\\" . ucfirst(pathinfo($day, PATHINFO_FILENAME));
    echo sprintf('%s: %s', $solver, (new $solver)->solve($input)) . PHP_EOL;
}
