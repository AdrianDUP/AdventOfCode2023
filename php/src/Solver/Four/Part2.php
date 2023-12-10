<?php

namespace Adrian\AdventOfCode2023\Solver\Four;

class Part2
{
    public function processFile(string $fileName): int {
        $fileHandler = fopen($fileName, 'r');

        $totalPoints = 0;
        $cardCounts = [];
        $counter = 0;

        while (!feof($fileHandler)) {
            $counter++;
            $line = fgets($fileHandler);

            if (empty($line)) {
                continue;
            }
            
            $winningNumbers = $this->processLine($line);

            if (!isset($cardCounts[$counter])) {
                $cardCounts[$counter] = 1;
            } else {
                $cardCounts[$counter]++;
            }

            if ($winningNumbers > 0 && $counter != 208) {
                for ($i = 1; $i <= $winningNumbers; $i++) {
                    $index = $counter + $i;
                    if (!isset($cardCounts[$index])) {
                        $cardCounts[$index] = 1 * $cardCounts[$counter];
                    } else {
                        $cardCounts[$index] += 1 * $cardCounts[$counter];
                    }
                }
            }
        }

        debug('CardCounts', [
            'counts' => count($cardCounts),
            'cardCounts' => $cardCounts,
        ]);

        return array_sum($cardCounts);
    }

    public function processLine(string $line): int {
        $initialSplit = explode(': ', $line);
        $cardNumber = array_filter(explode(' ', $initialSplit[0]))[1];
        $numbers = explode(' | ', $initialSplit[1]);
        $winningNumbers = array_filter(explode(" ", $numbers[0]));
        $cardNumbers = array_filter(explode(' ', $numbers[1]));

        $matchingNumbers = [];

        foreach ($cardNumbers as $cardNumber) {
            if (in_array($cardNumber, $winningNumbers)) {
                $matchingNumbers[] = $cardNumber;
            }
        }

        return count($matchingNumbers);
    }
}
