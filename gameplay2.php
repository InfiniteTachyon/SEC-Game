<?php 
session_start();
$numPlayers = $_POST['numPlayers'];
define("NUM_TURNS", (int) $numPlayers*10);

//Generate variables according to number of players
for ($i=0; $i<$numPlayers; $i++) {
    $playerArray[] = [("Player " . (string) $i+1), 0];
}

//Keep track of turns
$turnCounter = 0;
// for ($turnNum=0; $turnNum<NUM_TURNS; $turnNum++) {
//     //roll dice
// }

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
        <div class="player-info">
            <p class="turn-text">PLAYER <?php echo $turnCounter+1 ?></p>
        </div>
        <div class="scoreboard">
        </div>
    </div>

    
