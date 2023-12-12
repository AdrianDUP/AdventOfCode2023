<?php

namespace Adrian\AdventOfCode2023\Solver\Nine;

class Part1
{
    public function processFile(string $fileName): int
    {
        $fileHandler = fopen($fileName, 'r');

        $total = 0;

        while (!feof($fileHandler)) {
            $line = trim(fgets($fileHandler));

            if (empty($line)) {
                continue;
            }

            $result = $this->processLine($line);
            debug('Adding result', [
                'result' => $result
            ]);
            $total += $result;
        }

        return $total;
    }

    private function processLine(string $line): int
    {
        $numbers = explode(' ', $line);

        return $this->processNumbers($numbers);
    }

    public function processNumbers(array $numbers): int
    {
        $numberValues = array_unique($numbers);
        debug('Number values', [
            'numberValues' => $numberValues,
        ]);
        if (count($numberValues) === 1 && $numberValues[0] === 0) {
            return 0;
        }
        debug('Processing Numbers', [
            'numbers' => $numbers,
        ]);

        $numberCount = count($numbers) - 1;
        $newNumbers = [];

        $allZeros = true;

        for ($i = 0; $i < $numberCount; $i++) {
            $nextDiff = array_slice($numbers, $i, 2);
            $diff = (int)$nextDiff[1] - (int)$nextDiff[0];

            if ($allZeros && $diff !== 0) {
                $allZeros = false;
            }

            $newNumbers[] = $diff;
        }

        return end($numbers) + $this->processNumbers($newNumbers);
    }
}
