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
define("LETTERS", (int) $numPlayers*10);

//Generate variables according to number of players
for ($i=0; $i<$numPlayers; $i++) {
    $playerArray[] = ("Player " . (string) $i+1);
    ${"score" . $i} = 0;
    ${"totalLetters" . (string) $i} = [];
}



function get_letters($numLetters) {
    $letterArray = [];
    for ($i=0; $i<$numLetters; $i++) {
        $letter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,1);
        $letterArray[] = $letter;
    }
    return $letterArray;
} 

function do_turn($currentPlayer, $currentPlayerLetters, $currentPlayerScore) {
    if (isset($_POST['dice-button'])) {
        $numLetters = roll_dice();
        $currentPlayerLetters = array_merge($currentPlayerLetters, get_letters($numLetters));
    }
    
}

//Actual gameplay
$currentPlayer = 0;
for ($turnNum=0; $turnNum<NUM_TURNS; $turnNum++) {
    $currentPlayerLetters = get_letters(LETTERS);
    $currentPlayerScore = 0;
    if (isset($_POST['dice-button'])) {
        $word = $_POST['player-text'];
        echo "<p class='word'>" . $word . "</p>"
        //do the check thing
        $currentPlayerScore += strlen($word);
        if ($currentPlayer == (int) $numPlayers-1) {
            $currentPlayer = 0;
        }
        else {
            $currentPlayer += 1;
        }
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
            <p class="turn-text">PLAYER <?php echo $currentPlayer+1 ?></p>
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
            <button type="submit" name="submit">Next Player</button>
        </div>
    </form>
    </div>
    </div>

    
