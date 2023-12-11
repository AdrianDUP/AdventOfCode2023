<?php

namespace Adrian\AdventOfCode2023\Solver\Six;

class Part1
{
    public function processFile(string $fileName): int
    {
        $fileLines = $this->readFileLines($fileName);

        debug(
            'fileLines', [
            'lines' => $fileLines,
            ]
        );

        $times = array_filter(explode(' ', $fileLines[0]));
        $distances = array_filter(explode(' ', $fileLines[1]));
        array_shift($times);
        array_shift($distances);

        $records = [];

        foreach ($times as $index => $time) {
            $wins = $this->calculateTimeAndDistance((int) $time, (int)$distances[$index]);
            if ($wins > 0) {
                $records[] = $wins;
            }
        }

        $total = 1;

        foreach ($records as $record) {
            $total *= $record;
        }

        return $total;
    }

    public function readFileLines(string $fileName): array
    {
        return explode(PHP_EOL, file_get_contents($fileName));
    }

    private function calculateTimeAndDistance(int $time, int $distance): int
    {
        $numberOfWins = 0;

        for ($i = 0; $i <= $time; $i++) {
            $boatTravelTime = $time - $i;
            $speed = $i;
            $yourDistance = $boatTravelTime * $speed;

            if ($yourDistance > $distance) {
                $numberOfWins++;
            }
        }

        return $numberOfWins;
    }
}
