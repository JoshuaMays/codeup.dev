<?php
    // ALPHABETIC PASSWORD SEEDER
    $seed = str_split('abcdefghijklmnopqrstuvwxyz'.
                      'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    // ALPHANUMERIC AND SPECIAL CHARACTER PASSWORD SEEDER
    $strongerSeed = str_split('1234567890`~!@#$%^&*()-_+=');

    $password = '';
    
    // GRAB USER INPUT
    function getInput() {
        $userInput = trim(strtoupper(fgets(STDIN)));

        return $userInput;
    }

    // CHECK IF USER ENTERED A LENGTH BETWEEN 8 AND 128
    function validatePassLength($length) {
        if (ctype_digit($length) && ($length >= 8 && $length <= 128)) {
            return true;
        }
        return false;
    }

    // GENERATE A RANDOM PASSWORD
    function makeRandomPassword($seed, $length) {
        foreach(array_rand($seed, $length) as $key => $value) {
            $password .= $seed[$value];
        }
        return $password;
    }
    
    do {
        fwrite(STDOUT, 'How many many characters long do you want your password?: ' . PHP_EOL);
        $length = getInput();

        // TRY TO GENERATE PASSWORD IF LENGTH IS VALID
        if (validatePassLength($length)) {
            // CHECK IF USER WANTS NUMBERS AND SPECIAL CHARS INCLUDED IN PASSWORD
            do {
                fwrite(STDOUT, 'Do you want your password to contain special characters? Y/N: ' . PHP_EOL);
                $isStronger = getInput();
                switch($isStronger) {
                    case 'Y':
                        $validStrengthInput = true;
                        $strong = true;
                        break;
                    case 'N':
                        $validStrengthInput = true;
                        $strong = false;
                        break;
                    default:
                        $validStrengthInput = false;
                        continue;
                }
            
            } while (!$validStrengthInput);

            // IF STRONGER PASSWORD NEEDED, ADD SPECIAL CHARS TO SEED 
            $seed = $strong ? array_merge($seed, $strongerSeed) : $seed;

            // GENERATE THE PASSWORD
            $password = makeRandomPassword($seed, $length);
            $passGenerated = true;
        }
        // INVALID LENGTH OF PASSWORD REQUESTED
        else {
            fwrite(STDOUT, 'Sorry, please give me a number between 8 and 128 for the length.' . PHP_EOL);
            $passGenerated = false;
        }
    } while (!$passGenerated);
    
    fwrite(STDOUT, $password);
    
?>

