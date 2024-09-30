<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Task F</title>
    <style>
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
    <h1>Mini Task F - Functions</h1>
    <?php 
        //this function will check the age and return a boolean
        function checkAge($age) {
            if ($age >= 21) {
                return true;
            } else {
                return false;
            }
        }
        //check if they can go into the nightclub
        if (checkAge(25)) {
            echo "You can go into the nightclub";
        } else {
            echo "You cannot go into the nightclub";
        }
        echo "<br>";
        echo "<br>";
        if (checkAge(15)) {
            echo "You can go into the nightclub";
        } else {
            echo "You cannot go into the nightclub";
        }
    ?>
   
</body>
</html>