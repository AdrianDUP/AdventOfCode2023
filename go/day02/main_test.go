package main

import "testing"

func TestPart1(t *testing.T) {
    fileName := "test.txt"
    result := part1(fileName)

    if (result != 8) {
        t.Fatalf("Expected 8, got %d", result)
    }
}

func TestPart2(t *testing.T) {
    fileName := "test.txt"
    result := part2(fileName)

    if (result != 2286) {
        t.Fatalf("Expected 2286, got %d", result)
    }
}
