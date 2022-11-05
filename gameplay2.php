<?php
        function isRealWord($word) {
            $curl = curl_init();

            $url = "https://od-api.oxforddictionaries.com/api/v2/entries/en-us/" . $word;
            curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
              "app_id: cf7d9dc6",
              "app_key: 0588f6dc5d86e27c8c0af730c58d136c"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              if ($httpcode == 200) {
                return 1;
              } else {
                return 0; 
              }
            }

        }
?>


<?php
    function generateWord() {
        $curl = curl_init();

        $url = "https://random-word-api.herokuapp.com/word" ;
        curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        ]);

        $response = curl_exec($curl);
        $response = ltrim($response, '["');
        $response = rtrim($response, '"]');

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          if ($httpcode == 200) {

            return $response;
          } else {
            return $httpcode; 
          }
        }

    }


?>



<?php 
$numPlayers = $_POST['numPlayers'];
define("NUM_TURNS", (int) $numPlayers*10);

//Generate variables according to number of players
for ($i=0; $i<$numPlayers; $i++) {
    $playerArray[] = ("Player " . (string) $i+1);
    ${"score" . $i} = 0;
    ${"totalLetters" . (string) $i} = [];
}

if (isset($_POST['dice-button'])) {
    roll_dice();
    echo "<script>console.log('Hello worlds')</script>";
}

function roll_dice() {
    $roll = rand(1,12);
    return $roll;
}

function get_letters($numLetters) {
    $letterArray = [];
    for ($i=0; $i<$numLetters; $i++) {
        $letter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,1);
        $letterArray[] = $letter;
    }
    return $letterArray;
} 

function do_turn($player, $currentLetters) {
    $numLetters = roll_dice();
    ${"totalLetters" . $player} = array_merge($currentLetters, get_letters($numLetters));
    $currentPlayerLetters = ${"totalLetters" . $player};
}

//Actual gameplay
$turnCounter = 0;
for ($turnNum=0; $turnNum<NUM_TURNS; $turnNum++) {
    $currentPlayer = $turnCounter;
    $currentPlayerLetters = ${"totalLetters" . $turnCounter};
    $currentPlayerScore = ${"score" . $turnCounter};
    do_turn($currentPlayer, $currentPlayerLetters);
    if ($turnCounter == (int) $numPlayers-1) {
        $turnCounter = 0;
    }
    else {
        $turnCounter += 1;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SEC Game</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
    <div class="container">
        <div class="form-field">
                <label for="playerText" class="text-label">Type your word here:</label>
                <input type="text" class="text-input" id="playerText" name="playerText">
        </div>
    </div>
    <div class="container">
        <div class="letter-display">
            <?php foreach($currentPlayerLetters as $singleLetter): ?>
                    <div class="single-letter"><?php echo $singleLetter ?></div>
            <?php endforeach; ?>
        </div>
    <form method="POST">
        <div class="button">
            <button type="button" name="dice-button">Roll Dice</button>
        </div>
    </form>
    </div>
    </div>

    
