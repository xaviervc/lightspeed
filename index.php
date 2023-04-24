<?php

// 7 unique numbers ranging from 1 to 59
$inputs = ["569815571556", "4938532894754", "1111111", "1234567", "12345678", "472844278465445"];

$inputs = getValidTicket($inputs);

var_dump($inputs);

function getValidTicket(array $inputs) : array
{
    $returnArray = [];
    foreach($inputs as $input) {

        if (strlen($input) < 7 || strlen($input) > 14) {
            continue;
        }
        
        if ($input[0] == 0) {
            continue;
        }

        if (strlen($input) == 7) {
            $exploded = str_split($input);

            if (in_array(0, $exploded)) {
                continue;
            }

            $unique = array_unique($exploded);

            if (count($exploded) !== count($unique)) {
                continue;
            }

            $returnArray[$input] = implode(" ", $exploded);
        }

        if (strlen($input) == 14) {
            $exploded = str_split($input, 2);

            if (in_array(0, $exploded) || in_array(60, $exploded)) {
                continue;
            }

            $unique = array_unique($exploded);

            if (count($exploded) !== count($unique)) {
                continue;
            }

            $returnArray[$input] = implode(" ", $exploded);
        }
        /** Even solutions
         * 8 chars -> 6 single digit, 1 double digit
         * 10 chars -> 4 single, 3 double digit
         * 12 chars -> 2 single, 5 double digit
         */

        /**
         * Loop over string, 
         */
        
        if (strlen($input) % 2 == 0) {
            if (strlen($input) == 8) {
                //for a string with 8 characters, pair first two digits, check if they're between 10-59
                //take the rest of the array as single digits
                //check single digits for duplicates
                //if no dupes, return
                //if dupes shift double digit over one index, repeat
                for ($i=0; $i < strlen($input) - 1; $i++) {
                    $doubleDigit = substr($input, $i, 2);

                    if ($doubleDigit[0] == 0) {
                        continue;
                    }

                    if (!in_array($doubleDigit, range(10, 59))) {
                        continue;
                    }

                    $firstPart = substr($input, 0, $i);
                    $secondPart = substr($input, $i+2);
                    $rest = $firstPart . $secondPart;
                    $singles = str_split($rest);

                    $unique = array_unique($singles);

                    if (count($unique) !== count($singles)) {
                        continue;
                    }

                    $returnArray[$input] = implode(" ", array_merge(str_split($firstPart), [$doubleDigit], str_split($secondPart)));
                    break;
                }
            }

            if (strlen($input) == 12) {
                // for 
                for ($i = 0; $i < strlen($input) - 1; $i++) {
                    $doubleDigit = substr($input, $i, 2);

                    if ($doubleDigit[0] == 0) {
                        continue;
                    }

                    if (!in_array($doubleDigit, range(10, 59))) {
                        continue;
                    }

                    $firstPart = substr($input, 0, $i);
                    $secondPart = substr($input, $i+2);
                    $rest = $firstPart . $secondPart;
                    $singles = str_split($rest);

                    $unique = array_unique($singles);

                    if (count($unique) !== count($singles)) {
                        continue;
                    }

                    $returnArray[$input] = implode(" ", array_merge(str_split($firstPart), [$doubleDigit], str_split($secondPart)));
                    break;
                }
             }
        }

        /** Odd Solutions
         * 9 chars -> 5 singles, 2 doubles
         * 10 chars -> 3 singles, 4 doubles
         * 13 chars -> 1 single, 6 doubles
         */
    }

    return $returnArray;
}