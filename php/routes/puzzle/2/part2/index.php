<?php

use Adrian\AdventOfCode2023\Solver\SolverTwo;

$solver = new SolverTwo();

$filePath = __DIR__ . '/../input.txt';

$total = 0;

$fileHandler = fopen($filePath, 'r');

while(!feof($fileHandler)) {
    $line = fgets($fileHandler);

    if (empty($line)) {
        continue;
    }

    $total += $solver->getLinePower($line);
}

echo $total;
