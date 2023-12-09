<?php

namespace Adrian\AdventOfCode2023\Solver;

class SolverFive
{
    private array $sources = [];
    private array $destinations = [];

    public function processFile(string $file_name): int {
        $fileHandler = fopen($file_name, 'r');

        while (!feof($fileHandler)) {
            $this->processLine(fgets($fileHandler));
        }

        $smallestValue = 0;

        foreach ($this->destinations as $destination) {
            if ($smallestValue == 0 || $destination < $smallestValue) {
                $smallestValue = $destination;
            }
        }

        return $destination;
    }

    public function processLine(string $fileLine): void {
        if ($fileLine === "") {
            return;
        }

        if (str_starts_with($fileLine, "seeds")) {
            $this->makeSeeds($fileLine);
            return;
        }

        if (str_ends_with($fileLine, ":")) {
            $this->finaliseMap();
            return;
        }

        $rangeParts = explode(" ", $fileLine);
        if (count($rangeParts) !== 3) {
            throw new \Exception('Range not correct');
        }

        $sourceStart = (int)$rangeParts[1];
        $offset = (int) $rangeParts[2];
        $sourceEnd = $sourceStart + $offset;
        $destinationStart = (int)$rangeParts[0];

        foreach ($this->sources as $index => $source) {
            if ($sourceStart > $source) {
                continue;
            }
            if ($sourceEnd < $source) {
                continue;
            }
            $this->destinations[] = $destinationStart + ($source - $sourceStart);
        }
    }

    private function makeSeeds(string $fileLine): void {
        $lineParts = explode(' ', $fileLine);
        array_shift($lineParts);

        $this->sources = $lineParts;
    }

    private function finaliseMap(): void {
        if ($this->sources !== []) {
            foreach ($this->sources as $source) {
                $this->destinations[] = $source;
            }
        }
        $this->sources = $this->destinations;
    }
}
