<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 4 Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <?php  
    include "functions_patients.php";

    // Initialize variables
    $firstName = "";
    $lastName = "";
    $marriageStatus = "";
    $dob = "";
    $error = "";
    
    if (isset($_GET['Action'])) {
        $action = filter_input(INPUT_GET, 'Action');
        $id = filter_input(INPUT_GET, 'ID');

        $patient = getPatient($id);

        if ($patient) {
            $firstName = $patient['patientFirstName'];
            $lastName = $patient['patientLastName'];
            $marriageStatus = $patient['patientMarried'];
            $dob = $patient['patientBirthDate'];
        }

    }

    if (isset($_POST['first_name'])) {
        $firstName = filter_input(INPUT_POST, 'first_name');
        $lastName = filter_input(INPUT_POST, 'last_name');
        $marriageStatus = filter_input(INPUT_POST, 'marriage_status');
        $dob = filter_input(INPUT_POST, 'dob');

        if ($firstName == "") $error .= "<li>Please provide first name</li>";
        if ($lastName == "") $error .= "<li>Please provide last name</li>";
        if ($marriageStatus == "") $error .= "<li>Please provide marriage status</li>";
        if ($dob == "") $error .= "<li>Please provide date of birth</li>";
        if (!isDate($dob)) $error .= "<li>Please provide a valid date of birth</li>";

        if ($error == "") {
            if (isset($_POST['storePatient'])) {
                addPatient($firstName, $lastName, $marriageStatus, $dob);
                header('Location: Search.php');
                exit();
            }
            else if (isset($_POST['editPatient'])) {
                updatePatient($id, $firstName, $lastName, $marriageStatus, $dob);
                header('Location: Search.php');
                exit();
            }
            else if (isset($_POST['deletePatient'])) {
                deletePatient($id);
                header('Location: Search.php');
                exit();
            }
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
    <h1>Patient Intake Form</h1>
    <a href = "Search.php">Back to View All Patients</a>
    <h2> <?= $action; ?> Patient</h2>
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
                    <?php if ($action == "Add"): ?>
                    <div>
                        <input class="btn btn-success" type="submit" name="storePatient" value="Add Patient Information" />
                    </div> 
                    <?php elseif ($action == "Edit"): ?>
                    <div>
                        <input class="btn btn-warning" type="submit" name="editPatient" value="Edit Patient Information" />
                    </div>
                    <br/>
                    <div>
                        <input class="btn btn-danger" type="submit" name="deletePatient" value="Delete Patient" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <?php 
    include "../include/footer.php";
    ?>
</body>
</html>