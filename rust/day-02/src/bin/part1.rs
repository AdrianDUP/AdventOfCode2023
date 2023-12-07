fn main() {
    let total: i32 = process_file("./src/bin/input.txt");

    println!("{total}");
}

fn process_file(file_name: &str) -> i32 {
    let file_lines = load_file_lines(file_name);

    let mut total: i32 = 0;

    for line in file_lines {
        total += process_line(line);
    }

    return total;
}

fn load_file_lines(file_name: &str) -> Vec<String> {
    return std::fs::read_to_string(file_name)
        .unwrap()
        .lines()
        .map(String::from)
        .collect();
}

fn process_line(line: String) -> i32 {
    let Some((game, sets_string)) = line.split_once(":") else { return 0; };

    let sets = sets_string
        .split(';')
        .collect::<Vec<&str>>();
    let game_number = game
        .split(' ')
        .map(|m| m.trim())
        .collect::<Vec<&str>>()[1]
        .parse::<i32>()
        .unwrap();

    for set in sets.iter() {
        if !is_valid_set(set) {
            return 0;
        }
    }

    return game_number;
}

fn is_valid_set(set: &str) -> bool {
    let red_limit: i8 = 12;
    let blue_limit: i8 = 14;
    let green_limit: i8 = 13;

    let cube_counts = set.split(',').collect::<Vec<&str>>();
    
    for cube_count in cube_counts.iter() {
        let mut cube_count_split = cube_count
            .split_whitespace();

        let count = cube_count_split.next().unwrap();
        let color = cube_count_split.next().unwrap();

        let limit = match color {
            "red" => red_limit,
            "blue" => blue_limit,
            "green" => green_limit,
            _ => panic!("This should not happen"),
        };

        let number_count = count.trim().parse::<i8>().unwrap();

        if number_count > limit {
            return false;
        }
    }

    return true;
}

#[cfg(test)]
mod tests{
    use super::*;

    #[test]
    fn input_calculation() {
        let result = process_file("./src/bin/test1.txt");
        assert_eq!(result, 8);
    }
}
