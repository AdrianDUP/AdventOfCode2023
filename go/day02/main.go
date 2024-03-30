package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

type round struct {
    blue int
    red int
    green int
}

type game struct {
    number int
    rounds []round
}

func main() {
    fileName := os.Args[1]
    resultPart1 := part1(fileName)
    resultPart2 := part2(fileName)
    fmt.Println("Total for Part 1 is {}", resultPart1)
    fmt.Println("Total for Part 2 is {}", resultPart2)
}

func part1(fileName string) int {
    file, err := os.Open(fileName)

    if err != nil {
        return 0
    }

    defer file.Close()

    scanner := bufio.NewScanner(file)
    total := 0

    for scanner.Scan() {
        line := scanner.Text()
        game := makeGame(line)

        if (isValidGame(game, 12, 13, 14)) {
            total += game.number
        }
    }

    return total
}

func part2(fileName string) int {
    file, err := os.Open(fileName)

    if err != nil {
        return 0
    }

    defer file.Close()

    scanner := bufio.NewScanner(file)
    total := 0

    for scanner.Scan() {
        line := scanner.Text()
        game := makeGame(line)
        total += powerSet(game)
    }

    return total
}

func makeGame(line string) game {
    gameAndRounds := strings.Split(line, ": ")

    if (len(gameAndRounds) != 2) {
        panic("Invalid Game")
    }

    gameInformation := strings.Split(gameAndRounds[0], " ")
    roundInformation := strings.Split(gameAndRounds[1], "; ")

    gameNumber, err := strconv.Atoi(gameInformation[1])

    if (err != nil) {
        panic("Invalid Game Number")
    }

    game := game{
        number: gameNumber,
        rounds: []round{},
    }

    for _, roundInformation := range roundInformation {
        colorInformation := strings.Split(roundInformation, ", ")
        round := round{
            blue: 0,
            red: 0,
            green: 0,
        }

        for _, colorInformation := range colorInformation {
            colorAndNumber := strings.Split(colorInformation, " ")

            if (len(colorAndNumber) != 2) {
                panic("Invalid Color Information")
            }

            color := colorAndNumber[1]
            number, err := strconv.Atoi(colorAndNumber[0])

            if (err != nil) {
                panic("Invalid Number")
            }

            switch color {
            case "blue":
                round.blue = number
            case "red":
                round.red = number
            case "green":
                round.green = number
            default:
                panic("Invalid Color")
            }
        }

        game.rounds = append(game.rounds, round)
    }

    return game
}

func isValidGame(game game, maxRed, maxGreen, maxBlue int) bool {
    for _, round := range game.rounds {
        if (round.blue > maxBlue || round.red > maxRed || round.green > maxGreen) {
            return false
        }
    }

    return true
}

func powerSet(game game) int {
    red, green, blue := 0, 0, 0

    for _, round := range game.rounds {
        if (round.red > red) {
            red = round.red
        }
        if (round.green > green) {
            green = round.green
        }
        if (round.blue > blue) {
            blue = round.blue
        }
    }

    return red * green * blue
}
