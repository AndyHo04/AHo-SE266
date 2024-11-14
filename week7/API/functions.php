<?php
function getNhlTeams() {
    // Get today's date in the required format
    $today = date('Y-m-d');
    $url = 'https://api-web.nhle.com/v1/standings/' . $today;

    // Initialize cURL
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL and get the response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return null;
    }

    // Close cURL
    curl_close($ch);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Group teams by division
    $divisions = [];
    foreach ($data['standings'] as $team) {
        $division = $team['divisionName'];
        $teamName = $team['teamName']['default'];
        $teamAbbrev = $team['teamAbbrev']['default'];
        $points = $team['points'];

        if (!isset($divisions[$division])) {
            $divisions[$division] = [];
        }

        $divisions[$division][] = [
            'name' => $teamName,
            'abbrev' => $teamAbbrev, 
            'points' => $points,
        ];
    }

    $desiredOrder = [
        "Atlantic",
        "Metropolitan",
        "Central",
        "Pacific",
    ];

    $orderedDivisions = [];
    foreach ($desiredOrder as $division) {
        if (isset($divisions[$division])) {
            $orderedDivisions[$division] = $divisions[$division];
        }
    }

    return $orderedDivisions;
}

function getTeamRoster($teamAbbrev) {
    $url = 'https://api-web.nhle.com/v1/roster/' . $teamAbbrev . '/20242025';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return [];
    }

    curl_close($ch);

    $data = json_decode($response, true);

    return $data;
}

function calculateAge($birthDate) {
    $birthDate = new DateTime($birthDate);
    $today = new DateTime();
    $age = $today->diff($birthDate);
    return $age->y;
}


function getPlayerSpotlight() {
    $url = 'https://api-web.nhle.com/v1/player-spotlight';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return null;
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data) && !empty($data)) {

        usort($data, function($a, $b) {
            return $a['sortId'] - $b['sortId'];
        });

        $topPlayers = array_slice($data, 0, 3);

        $players = [];
        foreach ($topPlayers as $player) {
            $players[] = [
                'playerId'      => $player['playerId'],
                'name'          => $player['name']['default'],
                'playerSlug'    => $player['playerSlug'],
                'position'      => $player['position'],
                'sweaterNumber' => $player['sweaterNumber'],
                'teamTriCode'   => $player['teamTriCode'],
                'teamLogo'      => $player['teamLogo'],
                'headshot'      => $player['headshot'],
            ];
        }

        return $players;
    } else {
        return null;
    }
}