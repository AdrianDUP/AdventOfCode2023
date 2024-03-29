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

    if (err != nil) {
        fmt.Println("Error: ", err)
        return;
    }

    defer file.Close()

    scanner := bufio.NewScanner(file)
    var lines []string
    total := 0

    for scanner.Scan() {
        lines = append(lines, scanner.Text())
        number := getNumberFromLine(scanner.Text())
        total += number
        fmt.Println("Number: ", number)
    }

    fmt.Println("Total: ", total)
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
