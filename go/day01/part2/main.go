package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func main() {
    fileName := os.Args[1]
    file, err := os.Open(fileName)

    if err != nil {
        fmt.Println("Error: ", err)
        return
    }

    defer file.Close()

    scanner := bufio.NewScanner(file)
    total := 0

    for scanner.Scan() {
        line := scanner.Text()
        line = replaceWordsWithDigits(line)
        number := getNumberFromLine(line)
        fmt.Println("Number: ", number)
        total += number
    }

    fmt.Println("Total: ", total)
}

func replaceWordsWithDigits(line string) string {
    line = strings.ReplaceAll(line, "sevenine", "79")
    line = strings.ReplaceAll(line, "eightwo", "82")
    line = strings.ReplaceAll(line, "nineight", "98")
    line = strings.ReplaceAll(line, "twone", "21")
    line = strings.ReplaceAll(line, "threeight", "38")
    line = strings.ReplaceAll(line, "fiveight", "58")
    line = strings.ReplaceAll(line, "eighthree", "83")
    line = strings.ReplaceAll(line, "one", "1")
    line = strings.ReplaceAll(line, "two", "2")
    line = strings.ReplaceAll(line, "three", "3")
    line = strings.ReplaceAll(line, "four", "4")
    line = strings.ReplaceAll(line, "five", "5")
    line = strings.ReplaceAll(line, "six", "6")
    line = strings.ReplaceAll(line, "seven", "7")
    line = strings.ReplaceAll(line, "eight", "8")
    line = strings.ReplaceAll(line, "nine", "9")

    return line
}

func getNumberFromLine(line string) int {
    fmt.Println("Parsing Line: ", line)
    characters := strings.Split(line, "")

    var first, last string

    for _, character := range characters {
        fmt.Println("Parsing Character: ", character)
        _, err := strconv.Atoi(character)

        if (err != nil) {
            continue
        }

        if (first == "") {
            first = character
        }

        last = character
    }

    finalNumber, err := strconv.Atoi(first + last)

    if (err != nil) {
        fmt.Println("Error: ", err)
        return 0
    }

    return finalNumber
}
