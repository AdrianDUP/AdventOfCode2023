<?php

namespace Adrian\AdventOfCode2023\Solver\Three;

class PartTwo
{
    private array $line1 = [];
    private array $line2 = [];
    private array $line3 = [];

    private int $total = 0;

    public function processFile(string $fileName): int {

    }

    public function processLine(): void
    {
        debug('Processing line');
        $currentNumber = null;
        $isValidNumber = false;

        foreach($this->line2 as $index => $character) {
            debug(
                'Checking character', [
                'index' => $index,
                'character' => $character,
                ]
            );
            switch($character) {
            case '.':
                debug('is dot');
                if (!is_null($currentNumber) && $isValidNumber) {
                    info(
                        'Adding number', [
                        'number' => $currentNumber,
                        ]
                    );
                    $this->total += (int) $currentNumber;
                }
                $currentNumber = null;
                $isValidNumber = false;
                continue 2;
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
            case '0':
                debug('is number');
                if (is_null($currentNumber)) {
                    $currentNumber = $character;
                } else {
                    $currentNumber .= $character;
                }
                if ($isValidNumber) {
                    continue 2;
                }
                if ($this->hasSymbol($index)) {
                    $isValidNumber = true;
                }
                break;
            default:
                debug('isSymbol');
                if (!is_null($currentNumber) && $isValidNumber) {
                    info(
                        'Adding number', [
                        'number' => $currentNumber,
                        ]
                    );
                    $this->total += (int) $currentNumber;
                }
                $currentNumber = null;
                $isValidNumber = false;
            }
        }
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
