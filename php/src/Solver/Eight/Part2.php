<?php

namespace Adrian\AdventOfCode2023\Solver\Eight;

class Part2
{
    private array $instructions;
    private array $guides;
    private array $startingPaths = [];

    public function processFile(string $fileName): int {
        $fileHandler = fopen($fileName, 'r');

        $lineCount = 0;

        while(!feof($fileHandler)) {
            $line = trim(fgets($fileHandler));

            if (empty($line)) {
                continue;
            }

            if ($lineCount === 0) {
                $this->instructions = str_split($line);
                $lineCount++;
                continue;
            }

            $this->makeGuide($line);
        }

        $nextSteps = $this->startingPaths;

        $finished = false;
        $counter = 0;

        while (!$finished) {
             $nextSteps = $this->step($nextSteps);
             $counter++;

             $hasNoZ = false;

             foreach($nextSteps as $nextStep) {
                 if ($hasNoZ) {
                     continue;
                 }
                 if (!str_ends_with($nextStep, 'Z')) {
                     $hasNoZ = true;
                 }
             }

             if (!$hasNoZ) {
                 $finished = true;
             }
        }

        return $counter;

    }

    private function makeGuide(string $line): void {
        $initialSplit = explode(' = ', $line);
        $index = $initialSplit[0];
        $paths = $initialSplit[1];
        $paths = ltrim($paths, '(');
        $paths = rtrim($paths, ')');

        $paths = explode(', ', $paths);

        $this->guides[$index] = $paths;

        if (str_ends_with($index, 'A')) {
            $this->startingPaths[] = $index;
        }
    }

    private function step(array $nextIndexes): array {
        $nextInstruction = array_shift($this->instructions);

        if ($nextInstruction === 'L') {
            $index = 0;
        } else {
            $index = 1;
        }
        
        $this->instructions[] = $nextInstruction;

        $nextPaths = [];

        foreach ($nextIndexes as $nextIndex) {
            $nextPath = $this->guides[$nextIndex][$index];
            $nextPaths[] = $nextPath;
        }

        return $nextPaths;
    }
}
