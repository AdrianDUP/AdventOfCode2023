use std::collections::HashMap;

fn main() {
    println!("Hello, world!");
}

fn process_file(file_name: &str) -> i32 {
    let mut line1: String;
    let mut line1_hashmap: HashMap<i8, i16>;
    let mut line2: String;
    let mut line2_hashmap: HashMap<i8, i16>;
    let mut line3: String;
    let mut line3_hashmap: HashMap<i8, i16>;

    return 0;
}

fn process_lines(line1_numbers: HashMap<i8, i16>, line2: String, line3: HashMap<i8, i16>) -> i32 {
    let line2_chars: Vec<char> = line2.chars().collect();
    let mut previous_character: char;

    for (index, character) in line2_chars.iter().enumerate() {
        if character.to_string() != "*" {
            continue;
        }
        
        if index > 0 {
            let previous_index = index - 1;
        }
    }
}

#[cfg(test)]
mod tests{
    use super::*;

    #[test]
    fn input_calculation() {
        let result = process_file("./src/bin/test2.txt");
        assert_eq!(result, 467835);
    }
}
