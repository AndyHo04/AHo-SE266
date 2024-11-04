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


function addTeam($tName, $teamConference, $tDivision, $tPoints){

    global $db;

    $result = "";

    $sql = "INSERT INTO TEAMS SET teamName = :n, teamConference = :c, teamDivision = :d, teamPoints = :p";

    $stmt = $db->prepare($sql);

    $binds = array(
        ":n" => $tName,
        ":c" => $teamConference,
        ':d' => $tDivision,
        ':p' => $tPoints
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Data Added";
    }

    return $result;
}

function getTeam($id){
    global $db;

    $result = [];

    $sql = 'SELECT * FROM TEAMS WHERE id = :id';

    $stmt = $db->prepare($sql);

    $binds = array(
        ':id'=> $id
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $result;
}

function updateTeam($id, $tName, $teamConference, $tDivision, $tPoints) {
    global $db;

    $result = '';

    $sql = 'UPDATE TEAMS SET teamName = :n, teamConference = :c, teamDivision = :d, teamPoints = :p WHERE id = :id';

    $stmt = $db->prepare($sql);

    $binds = array(
        ':id'=> $id,
        ':n'=> $tName,
        ':c'=> $teamConference,
        ':d'=> $tDivision,
        ':p'=> $tPoints
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = 'Team Updated';
    }

    return $result;
}

function deleteTeam($id){
    global $db;

    $result = '';

    $sql = 'DELETE FROM TEAMS WHERE id = :id';

    $stmt = $db->prepare($sql);

    $binds = array(
        ':id'=> $id
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = 'Team Deleted';
    }

    return $result;
}

function searchTeams($tName, $tConference, $tDivision){
    global $db;

    $results = [];

    $binds = [];

    $sql = 'SELECT * FROM TEAMS WHERE 0 = 0';

    if($tName != ''){
        $sql .= ' AND teamName LIKE :n';
        $binds['n'] = '%'.$tName.'%';
    }

    if($tConference != ''){
        $sql .= ' AND teamConference LIKE :c';
        $binds['c'] = '%'.$tConference.'%';
    }

    if($tDivision != ''){
        $sql .= ' AND teamDivision LIKE :d';
        $binds['d'] = '%'.$tDivision.'%';
    }

    $sql .= " ORDER BY teamConference, teamDivision, teamPoints DESC, teamName";

    $stmt = $db->prepare($sql);

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;

}