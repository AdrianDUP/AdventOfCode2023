struct ListInformation {
    game_number: u8,
    winning_numbers: Vec<i8>,
    game_numbers: Vec<i8>
}

fn main() {
    println!("Hello, world!");
}

fn read_files(file_name: &str) -> Vec<String> {
    return std::fs::read_to_string(file_name)
        .unwrap()
        .lines()
        .map(String::from)
        .collect();
}

fn parse_line(file_line: String) -> ListInformation {
    let (game_info, card_information) = file_line.split_once(": ");
    let (game_name, game_number) = game_info.split(" ");
    let (winning_numbers_string, card_numbers_string) = card_information.split(" | ");

    let winning_numbers = winning_numbers_string.split_all(" ");
}

#[cfg(test)]
