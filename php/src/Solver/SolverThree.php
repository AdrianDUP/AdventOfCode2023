<?php

namespace Adrian\AdventOfCode2023\Solver;

class SolverThree
{
    private array $line1 = [];
    private array $line2 = [];
    private array $line3 = [];

    private int $total = 0;

    public function processLine(): void
    {
        $currentNumber = null;
        $isValidNumber = false;

        foreach($this->line2 as $index => $character) {
            switch($character) {
            case '.':
                if (!is_null($currentNumber) && $isValidNumber) {
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
                if (!is_null($currentNumber) && $isValidNumber) {
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
            $line2 = $this->line2[$previousIndex] ?? '.';
            $line3 = $this->line3[$previousIndex] ?? '.';

            if ($this->isSymbol($line1)
                || $this->isSymbol($line2)
                || $this->isSymbol($line3)
            ) {
                //printf('Previous index');
                return true;
            }
        }

        $line1 = $this->line1[$index] ?? '.';
        $line3 = $this->line3[$index] ?? '.';

        if ($this->isSymbol($line1)
            || $this->isSymbol($line3)
        ) {
            //printf('Current index');
            return true;
        }

        if ($index < count($this->line2)) {
            $nextIndex = $index + 1;

            $line1 = $this->line1[$nextIndex] ?? '.';
            $line2 = $this->line2[$nextIndex] ?? '.';
            $line3 = $this->line3[$nextIndex] ?? '.';

            if ($this->isSymbol($line1)
                || $this->isSymbol($line2)
                || $this->isSymbol($line3)
            ) {
                //printf('Next index');
                return true;
            }
        }

        return false;
    }

    private function isSymbol(string $character): bool
    {
        return 1 === preg_match('/[^\.0-9]/', $character);
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
