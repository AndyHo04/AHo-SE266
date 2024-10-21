<?php

include __DIR__ . '/dbPatients.php';

function getAllPatients(){
    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT * FROM patients ORDER BY patientLastName, patientFirstName");

    if($stmt->execute() && $stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
}

function addPatient($patientFirstName, $patientLastName, $patientMarried, $patientBirthDate){
    global $db;

    $result = "";

    $sql = "INSERT INTO patients SET patientFirstName = :fn, patientLastName = :ln, patientMarried = :ms, patientBirthDate = :dob";

    $stmt = $db->prepare($sql);

    $binds = array(
        ":fn" => $patientFirstName,
        ":ln" => $patientLastName,
        ":ms" => $patientMarried,
        ":dob" => $patientBirthDate
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Data Added";
    }

    return $result;
}



