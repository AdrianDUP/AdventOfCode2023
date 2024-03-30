package day03

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

type number struct {
    value string
    startingIndex int
}

type symbol struct {
    index int
}

type row struct {
    numbers map[int]number
    symbols map[int]symbol
}

func main() {
    fileName := os.Args[1]

    resultPart1 := processFile(fileName)

    fmt.Println("Total for Part 1 is {}", resultPart1)
}

func processFile(fileName string) int {
    file, err := os.Open(fileName)

    if err != nil {
        return 0
    }

    defer file.Close()

    scanner := bufio.NewScanner(file)
    totalPart1 := 0

    for scanner.Scan() {
        line := scanner.Text()
	lineCharacters := strings.Split(line, "")

	isBuildingNumber := false
	currentNumber := number{}

	row := row{numbers: make(map[int]number), symbols: make(map[int]symbol)}

	for index, character := range lineCharacters {
	    if isInteger(character) {
		if (!isBuildingNumber) {
		    isBuildingNumber = true
		    currentNumber := number{value: "", startingIndex: index}
		}

		currentNumber.value += character
	    } else if (character != ".") {
		symbol := symbol{index: index}
		row.symbols[index] = symbol
	    } else {
		if (isBuildingNumber) {
		    isBuildingNumber = false

		    for i := currentNumber.startingIndex; i < len(currentNumber.value); i++ {
			row.numbers[i] = currentNumber
		    }
		}
	    }
	}
    }

    return totalPart1
}

func isInteger(value string) bool {
    _, err := strconv.Atoi(value)

    return err == nil
}

func makeRow(line string) row {
    lineCharacters := strings.Split(line, "")

    isBuildingNumber := false
    currentNumber := number{}

    row := row{numbers: make(map[int]number), symbols: make(map[int]symbol)}

    for index, character := range lineCharacters {
	if isInteger(character) {
	    if (!isBuildingNumber) {
		isBuildingNumber = true
		currentNumber := number{value: "", startingIndex: index}
	    }

	    currentNumber.value += character
	} else if (character != ".") {
	    symbol := symbol{index: index}
	    row.symbols[index] = symbol
	} else {
	    if (isBuildingNumber) {
		isBuildingNumber = false

		for i := currentNumber.startingIndex; i < len(currentNumber.value); i++ {
		    row.numbers[i] = currentNumber
		}
	    }
	}
    }

    return row
}
