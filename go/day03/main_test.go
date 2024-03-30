package day03

import "testing"

func TestProcessFilePart1(t *testing.T) {
    fileName := "test.txt"
    result := processFile(fileName)

    if result != 4361 {
	t.Fatalf("Expected 4361, got %d", result)
    }
}
