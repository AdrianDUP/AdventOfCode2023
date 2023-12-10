<?php

namespace Adrian\AdventOfCode2023\Solver\Four;

class Part1
{
    public function processFile(string $fileName): int {
        $fileHandler = fopen($fileName, 'r');

        $totalPoints = 0;

        while (!feof($fileHandler)) {
            $totalPoints += $this->processLine(fgets($fileHandler));
        }

        return $totalPoints;
    }

    public function processLine(string $line): int {
        $initialSplit = explode(': ', $line);
        $numbers = explode(' | ', $initialSplit[1]);
        $winningNumbers = array_filter(explode(" ", $numbers[0]));
        $cardNumbers = array_filter(explode(' ', $numbers[1]));

        $matchingNumbers = [];

        foreach ($cardNumbers as $cardNumber) {
            if (in_array($cardNumber, $winningNumbers)) {
                $matchingNumbers[] = $cardNumber;
            }
        }

        if (count($matchingNumbers) === 0) {
            return 0;
        }

        return pow(2, count($matchingNumbers) - 1);
    }
}
