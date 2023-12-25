struct ListInformation {
    game_number: u8,
    winning_numbers: Vec<u8>,
    game_numbers: Vec<u8>
}

fn main() {
    let total = process_file("./src/bin/input.txt");

    println!("Total is: {total}");
}

fn process_file(file_name: &str) -> u32 {
    let file_lines = read_file(file_name);
    let mut file_total: u32 = 0;

    let mut list_items: Vec<ListInformation> = vec![];

    for line in file_lines.iter() {
        list_items.push(parse_line(line.to_string()));
    }

    let mut winning_numbers: u32 = 0;

    for item in list_items.iter() {
        println!("Checking game {0}", item.game_number);

        for card_number in item.game_numbers.iter() {
            println!("checking card number {}", card_number);
            if item.winning_numbers.contains(card_number) {
                println!("It is winning!");
                winning_numbers += 1;
            }
        }
        println!("Final winning count is {}", winning_numbers);

        if winning_numbers == 0 {
            continue;
        }

        file_total += 2_u32.pow(winning_numbers - 1);
        winning_numbers = 0;
    }

    return file_total;
}

fn read_file(file_name: &str) -> Vec<String> {
    return std::fs::read_to_string(file_name)
        .unwrap()
        .lines()
        .map(String::from)
        .collect();
}

fn parse_line(file_line: String) -> ListInformation {
    let (game_info, card_information) = file_line.split_once(": ").unwrap();
    let (_, game_number) = game_info.split_once(" ").unwrap();
    let (winning_numbers_string, card_numbers_string) = card_information.split_once(" | ").unwrap();

    let mut winning_numbers: Vec<u8> = vec![];

    for winning_number in winning_numbers_string.split(" ").filter(|&x| !x.is_empty()) {
        winning_numbers.push(winning_number.parse::<u8>().unwrap());
    }

    let mut card_numbers: Vec<u8> = vec![];

    for card_number in card_numbers_string.split(" ").filter(|&x| !x.is_empty()) {
        card_numbers.push(card_number.parse::<u8>().unwrap());
    }

    return ListInformation {
        game_number: game_number.trim().parse::<u8>().unwrap(),
        winning_numbers,
        game_numbers: card_numbers,
    };
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn test_calculation() {
        let value = process_file("./src/bin/test1.txt");
        assert_eq!(value, 13);
    }
}
