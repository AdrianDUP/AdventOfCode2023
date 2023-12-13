<?php

namespace Adrian\AdventOfCode2023\Solver\Thirteen;

class Part1
{
    public function processFile(string $fileName): int {

        return $total;
    }

    private function checkRows(array $lines, int $currentIndex = 0): ?int {
        $lineCount = count($lines);

        if ($lineCount % 2 === 0) {

        }
    }

    private function checkForMirrorIndex(array $lines): ?int {
        $lineCount = count($lines);

        for ($i = 0; $i < $lineCount; $i++) {
            if ($lines[0] !== $lines[$lineCount - ($i + 1)]) {
                return null;
            }
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
}
