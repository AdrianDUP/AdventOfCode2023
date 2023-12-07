fn main() {
    let file_lines = load_file_lines("./src/bin/input.txt");

    let mut total: i32 = 0;

    for line in file_lines {
        total += process_line_part_one(line);
    }

    println!("{total}");
}

fn load_file_lines(file_name: &str) -> Vec<&str> {
    return std::fs::read_to_string(file_name)
        .unwrap()
        .lines()
        .collect();
}

fn process_line_part_one(line: &str) -> i32 {
    let Some((game, sets_string)) = line.split_once(":");

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
        let (count, color) = cube_count
            .split(" ");

        let limit = match color {
            "red" => red_limit,
            "blue" => blue_limit,
            "green" => green_limit,
            _ => panic!("This should not happen"),
        };

        let number_count = count.trim().parse::<i8>();

        if number_count > limit {
            return false;
        }
    }

    return true;
}
