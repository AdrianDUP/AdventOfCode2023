<?php

namespace Adrian\AdventOfCode2023\Solver\Seven;

class Part2
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

                arsort($uniqueA);
                arsort($uniqueB);

                $keysA = array_keys($uniqueA);
                $keysB = array_keys($uniqueB);

                $boostedA = $uniqueA;
                $boostedB = $uniqueB;

                if ($keysA[0] === 'J' && empty($boostedA['A'])) {
                    $boostedA['A'] = $boostedA['J'];
                    unset($boostedA['J']);
                } elseif (!empty($boostedA['J'])) {
                    if ($keysA)
                }

                if (count($uniqueA) !== count($uniqueB)) {
                    if (count($uniqueA) < count($uniqueB)) {
                        debug('Exit 1');
                        return 1;
                    } else {
                        debug('Exit 2');
                        return -1;
                    }
                }

                if (count($uniqueA) === 1) {
                    if ($a[0] === 'J') {
                        return 1;
                    } else if ($b[0] === 'J') {
                        return -1;
                    }
                }

                arsort($uniqueA);
                arsort($uniqueB);

                $keysA = array_keys($uniqueA);
                $keysB = array_keys($uniqueB);

                $boostedA = $uniqueA;
                $boostedB = $uniqueB;

                if (!empty($uniqueA['J'])) {
                    debug('Doing A');
                    if ($keysA[0] !== 'J') {
                        $indexA = 0;
                    } else {
                        $indexA = 1;
                    }
                    $boostedA[$keysA[$indexA]] += $boostedA['J'];
                    unset($boostedA['J']);
                }
                if (!empty($uniqueB['J'])) {
                    debug('Doing B');
                    if ($keysB[0] !== 'J') {
                        $indexB = 0;
                    } else {
                        $indexB = 1;
                    }
                    $boostedB[$keysB[$indexB]] += $boostedB['J'];
                    unset($boostedB['J']);
                }

                if (count($boostedA) !== count($boostedB)) {
                        debug('Exit 3');
                    if(count($boostedA) < count($boostedB)) {
                        return 1;
                    } else {
                        return -1;
                    }
                }

                $keyA = $keysA[0] === 'J' ? $keysA[1] : $keysA[0];
                $keyB = $keysB[0] === 'J' ? $keysB[1] : $keysB[0];

                rsort($boostedA);
                rsort($boostedB);

                if ($boostedA[0] !== $boostedB[0]) {
                    return current($boostedA) <=> current($boostedB);
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
                    } else if ($card === 'T') {
                        return 1;
                    } else if ($bCard === 'T') {
                        return -1;
                    } else if ($card === 'J') {
                        return -1;
                    } else if ($bCard === 'J') {
                        return 1;
                    } else {
                        return $card <=> $bCard;
                    }            
                }
            }
        );

        $total = 0;
        $counter = 1;

        debug(
            'elements', [
            'elements' => $elements
            ]
        );

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
