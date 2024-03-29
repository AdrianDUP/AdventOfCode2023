struct ListInformation {
    game_number: u8,
    winning_numbers: Vec<u8>,
    game_numbers: Vec<u8>,
}

fn main() {
    let total = process_file("./src/bin/input.txt");

    println!("Total is: {total}");
}

fn process_file(file_name: &str) -> u32 {
    let file_lines = read_file(file_name);
    let mut file_total: u32 = 0;
    let mut count_additions: Vec<u32> = vec![];

    for line in file_lines.iter() {
        let list_item = parse_line(line.to_string());

        println!("Checking game {0}", list_item.game_number);

        let mut copies: u32 = 1;
        let mut winning_numbers: u32 = 0;

        for card_number in list_item.game_numbers.iter() {
            if list_item.winning_numbers.contains(card_number) {
                winning_numbers += 1;
            }
        }

        println!("Final winning count is {}", winning_numbers);

        if !count_additions.is_empty() {
            copies += *count_additions.first().unwrap();
            count_additions.remove(0);
        }

        println!("Count modifier is {}", copies);

        if winning_numbers > 0 {
            for _ in 0..copies {
                for i in 0..winning_numbers {
                    if count_additions.len() <= i.try_into().unwrap() {
                        count_additions.push(1);
                    } else {
                        count_additions[i as usize] += 1;
                    }
                }
            }
        }

        println!("Count additions: {:?}", count_additions);

        file_total += copies;
    }

    return file_total;
    //
    // let mut winning_numbers: u8 = 0;
    // let mut additions: HashMap<u8, u8> = HashMap::new();
    //
    // for item in list_items.iter() {
    //     println!("Checking game {0}", item.game_number);
    //
    //     let mut addition_value: u8 = 0;
    //
    //     if additions.contains_key(&item.game_number) {
    //         addition_value = *additions.get(&item.game_number).unwrap();
    //     }
    //
    //     for card_number in item.game_numbers.iter() {
    //         println!("checking card number {}", card_number);
    //         if item.winning_numbers.contains(card_number) {
    //             println!("It is winning!");
    //             winning_numbers += 1;
    //         }
    //     }
    //     println!("Final winning count is {}", winning_numbers);
    //
    //     if winning_numbers == 0 {
    //         continue;
    //     }
    //
    //     for i in 0..winning_numbers {
    //         let update_index = i + item.game_number + 1;
    //
    //         if additions.contains_key(&update_index) {
    //             additions.insert(update_index, additions.get(&update_index).unwrap() + 1);
    //         }
    //     }
    //
    //     file_total += 1_u32 + addition_value as u32;
    // }
    //
    // return file_total;
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
        assert_eq!(value, 30);
    }
}
