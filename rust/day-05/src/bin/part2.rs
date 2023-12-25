use std::collections::HashMap;
use chrono::Utc;

fn main() {
    println!("Started at {}", Utc::now());
    let smallest_value = process_file("./src/bin/input.txt");
    println!("{smallest_value}");
    println!("Finished at {}", Utc::now());
}

fn process_file(file_name: &str) -> u64 {
    let mut sources: Vec<u64> = vec![];
    let mut destinations: Vec<u64> = vec![];

    let file_lines = read_file(file_name);

    for (index, line) in file_lines.iter().enumerate() {
        //println!("Checking line: {}", line);
        if index == 0 {
            sources = make_seed_list(line.to_string());
            continue;
        }
        if line == "" {
            continue;
        }
        if line.ends_with(":") {
            sources = finalise_sources(sources, destinations);
            destinations = vec![];
            continue;
        }

        if sources.is_empty() {
            continue;
        }

        let range = make_range_map(line.to_string());

        let source_start = *range.get("source_start").unwrap();
        let source_end = *range.get("source_end").unwrap();
        let destination_start = *range.get("destination_start").unwrap();

        let mut new_sources: Vec<u64> = vec![];

        for (_index, source) in sources.iter().enumerate() {
            //println!("Checking source {}", source);
            if source < &source_start || source > &source_end {
                //println!("Source {} not between {} and {}", source, source_start, source_end);
                new_sources.push(*source);
                continue;
            }

            destinations.push(&destination_start + source - source_start);
        }

        sources = new_sources;
    }

    sources = finalise_sources(sources, destinations);

    let mut smallest_location: u64 = 0;

    for (_index, source) in sources.iter().enumerate() {
        if smallest_location == 0 || smallest_location > *source {
            smallest_location = *source;
        }
    }

    return smallest_location;
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
    let seed_list_values: Vec<u64> = seed_list_string.split(" ").map(|m| m.trim().parse::<u64>().unwrap()).collect();

    let mut counter = 0;
    let mut final_seeds: Vec<u64> = vec![];
    let mut seed_start: u64 = 0;
    let mut seed_values: u64;

    for current_seed in seed_list_values.iter() {
        if counter == 0 {
            seed_start = *current_seed;
            counter += 1;
            continue;
        }
        if counter == 1 {
            seed_values = *current_seed;
            for index in 0..seed_values {
                final_seeds.push(seed_start + index);
            }
            counter = 0;
        }
    }

    return final_seeds;
}

fn make_range_map(file_line: String) -> HashMap<String, u64> {
    //println!("{}", file_line);
    let map_parts: Vec<u64> = file_line.split(" ").map(|m| m.trim().parse::<u64>().unwrap()).collect();

    let mut map: HashMap<String, u64> = HashMap::new();

    map.insert("destination_start".to_string(), map_parts[0]);
    map.insert("destination_end".to_string(), map_parts[0] + map_parts[2] - 1);
    map.insert("source_start".to_string(), map_parts[1]);
    map.insert("source_end".to_string(), map_parts[1] + map_parts[2] - 1);

    return map;
}

fn finalise_sources(sources: Vec<u64>, destinations: Vec<u64>) -> Vec<u64> {
    let mut new_sources = sources;

    for destination in destinations {
        new_sources.push(destination);
    }

    return new_sources;
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn test_calculation() {
        let value = process_file("./src/bin/test1.txt");
        assert_eq!(value, 46);
    }
}
