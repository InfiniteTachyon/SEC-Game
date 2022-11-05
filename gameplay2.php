<?php 
session_start();
$numPlayers = $_POST['numPlayers'];
define("NUM_TURNS", (int) $numPlayers*10);

//Generate variables according to number of players
for ($i=0; $i<$numPlayers; $i++) {
    $playerArray[] = ("Player " . (string) $i+1);
    ${"score" . $i} = 0;
}

function roll_dice() {
    $roll = rand(1,6);
    return $roll;
}

function get_letters($numLetters) {
    $letterArray = [];
    for ($i=0; $i<$numLetters; $i++) {
        $letter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,1);
        $letterArray[] = $letter;
    }
    return $letterArray();
} 

function do_turn($player) {
}

//Keep track of turns
$turnCounter = 0;
for ($turnNum=0; $turnNum<NUM_TURNS; $turnNum++) {
    $numLetters = roll_dice();
}

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
            <?php foreach($playerArray as $num => $playerName)
            echo '<ul class="score-line">' . $playerName . ": " . ${"score" . $num} . "</ul>";
            ?>
        </div>
    </div>

    
