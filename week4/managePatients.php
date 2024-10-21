<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 4 Assignment</title>
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
    <a href = "viewPatients.php">Back to View All Patients</a>
    <h2> Add New Patient</h2>

    <?php  
    include "functions_patients.php";

    // Initialize variables
    $firstName = "";
    $lastName = "";
    $marriageStatus = "";
    $dob = "";
    $error = "";

    // Check if the form is submitted and if the patient can be added to the database
    if (isset($_POST['storePatient'])) {
        $firstName = filter_input(INPUT_POST, 'first_name');
        $lastName = filter_input(INPUT_POST, 'last_name');
        $marriageStatus = filter_input(INPUT_POST, 'marriage_status');
        $dob = filter_input(INPUT_POST, 'dob');

        // Check if the first name is empty
        if ($firstName == "") $error .= "<li>Please provide first name</li>";
        // Check if the last name is empty
        if ($lastName == "") $error .= "<li>Please provide last name</li>";
        // Check if the marriage status is empty
        if ($marriageStatus == "") $error .= "<li>Please provide marriage status</li>";
        // Check if the date of birth is empty
        if ($dob == "") $error .= "<li>Please provide date of birth</li>";
        // Check if the date of birth is valid
        if (!isDate($dob)) $error .= "<li>Please provide a valid date of birth</li>";

        // If there are no errors, add the patient to the database
        if ($error == "") {
            addPatient($firstName, $lastName, $marriageStatus, $dob);
            header('Location: viewPatients.php');
            exit();
        }
    }

    // Functions
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
    ?>

    <div class="container">
        <div class="col-sm-12">
            <form name="patients" method="post" class="form">
                <?php
                if ($error != ""):
                ?>
                <div class="error">
                    <p>Please fix the following and resubmit:</p>
                    <ul style="color: red;">
                        <?php echo $error; ?>
                    </ul>
                </div>
                <?php
                endif;
                ?>
                <div class="wrapper">
                    <div class="form-group">
                        <div class="label">
                            <label for="firstName" style="color: black;">First Name:</label>
                        </div>
                        <div>
                            <input type="text" id="firstName" name="first_name" class="form-control" value="<?= $firstName; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="lastName" style="color: black;">Last Name:</label>
                        </div>
                        <div>
                            <input type="text" id="lastName" name="last_name" class="form-control" value="<?= $lastName; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="marriageStatus" style="color: black;">Marriage Status:</label>
                        </div>
                        <div>
                            <input type="radio" id="marriageStatusYes" name="marriage_status" value="1" <?= $marriageStatus == 1 ? 'checked' : ''; ?>>
                            <label for="marriageStatusYes" style="color: black;">Yes</label>
                            <input type="radio" id="marriageStatusNo" name="marriage_status" value="0" <?= $marriageStatus == 0 ? 'checked' : ''; ?>>
                            <label for="marriageStatusNo" style="color: black;">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="dob" style="color: black;">Date of Birth:</label>
                        </div>
                        <div>
                            <input type="date" id="dob" name="dob" class="form-control" value="<?= $dob; ?>" />
                        </div>
                    </div>
                    <div>
                    &nbsp;
                    </div>
                    <div>
                        <input class="btn btn-success" type="submit" name="storePatient" value="Add Patient Information" />
                    </div> 
                </div>
            </form>
        </div>
    </div>
    <?php 
    include "../include/footer.php";
    ?>
</body>
</html>