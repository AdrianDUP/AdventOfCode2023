use std::collections::HashMap;

fn main() {
    let smallest_value = process_file("./src/bin/input.txt");
    println!("{smallest_value}");
}

fn process_file(file_name: &str) -> u64 {
    let mut current_map: HashMap<u64, u64> = HashMap::with_capacity(<u64 as TryInto<usize>>::try_into(2_u64.pow(31)).unwrap() - 1);
    let mut seed_to_soil_ranges: Vec<HashMap<String, u64>> = vec![];
    let mut seeds: Vec<u64> = vec![];
    let mut smallest_values: HashMap<u64, u64> = HashMap::new();
    let mut currently_mapping = 0;

    let file_lines = read_file(file_name);

    for (index, line) in file_lines.iter().enumerate() {
        if index == 0 {
            seeds = make_seed_list(line.to_string());
            continue;
        }
        if line == "" {
            continue;
        }

        if (line.ends_with(":")) {
            continue;
        }

        let range = make_range_map(line.to_string());

        for seed in seeds.iter() {
            if is_seed_in_range(*seed, range) {
                let seed_destination = get_seed_destination(*seed, range);
            }
        }


        if line.starts_with("seed-to-soil") {
            println!("Seed to soil");
            currently_mapping = 1;
        } else if line.starts_with("soil-to-fertilizer") {
            currently_mapping = 2;
        } else if line.starts_with("fertilizer-to-water") {
            currently_mapping = 3;
        } else if line.starts_with("water-to-light") {
            currently_mapping = 4;
        } else if line.starts_with("light-to-temperature") {
            currently_mapping = 5;
        } else if line.starts_with("temperature-to-humidity") {
            currently_mapping = 6;
        } else if line.starts_with("humidity-to-location") {
            currently_mapping = 7;
        } else {
            if currently_mapping == 1 {
                println!("Creating map from {line}");
                let range = make_range_map(line.to_string());

                for seed in seeds.iter() {
                    if seed > range.get("source_start").unwrap() && seed < range.get("source_end").unwrap() {
                        let offset = seed - range.get("source_start").unwrap();
                        let mut destination = range.get("destination_start").unwrap() + offset;

                        if smallest_values.entry(*seed).or_insert(destination) > &mut destination {
                            smallest_values.insert(*seed, destination);
                        }
                    }
                }
            } else {
                let range = make_range_map(line.to_string());

                for seed in seeds.iter() {
                    if seed > range.get("source_start").unwrap() && seed < range.get("source_end").unwrap() {
                        let offset = seed - range.get("source_start").unwrap();
                        let mut destination = range.get("destination_start").unwrap() + offset;

                        if smallest_values.entry(*seed).or_insert(destination) > &mut destination {
                            smallest_values.insert(*seed, destination);
                        }
                    }
                }
            }
        }
    }

    let mut smallest_seed: u64 = 0;

    for value in smallest_values.iter() {
        if smallest_seed == 0 {
            smallest_seed = *value.1;
        } else if smallest_seed > *value.1 {
            smallest_seed = *value.1;
        }
    }

    return smallest_seed;
}

fn read_file(file_name: &str) -> Vec<String> {
    return std::fs::read_to_string(file_name)
        .unwrap()
        .lines()
        .map(String::from)
        .collect();
}

fn make_seed_list(file_line: String) -> Vec<u64> {
    let seed_list_string = file_line.split_once(":").unwrap().1.trim();
    return seed_list_string.split(" ").map(|m| m.trim().parse::<u64>().unwrap()).collect();
}

fn make_map(existing_map: &mut HashMap<u64, u64>, file_line: String) {
    let map_parts: Vec<u64> = file_line.split(" ").map(|m| m.trim().parse::<u64>().unwrap()).collect();

    let mut destination: u64 = map_parts[0];
    let mut source: u64 = map_parts[1];
    let range: u64 = map_parts[2];

    let mut counter = 0;

    while counter < range {
        existing_map.insert(source, destination);
        source += 1;
        destination += 1;
        counter += 1;
    }
}

fn get_seed_destination(seed: u64, range: HashMap<String, u64>) -> u64 {
    return *range.get("destination_start").unwrap() + (seed - *range.get("source_start").unwrap());
}

fn make_range_map(file_line: String) -> HashMap<String, u64> {
    println!("{}", file_line);
    let map_parts: Vec<u64> = file_line.split(" ").map(|m| m.trim().parse::<u64>().unwrap()).collect();

    let mut map: HashMap<String, u64> = HashMap::new();

    map.insert("destination_start".to_string(), map_parts[0]);
    map.insert("destination_end".to_string(), map_parts[0] + map_parts[2]);
    map.insert("source_start".to_string(), map_parts[1]);
    map.insert("source_end".to_string(), map_parts[1] + map_parts[2]);

    return map;
}

fn is_seed_in_range(seed: u64, range: HashMap<String, u64>) -> bool {
    return seed >= *range.get("source_start").unwrap() && seed <= *range.get("source_end").unwrap();
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
