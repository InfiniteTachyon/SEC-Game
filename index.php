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
            <form id="player-form" method="POST">
                <input type="button" class="player-form-button" value="Single Player">
                <input type="button" class="player-form-button" value="2 Players">
                <input type="button" class="player-form-button" value="3 Players">
                <input type="button" class="player-form-button" value="4 Players">
            </form>
        </div>
    </div>
</body>
