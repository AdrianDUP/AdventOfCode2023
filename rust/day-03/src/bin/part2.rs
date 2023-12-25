use std::collections::HashMap;

fn main() {
    println!("Hello, world!");
}

fn process_file(file_name: &str) -> i32 {
    let mut line1: String;
    let mut line1_hashmap: HashMap<usize, u16>;
    let mut line2: String;
    let mut line2_hashmap: HashMap<usize, u16>;
    let mut line3: String;
    let mut line3_hashmap: HashMap<usize, u16>;

    let lines = read_file(file_name);

    for (index, line) in lines.iter().enumerate() {
        line1 = line2;
        line1_hashmap = line2_hashmap;
        line2 = line3;
        line2_hashmap = line3_hashmap;
        line3 = line.to_string();
        line3_hashmap = find_line_numbers(line.to_string());

        if index < 1 {
            continue;
        }
    }

    return 0;
}

fn process_lines(line1_numbers: HashMap<usize, u16>, line2: String, line2_numbers: HashMap<usize, u16> line3_numbers: HashMap<usize, u16>) -> u32 {
    let line2_chars: Vec<char> = line2.chars().collect();
    let mut previous_character: char;

    for (index, character) in line2_chars.iter().enumerate() {
        if character.to_string() != "*" {
            continue;
        }

        let mut numbers_touching = 0;
        
        if index > 0 {
            let previous_index = index - 1;

            if line1_numbers.contains_key(index) {

            }
        }
    }

    return 0;
}

fn find_line_numbers(line: String) -> HashMap<usize, u16>{
    let mut current_number = String::new();
    let mut indexes: Vec<usize> = vec![];
    let mut number_indexes: HashMap<usize, u16> = HashMap::new();

    let line_characters: Vec<char> = line.chars().collect();

    for (index, character) in line_characters.iter().enumerate() {
        if !character.is_digit(10) {
            if !current_number.is_empty() {
                for index in indexes.iter() {
                    number_indexes.insert(*index, current_number.parse::<u16>().unwrap());
                }
                current_number = String::new();
                indexes = vec![];
            }
            continue;
        }

        current_number.push(*character);
        indexes.push(index);
    }

    return number_indexes;
}

fn read_file(file_name: &str) -> Vec<String> {
    return std::fs::read_to_string(file_name)
        .unwrap()
        .lines()
        .map(String::from)
        .collect();
}

#[cfg(test)]
mod tests{
    use super::*;

    #[test]
    fn input_calculation() {
        let result = process_file("./src/bin/test2.txt");
        assert_eq!(result, 467835);
    }

    #[test]
    fn test_find_line_numbers() {
        let mut expected: HashMap<usize, u16> = HashMap::new();
        expected.insert(3, 456);
        expected.insert(4, 456);
        expected.insert(5, 456);

        let line = "...456...$.".to_string();

        assert_eq!(find_line_numbers(line.to_string()), expected);
    }
}
