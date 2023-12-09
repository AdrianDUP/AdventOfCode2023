<?php

namespace Adrian\AdventOfCode2023\Solver\Five;

class PartOne
{
    private array $sources = [];
    private array $destinations = [];

    public function processFile(string $file_name): int {
        $fileHandler = fopen($file_name, 'r');

        while (!feof($fileHandler)) {
            $this->processLine(fgets($fileHandler));
        }

        $this->finaliseMap();

        $smallestValue = 0;

        foreach ($this->sources as $source) {
            if ($smallestValue == 0 || $source < $smallestValue) {
                $smallestValue = $source;
            }
        }

        return $smallestValue;
    }

    public function processLine(string $fileLine): void {
        $fileLine = trim($fileLine);
        debug('Processing line', [
            'line' => $fileLine,
        ]);
        if ($fileLine === "") {
            debug('Fileline empty');
            return;
        }

        if (str_starts_with($fileLine, "seeds")) {
            debug('Making seeds');
            $this->makeSeeds($fileLine);
            return;
        }

        if (str_ends_with($fileLine, ":")) {
            debug('Finalising map');
            $this->finaliseMap();
            return;
        }

        debug('Checking range');
        $rangeParts = explode(" ", $fileLine);

        if (count($rangeParts) !== 3) {
            throw new \Exception('Range not correct');
        }

        $sourceStart = (int)$rangeParts[1];
        debug("source start calculated", [
            'sourceStart' => $sourceStart,
        ]);
        $offset = (int) $rangeParts[2];
        debug('offset calculated', [
            'offset' => $offset,
        ]);
        $sourceEnd = $sourceStart + $offset - 1;
        debug('sourceEnd calculated', [
            'sourceEnd' => $sourceEnd,
        ]);
        $destinationStart = (int)$rangeParts[0];
        debug('destinationStart calculated', [
            'destinationStart' => $destinationStart,
        ]);

        $newSources = [];

        foreach ($this->sources as $index => $source) {
            debug('Checking source', [
                'source' => $source,
            ]);
            if ($sourceStart > $source) {
                debug('Source not in range', [
                    'start' => $sourceStart,
                    'source' => $source,
                ]);
                $newSources[] = $source;
                continue;
            }
            if ($sourceEnd < $source) {
                debug('Source not in range', [
                    'end' => $sourceEnd,
                    'source' => $source,
                ]);
                $newSources[] = $source;
                continue;
            }
            debug('Adding destination', [
                'destination' => $destinationStart + ($source - $sourceStart),
            ]);
            $this->destinations[] = $destinationStart + ($source - $sourceStart);
        }

        $this->sources = $newSources;
    }

    private function makeSeeds(string $fileLine): void {
        $lineParts = explode(' ', $fileLine);
        array_shift($lineParts);

        foreach($lineParts as $part) {
            $this->sources[] = (int) $part;
        }
        debug('Initial sources', [
            'sources' => $this->sources,
        ]);
    }

    private function finaliseMap(): void {
        debug('finalising map', [
            'sources' => $this->sources,
            'destinations' => $this->destinations,
        ]);
        if ($this->sources !== []) {
            foreach ($this->sources as $source) {
                $this->destinations[] = $source;
            }
        }
        $this->sources = $this->destinations;
        $this->destinations = [];

        debug('Sources finalised', [
            'sources' => $this->sources,
            'destinations' => $this->destinations,
        ]);
    }
}
