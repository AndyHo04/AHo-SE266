<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NHL Team Standings</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #112;
            color: #333;
            margin: 0;
            padding: 20px;
            background-image: url('../API/photos/rink2.jpg');
            background-size: cover; 
            background-position: center; 
            position: relative; 
            min-height: 100vh; 
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); 
            z-index: -1; 
        }

        h1,h2 {
            font-size: 56px;
            text-align: center;
            color: #fff;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);  
            gap: 20px;
            margin-top: 20px;
            padding: 0 15px;  
        }

        .division {
            background-color: rgba(255,255,255,0.95);  
            border-radius: 15px;
            padding: 15px;
            transition: all 0.3s ease-in-out;  
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);  
        }

        .division:nth-child(-n+2) {
            color: #4f0500;  
            border-left: 5px solid #4f0500;  
        }

        .division:nth-child(n+3) {
            color: #000e4f;  
            border-left: 5px solid #000e4f;  
        }

        .division li:hover {
            transform: translateY(-2px); 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
        }

        .division h3 {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;  
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            background-color: #fff;
            color: #333;
            margin: 5px 0;
            padding: 12px 15px;  
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);  
            display: flex;
            justify-content: space-between;  
            align-items: center;
            transition: all 0.3s ease; 
        }
                
        li:nth-child(-n+4) {
            background-color: #0066cc;; 
            color: #fff;
            font-weight: 900; 
        }

        .highlight-border {
            border: 2px solid red;
            border-radius: 5px;
        }

        a {
            text-decoration: none;
            color: inherit;
            width: 100%; 
            display: flex; 
            justify-content: space-between; 
        }

        .roster-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px;
        }

        .player-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            width: 200px; 
            background-color: #f9f9f9;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 2px solid #005EB8;
        }

        .roster-headshot {
            width: 100%; 
            border-radius: 5px;
            height: auto; 
        }

        .player-info h3 {
            margin: 10px 0 5px;
        }

        .player-info p {
            margin: 5px 0;
        }

        h2 {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 1.5em;
            text-align: center;
            width: 100%;
        }

        .player-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            width: 100%;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            font-size: 1.2em;
            color: #007BFF; 
            text-decoration: none;
            text-align: center;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .player-spotlight-section {
            margin: 40px auto;
            max-width: 1200px;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
        }

        .spotlight-title {
            font-size: 36px;
            color: #fff;
            margin-bottom: 30px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .player-spotlight-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            gap: 20px; 
            margin: 0 auto; 
        }

        .player-spotlight-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 280px;
        }

        .player-spotlight-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .spotlight-card-header {
            display: flex;
            padding: 20px;
            align-items: center;
            border-bottom: 2px solid #f1f1f1;
        }

        .player-headshot {
            flex: 0 0 90px;
            height: 90px;
            margin-right: 20px;
        }

        .player-headshot img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #f1f1f1;
        }

        .player-info {
            text-align: left;
        }

        .player-name {
            font-size: 22px;
            color: #333;
            font-weight: bold;
            margin: 0;
        }

        .player-position {
            font-size: 14px;
            color: #777;
            margin: 5px 0;
        }

        .team-info {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .team-name {
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .spotlight-card-body {
            padding: 20px;
            text-align: left;
        }

        .player-number {
            font-size: 16px;
            color: #333;
            margin: 0 0 15px 0;
        }

        .view-profile-btn {
            display: inline-block;
            background-color: #0066cc;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .view-profile-btn:hover {
            background-color: #005bb5;
        }

        .view-profile-btn:focus {
            outline: none;
        }


        @media (max-width: 600px) {
            .grid {
                grid-template-columns: 1fr; 
            }
            body {
                padding: 10px;
            }
            h2 {
                font-size: 1.5em;
            }
            li {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>