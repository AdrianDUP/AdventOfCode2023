<?php

namespace Adrian\AdventOfCode2023\Solver\Thirteen;

class Part1
{
    public function processFile(string $fileName): int {
        $fileLines = explode(PHP_EOL, trim(file_get_contents($fileName)));

        $columnRows = $htis->makeColumns($fileLines);
    }

    private function checkRows(array $lines, int $currentIndex = 0): ?int {
        if (empty($lines)) {
            return null;
        }

        $nextLine = array_shift($lines);

        if (in_array($nextLine, $lines)) {
            return $currentIndex;
        } else {
            return $this->checkRows($lines, ++$currentIndex);
        }
    }

    private function makeColumns(array $lines): array {
        
    }
}
