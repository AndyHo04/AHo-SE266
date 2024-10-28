<?php

include (__DIR__ . '/db.php');

function getTeams(){
    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT * FROM TEAMS ORDER BY teamConference, teamDivision, teamPoints DESC, teamName");

    if($stmt->execute() && $stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
}

function addTeam($tName, $tConference, $tDivision, $tPoints){
    global $db;

    $result = "";

    $sql = "INSERT INTO TEAMS SET teamName = :n, teamConference = :c, teamDivision = :d, teamPoints = :p";

    $stmt = $db->prepare($sql);

    $binds = array(
        ":n" => $tName,
        ":c" => $tConference,
        ":d" => $tDivision,
        ":p" => $tPoints
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Data Added";
    }

    return $result;
}

function getTeam($id){
    global $db;

    $result = [];

    $sql = 'SELECT * FROM TEAMS WHERE ID = :id';

    $stmt = $db->prepare($sql);

    $binds = array(
        ':id'=> $id
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $result;
}

function updateTeam($id, $tName, $tConference, $tDivision, $tPoints){
    global $db;

    $result = '';

    $sql = 'UPDATE TEAMS SET teamName = :n, teamConference = :c, teamDivision = :d, teamPoints = :p WHERE id = :id';

    $stmt = $db->prepare($sql);

    $binds = array(
        ':id'=> $id,
        ':n'=> $tName,
        ':c'=> $tConference,
        ':d'=> $tDivision,
        ':p'=> $tPoints
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Team Updated";
    }

    return $result; 
}

function deleteTeam($id){
    global $db;

    $result = "";

    $sql = "DELETE FROM TEAMS WHERE id = :id";

    $stmt = $db->prepare($sql);

    $binds = array(
        ":id"=> $id
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Team Deleted";
    }

    return $result;
}