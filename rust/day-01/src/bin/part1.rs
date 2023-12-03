use std::fs;

fn main() {
    let result = calculate_total(read_file_lines("./src/bin/input.txt"));

    println!("{result}");
}

fn read_file_lines(file_name: &str) -> Vec<String> {
    return fs::read_to_string(file_name)
        .unwrap()
        .lines()
        .map(String::from)
        .collect();
}

fn calculate_total(input: Vec<String>) -> String {
    let regex = regex::Regex::new(r"[0-9]").unwrap();

    let lines_iterator = input.iter();

    let mut total: i32 = 0;

    for line in lines_iterator {
        let matches: Vec<&str> = regex.find_iter(line).map(|m| m.as_str()).collect();

        if matches.len() == 0 {
            continue;
        }

        let first_number: &str = matches[0];
        let second_number: &str = matches[matches.len() - 1];

        let final_number_string = format!("{first_number}{second_number}");

        total += final_number_string.parse::<i32>().unwrap();
    }

    return total.to_string();
}

#[cfg(test)]
mod tests{
    use super::*;

    #[test]
    fn input_calculation() {
        let result = calculate_total(read_file_lines("./src/bin/test_input.txt"));
        assert_eq!(result, "142".to_string());
    }
}
