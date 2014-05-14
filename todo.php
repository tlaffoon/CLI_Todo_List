<?php

// Create array to hold list of todo items
$items = array();

// Main Loop
do {

    // Iterate through list items
    foreach ($items as $item_num => $item_value) {
        // Display each item and a newline
        echo "[{$item_num}] {$item_value}\n";
    }

    // Show the menu options
    echo '(N)ew item, (R)emove item, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = trim(fgets(STDIN));

    // Check for actionable input
    if ($input == 'N' || $input == 'n') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = trim(fgets(STDIN));

    } elseif ($input == 'R' || $input == 'r') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = trim(fgets(STDIN));
        // Remove from array
        unset($items[$item_num]);

    }
    // This code unshifts the array to list items starting with 1, instead of 0.
    // array_unshift
    array_unshift($items,"");
    // unset
    unset($items[0]);

// Exit when input is (Q)uit
} while ($input != 'Q' && $input != 'q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);