<?php

namespace Adrian\AdventOfCode2023\Solver\Eight;

class Part1
{
    private array $instructions;
    private array $guides;

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

        debug('Data built', [
            'instructions' => $this->instructions,
            'guides' => $this->guides,
        ]);

        return $this->step(0, 'AAA');
    }

    private function makeGuide(string $line): void {
        $initialSplit = explode(' = ', $line);
        $index = $initialSplit[0];
        $paths = $initialSplit[1];
        $paths = ltrim($paths, '(');
        $paths = rtrim($paths, ')');

        $paths = explode(', ', $paths);

        $this->guides[$index] = $paths;
    }

    private function step(int $currentStep, string $nextIndex): int {
        debug('Stepping', [
            'currentStep' => $currentStep,
            'nextIndex' => $nextIndex,
        ]);
        $nextInstruction = array_shift($this->instructions);
        if ($nextInstruction === 'L') {
            $index = 0;
        } else {
            $index = 1;
        }
        debug('Instruction found', [
            'nextInstruction' => $nextInstruction,
            'index' => $index,
        ]);
        $this->instructions[] = $nextInstruction;

        $nextPath = $this->guides[$nextIndex][$index];

        $currentStep++;

        if ($nextPath === 'ZZZ') {
            return $currentStep;
        }

        return $this->step($currentStep, $nextPath);
    }
}
