<?php

include (__DIR__ . '/db.php');

function login($username, $password) {
    global $db;

    $stmt = $db->prepare('SELECT id FROM users WHERE username= :user AND password = :pass');

    $stmt->bindValue(':user', $username);
    $stmt->bindValue(':pass', sha1('MY-TOP-SECRET-SALT' . $password));

    $stmt->execute();

    return($stmt->rowCount() > 0);
}