<?php

// Create array to hold list of todo items
$items = array();

// List array items formatted for CLI
function list_items($list) {
    // Return string of list items separated by newlines.

    $output = '';

    foreach ($list as $key => $item) {
        // Display each item and a newline
        $output .= "[" . ($key + 1) . "] $item" . PHP_EOL;   
     } 
        return $output;
}

// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = FALSE) {   
    $input = trim(fgets(STDIN));
    // Return filtered STDIN input
    return $upper ? strtoupper($input) : $input;
}

function sort_menu($list, $sort_type) {
    switch ($sort_type) {
        case 'A':
            // Alpha sort
            sort($list);
            break;
        case 'Z':
            // Reverse alpha sort
            rsort($list);
            break;
        case 'O':
            // Order according to key
            ksort($list);
            break;
        case 'R':
            // Reverse according to key
            krsort($list);
            break;
        default:
            echo "default.";
            break;
    }
    return $list;
}

// The loop!
do {
    // Echo the list produced by the function
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort items, (Q)uit : ';

    // Get the input from user
    $input = get_input(TRUE);

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = get_input();

    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[$key - 1]);
        // Re-order numerical index of array
        $items = array_values($items);

    } elseif ($input == 'S') {
        echo "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: ";
        $sort_type = get_input(TRUE);
        $items = sort_menu($items, $sort_type);
    }

// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);