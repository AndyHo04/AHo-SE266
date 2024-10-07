<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 2 Assignment</title>
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
        .form {
            margin: 20px;
            padding: 20px;
            border: 1px solid black;
            display: inline-block;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Patient Intake Form</h1>

    <?php  
    // Initialize variables
    $firstName = "";
    $lastName = "";
    $marriageStatus = "";
    $dob = "";
    $heightFeet = "";
    $heightInches = "";
    $weight = "";
    $error = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(filter_input(INPUT_POST, 'first_name') != ''){
            $firstName = filter_input(INPUT_POST, 'first_name');
        } else {
            $error .= 'Must enter a valid first name <br/>';
        }

        if(filter_input(INPUT_POST, 'last_name') != ''){
            $lastName = filter_input(INPUT_POST, 'last_name');
        } else {
            $error .= 'Must enter a valid last name <br/>';
        }

        if (filter_input(INPUT_POST, 'marriage_status') != '') {
            $marriageStatus = filter_input(INPUT_POST, 'marriage_status');
        } else {
            $error .= 'Must select a marriage status <br/>';
        }

        if (filter_input(INPUT_POST, 'dob') != '') {
            $dob = filter_input(INPUT_POST, 'dob');
            if (!isDate($dob)) {
                $error .= 'Must enter a valid date of birth <br/>';
            }
        } else {
            $error .= 'Must enter a valid date of birth <br/>';
        }

        $heightFeet = filter_input(INPUT_POST, 'height_feet', FILTER_VALIDATE_FLOAT);
        $heightInches = filter_input(INPUT_POST, 'height_inches', FILTER_VALIDATE_FLOAT);
        if ($heightFeet !== false && $heightFeet >= 0 && $heightFeet <= 9 && $heightInches !== false && $heightInches >= 0 && $heightInches < 12) {
            // Height is valid and within the range
        } else {
            $error .= 'Must enter a valid height: feet between 0 and 9, inches between 0 and 11 <br/>';
        }

        $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);
        if ($weight !== false && $weight >= 0 && $weight <= 1500) {
            // Weight is valid and within the range
        } else {
            $error .= 'Must enter a valid weight between 0 and 1500 <br/>';
        }

        // Calculate BMI and Age if there are no errors
        if (empty($error)) {
            $age = age($dob);
            $bmi = bmi($heightFeet, $heightInches, $weight);
            $bmiDescription = bmiDescription($bmi);
        }
    }

    // Functions
    // This function will check the age and returns the age
    function age($bdate) {
        $date = new DateTime($bdate);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }

    // This function will check if the date is valid
    function isDate($dt) {
        $date_arr = explode('-', $dt);
        if (count($date_arr) == 3) {
            $year = (int)$date_arr[0];
            $month = (int)$date_arr[1];
            $day = (int)$date_arr[2];
            return checkdate($month, $day, $year);
        }
        return false;
    }

    function bmi($ft, $inch, $weight) {
        // Convert height to inches
        $totalInches = ($ft * 12) + $inch;
        
        // Convert height to meters
        $heightMeters = $totalInches * 0.0254;
        
        // Convert weight to kilograms
        $weightKg = $weight / 2.20462;
        
        // Calculate BMI
        $bmi = $weightKg / ($heightMeters * $heightMeters);
        
        return round($bmi, 1); // Return BMI with one decimal place
    }

    function bmiDescription($bmi) {
        if ($bmi < 18.5) {
            return "Underweight";
        } elseif ($bmi >= 18.5 && $bmi < 24.9) {
            return "Normal weight";
        } elseif ($bmi >= 25 && $bmi < 29.9) {
            return "Overweight";
        } else {
            return "Obesity";
        }
    }
    ?>

    <div class="form">
        <form name="patient-intake-form" method="post">
            <div>
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" value="<?= htmlspecialchars($firstName); ?>">
            </div>

            <div>
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" value="<?= htmlspecialchars($lastName); ?>">
            </div>

            <div>
                <label for="marriage_status">Marriage Status:</label>
                <input type="radio" name="marriage_status" value="1" <?= $marriageStatus == 1 ? 'checked' : ''; ?>> Yes
                <input type="radio" name="marriage_status" value="0" <?= $marriageStatus == 0 ? 'checked' : ''; ?>> No
            </div>

            <div>
                <label for="dob">Date of Birth(ex:2004-10-29):</label>
                <input type="text" name="dob" value="<?= htmlspecialchars($dob); ?>">
            </div>

            <div>
                <label for="height_feet">Height (Feet):</label>
                <input type="text" name="height_feet" value="<?= htmlspecialchars($heightFeet); ?>">
            </div>

            <div>
                <label for="height_inches">Height (Inches):</label>
                <input type="text" name="height_inches" value="<?= htmlspecialchars($heightInches); ?>">
            </div>

            <div>
                <label for="weight">Weight:</label>
                <input type="text" name="weight" value="<?= htmlspecialchars($weight); ?>">
            </div>

            <div>
                <input type="submit" value="Submit" style="background-color: blue; color: white;">
            </div>
        </form>
    </div>

    <!-- Display the error message and if there are no error messages, display the result -->
    <?php if (empty($error) && $_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div>
        <h2>Form Results</h2>
        <p>First Name: <?= htmlspecialchars($firstName); ?></p>
        <p>Last Name: <?= htmlspecialchars($lastName); ?></p>
        <p>Marriage Status: <?= $marriageStatus == 1 ? 'Yes' : 'No'; ?></p>
        <p>Date of Birth: <?= htmlspecialchars($dob); ?></p>
        <p>Age: <?= htmlspecialchars($age); ?></p>
        <p>Height: <?= htmlspecialchars($heightFeet) . ' feet ' . htmlspecialchars($heightInches) . ' inches'; ?></p>
        <p>Weight: <?= htmlspecialchars($weight); ?> pounds</p>
        <p>BMI: <?= htmlspecialchars($bmi); ?></p>
        <p>BMI Description: <?= htmlspecialchars($bmiDescription); ?></p>
    </div>
    <?php else: ?>
    <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>
    
    <?php
    include '../include/footer.php';
    ?>
</body>
</html>