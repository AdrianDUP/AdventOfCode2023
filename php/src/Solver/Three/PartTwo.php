<?php

namespace Adrian\AdventOfCode2023\Solver\Three;

class PartTwo
{
    private array $line1 = [];
    private array $line1Indexes = [];
    private array $line2 = [];
    private array $line2Indexes = [];
    private array $line3 = [];
    private array $line3Indexes = [];

    private int $total = 0;
    private array $ratios = [];

    public function processFile(string $fileName): int {
        $fileHandler = fopen($fileName, 'r');

        $lineCounter = 0;
        $ratios = [];

        while (!feof($fileHandler)) {
            $line = fgets($fileHandler);

            $this->line1 = $this->line2;
            $this->line1Indexes = $this->line2Indexes;
            $this->line2 = $this->line3;
            $this->line2Indexes = $this->line3Indexes;
            $this->line3 = str_split($line);
            $this->line3Indexes = $this->findNumbers($line);

            if ($this->line2 === []) {
                continue;
            }

            $ratios = array_merge($ratios, $this->processLine());
        }

        debug("Ratios", [
            'count' => count($ratios),
            'ratios' => $ratios,
        ]);
        return array_sum($ratios);
    }

    public function processLine(): array
    {
        debug('Processing line', ['line' => $this->line2]);
        $currentNumber = null;
        $isValidNumber = false;

        $ratios = [];

        foreach($this->line2 as $index => $character) {
            if ($character !== '*') {
                continue;
            }

            $numbers = [];

            if ($index > 0) {
                $previousIndex = $index - 1;

                if (!empty($this->line1Indexes[$previousIndex])) {
                    $number = $this->line1Indexes[$previousIndex];
                    if (!in_array($number, $numbers)) {
                        $numbers[] = $number;
                    }
                }
                if (!empty($this->line2Indexes[$previousIndex])) {
                    $number = $this->line2Indexes[$previousIndex];
                    if (!in_array($number, $numbers)) {
                        $numbers[] = $number;
                    }
                }
                if (!empty($this->line3Indexes[$previousIndex])) {
                    $number = $this->line3Indexes[$previousIndex];
                    if (!in_array($number, $numbers)) {
                        $numbers[] = $number;
                    }
                }
            }

            if (!empty($this->line1Indexes[$index])) {
                $number = $this->line1Indexes[$index];
                if (!in_array($number, $numbers)) {
                    $numbers[] = $number;
                }
            }
            if (!empty($this->line3Indexes[$index])) {
                $number = $this->line3Indexes[$index];
                if (!in_array($number, $numbers)) {
                    $numbers[] = $number;
                }
            }

            if ($index < count($this->line2) - 1) {
                $nextIndex = $index + 1;

                if (!empty($this->line1Indexes[$nextIndex])) {
                    $number = $this->line1Indexes[$nextIndex];
                    if (!in_array($number, $numbers)) {
                        $numbers[] = $number;
                    }
                }
                if (!empty($this->line2Indexes[$nextIndex])) {
                    $number = $this->line2Indexes[$nextIndex];
                    if (!in_array($number, $numbers)) {
                        $numbers[] = $number;
                    }
                }
                if (!empty($this->line3Indexes[$nextIndex])) {
                    $number = $this->line3Indexes[$nextIndex];
                    if (!in_array($number, $numbers)) {
                        $numbers[] = $number;
                    }
                }
            }

            if (count($numbers) === 2) {
                $ratios[] = $numbers[0] * $numbers[1];
            }
        }

        return $ratios;
    }

    private function findNumbers(string $line): array {
        $characters = str_split($line);
        $indexes = [];
        $currentNumber = '';

        $finalList = [];

        foreach ($characters as $index => $character) {
            if (!is_numeric($character) && is_numeric($currentNumber) && $indexes !== []) {
                $currentNumber = (int)$currentNumber;
                foreach ($indexes as $index) {
                    $finalList[$index] = $currentNumber;
                }
                $indexes = [];
                $currentNumber = '';
            }
            if (is_numeric($character)) {
                $indexes[] = $index;
                $currentNumber .= $character;
            }
        }

        if (is_numeric($currentNumber) && $indexes !== []) {
                $currentNumber = (int)$currentNumber;
                foreach ($indexes as $index) {
                    $finalList[$index] = $currentNumber;
                }
        }

        return $finalList;
    }

    public function addLine(string $line): void
    {
        $this->line1 = $this->line2;
        $this->line2 = $this->line3;

        $this->line3 = str_split($line);
    }

    private function hasSymbol(int $index): bool
    {
        if ($index > 0) {
            $previousIndex = $index - 1;

            $line1 = $this->line1[$previousIndex] ?? '.';
            debug('Prev Line1', ['character' => $line1]);
            $line2 = $this->line2[$previousIndex] ?? '.';
            debug('Prev Line2', ['character' => $line2]);
            $line3 = $this->line3[$previousIndex] ?? '.';
            debug('Prev Line3', ['character' => $line3]);

            if ($this->isSymbol($line1)
                || $this->isSymbol($line2)
                || $this->isSymbol($line3)
            ) {
                debug('Return 1');
                return true;
            }
        }

        $line1 = $this->line1[$index] ?? '.';
            debug('Same Line1', ['character' => $line1]);
        $line3 = $this->line3[$index] ?? '.';
            debug('Same Line3', ['character' => $line3]);

        if ($this->isSymbol($line1)
            || $this->isSymbol($line3)
        ) {
            debug('Return 2');
            return true;
        }

        if ($index < count($this->line2)) {
            $nextIndex = $index + 1;

            $line1 = $this->line1[$nextIndex] ?? '.';
            debug('Next Line1', ['character' => $line1]);
            $line2 = $this->line2[$nextIndex] ?? '.';
            debug('Next Line1', ['character' => $line2]);
            $line3 = $this->line3[$nextIndex] ?? '.';
            debug('Next Line1', ['character' => $line3]);

            if ($this->isSymbol($line1)
                || $this->isSymbol($line2)
                || $this->isSymbol($line3)
            ) {
                debug('Return 3');
                return true;
            }
        }

        debug('Return 4');
        return false;
    }

    private function isSymbol(string $character): bool
    {
        return 1 === preg_match('/[^\.0-9\n]/', $character);
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
