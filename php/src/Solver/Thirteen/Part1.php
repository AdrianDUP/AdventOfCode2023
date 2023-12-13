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
}
