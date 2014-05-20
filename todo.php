<?php

// Create an empty array to hold list of todo items
$items = array();

/* -------------------------------------- */
/* LIST ITEMS

  This function takes the current list array as input, and 
loops over the items in it to change the array to a string.

  It then returns a string which is the list of the items. */

function list_items($list) {

    // Initialize empty string to eliminate php notice error.
    $output = '';

    // Loop over array items and construct string $output
    foreach ($list as $key => $item) {
        // Display each item and a newline
        $output .= "[" . ($key + 1) . "] $item" . PHP_EOL;   
     } 
        // Return string $output as a product of this function.
        return $output;
}

/* -------------------------------------- */
/* GET USER INPUT

  This function takes in user input, defaulting to lower case
but allowing translation into UPPER case.

  It then returns the user input, trimmed of whitespace. */

function get_input($upper = FALSE) {   

    $input = trim(fgets(STDIN));

    // Return filtered STDIN input
    return $upper ? strtoupper($input) : $input;
}

/* -------------------------------------- */
/* SORT MENU

  This function takes in the current list and an option for sorting.
  It then returns the list sorted according to the type specified. */

function sort_menu($list, $sort_type) {


    // Switch statement $sort_type tells us which sort to use.
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
            echo "Please input a valid sort option." . PHP_EOL;
            break;
    }

    // Returns sorted list.
    return $list;
}

/* -------------------------------------- */
// BEGIN MAIN LOOP

do {
    // Echo the list produced by the function
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort items, (Q)uit : ';

    // Get the input from user
    $input = get_input(TRUE);

/* -------------------------------------- */
//  ADD ITEMS

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        $item = get_input();

    // Prompt user for beginning or end
            echo 'Place new items at (B)eginning or (E)nd of current list?  ';
            $input = get_input(TRUE);

        // Logic for placing at beginning of list.
        if ($input == 'B') {
            array_unshift($items, $item);
        } 

        // Logic for placing at end of list.
        elseif ($input == 'E') {
            array_push($items, $item);
        } 

        // Default option is just to append item to current list.
        else 
            // Add entry to list array
            $items[] = get_input();

/* -------------------------------------- */
//  REMOVE ITEMS

    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[$key - 1]);
        // Re-order numerical index of array
        $items = array_values($items);

/* -------------------------------------- */
//  SORT ITEMS

    } elseif ($input == 'S') {
        echo "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: ";
        $sort_type = get_input(TRUE);
        $items = sort_menu($items, $sort_type);
    }

/* -------------------------------------- */

// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);