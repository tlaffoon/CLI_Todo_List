<?php

/* -------------------------------------- */

// INITIALIZE EMPTY ARRAY FOR LIST ITEMS

$list = array();

/* -------------------------------------- */

// GET USER INPUT

/*  This function takes in user input, defaulting to lower case
but allowing translation into UPPER case.

  It then returns the user input, trimmed of whitespace. */

function get_input($upper = FALSE) {   

    $input = trim(fgets(STDIN));

    // Return filtered STDIN input
    return $upper ? strtoupper($input) : $input;
}

/* -------------------------------------- */

// LIST ITEMS

/*  This function takes the current list array as input, and 
loops over the items in it to change the array to a string.

  It then returns a string which is the list of the items. */

function output_list($list) {

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

//  ADD ITEM

function add_item($list) {

    // Ask for entry
    echo 'Enter item: ';
    $item = get_input();

    // Add entry to list array
    array_push($list, $item);

    // echo "Input list number for item: ";
    // $key = get_input();
    // ($item, $list[$key - 1]);

    return $list;
}

/* -------------------------------------- */

// REMOVE ITEM

function remove_item($list) {

    // Remove which item?
    echo 'Enter item number to remove: ';

    // Get array key
    $key = get_input();
 
    // Remove from array
    unset($list[$key - 1]);
 
    // Re-order numerical index of array
    return array_values($list);
}

/* -------------------------------------- */

// REMOVE FIRST ITEM

function remove_first($list) {
    unset($list[0]);
    return array_values($list);
}

/* -------------------------------------- */

// REMOVE LAST ITEM

function remove_last($list) {
    unset($list[count($list) - 1]);
    return $list;
}

/* -------------------------------------- */

// OPEN FILE TO POPULATE LIST

function open_file($filename) {

    echo "Please enter filename to open (default: ./data/list.txt): ";
    $filename = get_input();

    if (empty($file) ) {
        $filename = './data/list.txt';
    }

    $handle = fopen($filename, 'r');
    $contents = trim(fread($handle, filesize($filename)));
    $list = explode("\n", $contents);
    fclose($handle);
    return $list;
}

/* -------------------------------------- */

// SAVE LIST TO FILENAME

function save_to_file($list) {

    echo "Please enter filename to save (default: ./data/list.txt): ";
    $filename = get_input();

    if (empty($filename) ) {
        $filename = './data/list.txt';
    }

    if (file_exists($filename)) {
        // warn, prompt, save
        echo "WARNING: Do you want to overwrite your existing file - $filename ? ";
        $choice = get_input(TRUE);
        if ($choice == 'Y' || $choice == 'YES') {
            $handle = fopen($filename, 'w');
            foreach ($list as $item) {
                fwrite($handle, $item . PHP_EOL);
            }
            fclose($handle);        
        } else return "Save $filename canceled by user.\n";
    }  // else nothing.
    return "Successfully saved list to $filename\n";
}   

/* -------------------------------------- */

// SORT LIST

/*  This function takes in the current list and an option for sorting.
  It then returns the list sorted according to the type specified. */

function sort_list($list) {

    echo "(A)lphabetical, (Z) Reverse Alpha, (K)ey Order, (R) Reverse Key: " ;
    $sort_type = get_input();

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
        case 'K':
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

// ********** MAIN LOOP ********** // 

do {

	// Output current list; if empty then blank.
	echo output_list($list);

    // Show the menu options
	echo '(O)pen File, (A)dd item, (R)emove item, (S)ort list, Sa(V)e File, (Q)uit : ';

    // Calls get_input(); to get user menu choice.
    $menu_choice = get_input(TRUE);

    switch ($menu_choice) {
        case 'O':
            $list = open_file($filename);
            break;
        case 'A':
            $list = add_item($list);
            break;
        case 'R':
            $list = remove_item($list);
            break;
        case 'S':
            $list = sort_list($list);
            break;
        case 'F':
            $list = remove_first($list);
            break;
        case 'L':
            $list = remove_last($list);
            break;
        case 'V':
            echo PHP_EOL . save_to_file($list) . PHP_EOL;   
            break;
    }

// Exit when input is (Q)uit
} while ($menu_choice != 'Q');

// ********** LOOP END *********** // 

// Say Goodbye!
echo "Adios!\n";

// Exit with 0 errors
exit(0);