<?php

include __DIR__ . '/dbPatients.php';

function getAllPatients(){
    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT * FROM patients");

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

function getPatient($id){
    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT * FROM patients WHERE id = :id");

    $binds = array(
        ":id" => $id
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return $results;
}

function updatePatient($id, $patientFirstName, $patientLastName, $patientMarried, $patientBirthDate)
{
    global $db;

    $result = "";

    $sql = "UPDATE patients SET patientFirstName = :fn, patientLastName = :ln, patientMarried = :ms, patientBirthDate = :dob WHERE id = :id";

    $stmt = $db->prepare($sql);

    $binds = array(
        ":id" => $id,
        ":fn" => $patientFirstName,
        ":ln" => $patientLastName,
        ":ms" => $patientMarried,
        ":dob" => $patientBirthDate  
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = "Data Updated";
    }

    return $result;
}

function deletePatient($id){
    global $db;

    $result = "";

    $sql = "DELETE FROM patients WHERE id = :id";

    $stmt = $db->prepare($sql);

    $binds = array(
        ":id" => $id
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = "Data Deleted";
    }

    return $result;
}

function searchPatient($fName, $lName, $mStatus){
    global $db;

    $results = [];

    $binds = [];

    $sql = "SELECT * FROM patients WHERE 0 = 0";

    if ($fName != "") {
        $sql .= " AND patientFirstName LIKE :fn";
        $binds["fn"] = '%'.$fName.'%';
    }

    if ($lName != "") {
        $sql .= " AND patientLastName LIKE :ln";
        $binds["ln"] = '%'.$lName.'%';
    }

    if ($mStatus != "") {
        $sql .= " AND patientMarried LIKE :ms";
        $binds["ms"] = '%'.$mStatus.'%';
    }

    $sql .= " ORDER BY patientLastName, patientFirstName";

    $stmt = $db->prepare($sql);

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}


