<?php

use Adrian\AdventOfCode2023\Solver\SolverThree;

$solver = new SolverThree();

$fileHandler = fopen(__DIR__ . '/test1.txt', 'r');
$lineCount = 0;

while (!feof($fileHandler)) {
    $line = fgets($fileHandler);
    $solver->addLine($line);
    $lineCount++;

    if ($lineCount < 2) {
        continue;
    }

    $solver->processLine();
}

$solver->addLine('');
$solver->processLine();

printf('Test Output: ');
echo $solver->getTotal();

echo '<br><br>';


$fileHandler = fopen(__DIR__ . '/input.txt', 'r');
$lineCount = 0;

$solver = new SolverThree();

while (!feof($fileHandler)) {
    $line = fgets($fileHandler);
    $solver->addLine($line);
    $lineCount++;

    if ($lineCount < 2) {
        continue;
    }

    $solver->processLine();
}

$solver->addLine('');
$solver->processLine();

printf('Part 1 Output: ');
echo $solver->getTotal();

echo '<br><br>';
