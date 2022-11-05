<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SEC Game</title>
    <link rel="stylesheet" type="text/css" href="inc/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="game">
    <meta name="description" content="Game">
    <meta name="author" content="SEC Team">
</head>
<body>
    <header id="main-header">
        <div class="container">
            <h1 class="header-text">Word Game</h1>
            <ul id="navbar">
                <li><a href="instructions.php">Game Instructions</a></li>
                <li><a href="about.php">About Us</a></li>
            </ul>
        </div>
    </header>
    <div class="container">
        <div class="form-container">
            <p>Select the number of players</p>
            <form id="player-form" method="POST" action="/game/SEC-Game/gameplay.php">
                <input type="radio" class="player-form-button" name="numPlayers" value="Single Player">
                <label for="Single Player" class="player-form-label">Single Player</label>
                <input type="radio" class="player-form-button" name="numPlayers" value="2 Players">
                <label for="2 Players" class="player-form-label">2 Players</label>
                <input type="radio" class="player-form-button" name="numPlayers" value="3 Players">
                <label for="3 Players" class="player-form-label">3 Players</label>
                <input type="radio" class="player-form-button" name="numPlayers" value="4 Players">
                <label for="4 Players" class="player-form-label">4 Players</label>
                <input type="submit">
            </form>
        </div>
    </div>
</body>
