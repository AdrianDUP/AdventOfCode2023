<?php

namespace Adrian\AdventOfCode2023\Solver\Six;

class Part2
{
    public function processFile(string $fileName): int
    {
        $fileLines = $this->readFileLines($fileName);

        $times = array_filter(explode(' ', $fileLines[0]));
        $distances = array_filter(explode(' ', $fileLines[1]));
        array_shift($times);
        array_shift($distances);

        $theTime = '';
        $theDistance = '';

        foreach ($times as $index => $time) {
            $theTime .= $time;
            $theDistance .= $distances[$index];
        }

        return $this->calculateTimeAndDistance((int)$theTime, (int)$theDistance);
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
