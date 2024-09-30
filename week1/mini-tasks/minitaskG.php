<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Task G</title>
    <style>
       /*puts the content in the center of the page*/
       body {
           font-family: Arial, sans-serif;
           margin: 20px;
           text-align: center;
       }
       ul {
           display: inline-block;
           text-align: left;
       }
    </style>
</head>
<body>
    <h1> Mini Task G - Fizz Buzz</h1>

    <?php 
        /* Return Fizz Buzz if multiple of 2 and 3 (6)
        Return Fizz if multiple of 2
        Return Buzz if multiple of 3
        Return $num otherwise
        */
        function fizzBuzz($num) 
        {
            if ($num % 2 == 0 && $num % 3 == 0) {
                return "Fizz Buzz";
            } elseif ($num % 2 == 0) {
                return "Fizz";
            } elseif ($num % 3 == 0) {
                return "Buzz";
            } else {
                return $num;
            }
        }

        // loop through numbers 1 to 100
        for ($i = 1; $i <= 100; $i++) {
            echo fizzBuzz($i) . "<br>";
        }
    ?>
</body>
</html>