<?php

namespace Adrian\AdventOfCode2023\Solver\Thirteen;

class Part1
{
    public function processFile(string $fileName): int {
        $total = 0;

        $fileContents = file_get_contents($fileName);
        $fileLines = explode("\n", $fileContents);

        $currentInput = [];

        foreach($fileLines as $line) {
            if (empty($line)) {
                debug('Empty line, starting check', [
                    'lines' => $currentInput,
                ]);
                $result = $this->checkRows($currentInput);

                if (is_null($result)) {
                    $currentInput = $this->makeColumns($currentInput);

                    $result = $this->checkRows($currentInput);

                    if (is_int($result)) {
                        debug('Adding to total', [
                            'result' => $result,
                        ]);
                        $total += $result;
                    }
                } else {
                    debug('Adding to total', [
                        'result' => $result,
                    ]);
                    $total += (100 * $result);
                }

                $currentInput = [];
                continue;
            }

            $currentInput[] = $line;
        }

        return $total;
    }

    private function checkRows(array $lines): ?int {
        $firstElement = reset($lines);
        $matchFound = false;
        $nextElement = end($lines);

        while (!$matchFound) {
            if (0 === key($lines)) {
                break;
            }

            if ($nextElement === $firstElement) {
                $matchFound = true;
                break;
            }

            $nextElement = prev($lines);
        }

        if (!$matchFound) {
            $lastElement = end($lines);
            $nextElement = reset($lines);

            while (!$matchFound) {
                if (key($lines) === count($lines) - 1) {
                    break;
                }
                if ($nextElement === $lastElement) {
                    $matchFound = true;
                    break;
                }

                $nextElement = next($lines);
            }

            if ($matchFound) {
                $slice = array_slice($lines, key($lines));

                return $this->isPalindrome($slice, 0);
            }
        } else {
            $slice = array_slice($lines, 0, key($lines) + 1);

            return $this->isPalindrome($slice, 0);
        }

        return null;
    }

    private function checkForMirrorIndex(array $lines): ?int {
        $checkLine = $lines[0];
        $lineCount = count($lines);
        $matchKey = null;

        end($lines);

        while (key($lines) !== 1) {
            if (prev($lines) !== $checkLine) {
                continue;
            } else {
                $matchKey = key($lines);
                break;
            }
        }

        if (!is_null($matchKey)) {

        }
    }

    private function makeColumns(array $lines): array {
        $rowsFromColumns = [];
        for($i = 0; $i < strlen($lines[0]); $i++) {
            if (empty($rowsFromColumns[$i])) {
                $rowsFromColumns[$i] = '';
            }

            foreach($lines as $line) {
                $rowsFromColumns[$i] .= substr($line, $i, 1);
            }
        }

        return $rowsFromColumns;
    }

    private function isPalindrome(array $lines, int $currentIndex = 0): ?int {
        debug('Checking for palindrome', [
            'lines' => $lines,
            'currentIndex' => $currentIndex,
        ]);
        if (count($lines) < 2) {
            debug('Nothing left to check in palindrome');
            return $currentIndex + 1;
        }
        if ($lines[0] === $lines[count($lines) - 1]) {
            debug('first and last match');
            return $this->isPalindrome(array_slice($lines, 1, -1), $currentIndex + 1);
        }

        return null;
    }
}
