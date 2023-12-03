use std::fs;

fn main() {
    let result = calculate_total(&mut read_file_lines("./src/bin/input.txt"));

    println!("{result}");
}

fn read_file_lines(file_name: &str) -> Vec<String> {
    return fs::read_to_string(file_name)
        .unwrap()
        .lines()
        .map(String::from)
        .collect();
}

fn calculate_total(input: &mut Vec<String>) -> String {
    let regex = regex::Regex::new(r"[0-9]").unwrap();

    let lines_iterator = input.iter_mut();

    let mut total: i32 = 0;

    for line in lines_iterator {
        let converted_line = convert_line_to_numbers(line);

        let matches: Vec<&str> = regex.find_iter(&converted_line).map(|m| m.as_str()).collect();

        if matches.len() == 0 {
            continue;
        }

        let first_number: &str = matches[0];
        let second_number: &str = matches[matches.len() - 1];

        let final_number_string = format!("{first_number}{second_number}");

        println!("Adding number {final_number_string}");

        total += final_number_string.parse::<i32>().unwrap();
    }

    return total.to_string();
}

fn convert_line_to_numbers(line: &str) -> String {
    return line.replace("oneight", "18")
        .replace("nineight", "98")
        .replace("twone", "21")
        .replace("threeight", "38")
        .replace("sevenine", "79")
        .replace("eightwo", "82")
        .replace("eighthree", "83")
        .replace("one", "1")
        .replace("two", "2")
        .replace("three", "3")
        .replace("four", "4")
        .replace("five", "5")
        .replace("six", "6")
        .replace("seven", "7")
        .replace("eight", "8")
        .replace("nine", "9")
        .to_string();
}

#[cfg(test)]
mod tests{
    use super::*;

    #[test]
    fn input_calculation() {
        let result = calculate_total(&mut read_file_lines("./src/bin/test_input2.txt"));
        assert_eq!(result, "281".to_string());
    }
}
