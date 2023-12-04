<?php

use Adrian\AdventOfCode2023\Solver\SolverTwo;

$solver = new SolverTwo();

$filePath = __DIR__ . '/../test1.txt';

$total = 0;

$fileHandler = fopen($filePath, 'r');

while(!feof($fileHandler)) {
    $line = fgets($fileHandler);

    if (empty($line)) {
        continue;
    }

    $total += $solver->checkLine($line);
}

echo $total;
