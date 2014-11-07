<?php
$error = false;
$sum = 0;
$errorMessage = 'Please use only digits (0-9)';


// CHECK IF INPUT IS A DIGIT
function checkIfDigit($input) {
    if (ctype_digit($input)){
        return true;
    }
    return false;
}

if (isset($_POST['userInput'])) {
    // SPLIT INPUT STRING INTO AN ARRAY
    $inputArray = str_split($_POST['userInput']);
    
    foreach ($inputArray as $id => $number) {
        // IF INPUT IS A DIGIT, CAST TO AN INT
        if (checkIfDigit($number)){
            $inputArray[$id] = (int) $number;
        }
        else {
            $error = true;
            break;
        }
        $sum += $number;
    }

}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sum Input</title>
        <meta name="description">
        <meta name="keywords" content="fashion,">
        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1 class="text-center">Let's Sum the Digits!</h1>
        
        <form action="/sums.php" method="POST" role="form" class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="userInput">What integers do you want to sum?</label>
                <input name="userInput" type="text" class="form-control" id="userInput" placeholder="34121...">
                <!-- DISPLAY ERROR MESSAGE IF INPUT DOES NOT CONTAIN DIGITS -->
                <? if (isset($error) && ($error)) : ?>
                    <span class="alert alert-danger alert-dismissible help-block"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> <?= $errorMessage; ?></span>
                <? endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- DISPLAY SUM IF NO ERRORS -->
        <? if (!($error)) : ?>
            <div class="col-md-6 col-md-offset-3">
                <p>The sum is: <?= $sum ?></p>
            </div>
        <? endif ?>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
</html>

