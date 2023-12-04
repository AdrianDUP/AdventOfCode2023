<?php

namespace Adrian\AdventOfCode2023\Solver;

class SolverTwo
{
    private $listOfNumbersToSum;

    public function checkLine(string $line): int
    {
        list($game, $setsList) = explode(':', $line);

        list($gameName, $gameNumber) = explode(' ', $game);

        $gameNumber = (int)trim($gameNumber);

        $sets = explode(';', $setsList);

        foreach($sets as $set) {
            if (!$this->isValidSet($set)) {
                return 0;
            }
        }

        return $gameNumber;
    }

    public function getLinePower(string $line): int
    {
        list($game, $setsList) = explode(':', $line);

        $sets = explode(';', $setsList);

        $red = 0;
        $blue = 0;
        $green = 0;

        foreach($sets as $set) {
            $minimums = $this->getCubeCountsOfSet($set);
            $red = $minimums['red'] > $red ? $minimums['red'] : $red;
            $blue = $minimums['blue'] > $blue ? $minimums['blue'] : $blue;
            $green = $minimums['green'] > $green ? $minimums['green'] : $green;
        }

        return $red * $blue * $green;
    }

    private function isValidSet($set): bool
    {
        $redLimit = 12;
        $greenLimit = 13;
        $blueLimit = 14;

        $cubeCounts = explode(',', $set);

        foreach($cubeCounts as $cubeCount) {
            list($count, $color) = explode(' ', trim($cubeCount));

            switch ($color) {
            case 'red':
                $limit = $redLimit;
                break;
            case 'blue':
                $limit = $blueLimit;
                break;
            case 'green':
                $limit = $greenLimit;
                break;
            }

            if ((int)$count > $limit) {
                return false;
            }
        }

        return true;
    }

    private function getCubeCountsOfSet(string $gameSet): array
    {
        $minimumBlue = 0;
        $minimumRed = 0;
        $minimumGreen = 0;

        $cubeCounts = explode(',', $gameSet);

        foreach ($cubeCounts as $cubeCount) {
            list($count, $color) = explode(' ', trim($cubeCount));

            $count = (int) $count;

            switch ($color) {
            case 'red':
                if ($count > $minimumRed) {
                    $minimumRed = $count;
                }
                break;
            case 'blue':
                if ($count > $minimumBlue) {
                    $minimumBlue = $count;
                }
                break;
            case 'green':
                if ($count > $minimumGreen) {
                    $minimumGreen = $count;
                }
                break;
            }
        }

        return [
            'red' => $minimumRed,
            'blue' => $minimumBlue,
            'green' => $minimumGreen,
        ];
    }
}
