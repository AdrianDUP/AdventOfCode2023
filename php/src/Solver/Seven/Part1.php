<?php

namespace Adrian\AdventOfCode2023\Solver\Seven;

class Part1
{
    public function processFile(string $fileName): int
    {
        $elements = $this->loadFile($fileName);

        uksort(
            $elements, function ($a, $b) {
                $aParts = str_split($a);
                $bParts = str_split($b);

                $uniqueA = array_count_values($aParts);
                $uniqueB = array_count_values($bParts);

                if (count($uniqueA) !== count($uniqueB)) {
                    if (count($uniqueA) < count($uniqueB)) {
                        return 1;
                    } else {
                        return -1;
                    }
                }

                rsort($uniqueA);
                rsort($uniqueB);

                if ($uniqueA[0] !== $uniqueB[0]) {
                    return $uniqueA[0] <=> $uniqueB[0];
                }

                foreach ($aParts as $index => $card) {
                    $bCard = $bParts[$index];
                    if ($card == $bCard) {
                        continue;
                    }

                    if ($card === 'A') {
                        return 1;
                    } else if ($bCard === 'A') {
                        return -1;
                    } else if ($card === 'K') {
                        return 1;
                    } else if ($bCard === 'K') {
                        return -1;
                    } else if ($card === 'Q') {
                        return 1;
                    } else if ($bCard === 'Q') {
                        return -1;
                    } else if ($card === 'J') {
                        return 1;
                    } else if ($bCard === 'J') {
                        return -1;
                    } else if ($card === 'T') {
                        return 1;
                    } else if ($bCard === 'T') {
                        return -1;
                    } else {
                        return $card <=> $bCard;
                    }            
                }
            }
        );

        $total = 0;
        $counter = 1;

        foreach($elements as $bet) {
            $total += $bet * $counter;
            $counter++;
        }

        return $total;
    }


    private function loadFile(string $fileName): array
    {
        $fileHandler = fopen($fileName, 'r');
        $finalArray = [];

        while(!feof($fileHandler)) {
            $line = fgets($fileHandler);

            if ($line == '') {
                continue;
            }

            $elements = array_filter(explode(' ', $line));

            $finalArray[$elements[0]] = $elements[1];
        }

        return $finalArray;
    }
}
