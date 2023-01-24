<?php

/*
The purpose of this script is to receive user input, check it, create a random horse racing result, and reward the player based on the result.
Every horse has an intrinsic chance of being selected at a time.
Based on these chances, the probabilities of all possible bets are calculated and converted to odds.
Based on the current odds the Return to Player rate is 40%.

For example if Player A bets on 1000 different games with a total of $10000 he should expect to get only 40% of it which is $4000.
*/

if(!isset($_GET["SESSION"])){
  header("Location: /greyhound_racing/admin/");
}

function outputMsg($msgArray){
  header('Content-Type: application/json; charset=utf-8');
  $json = json_encode($msgArray);
  echo $json;
  exit();
}

$db = new PDO("sqlite:../includes/greyhound_racing.db");

require("./auth.php");

require("./odds.php");

// Setting user information and input manually for debugging reasons. This will be removed after browser integration.
$username = "user1";

$input = '
{
	"bet_list": [{
			"win": 0
		},
		{
			"win": 50
		},
		{
			"win": 0
		},
		{
			"win": 0
		},
		{
			"win": 0
		},
		{
			"win": 0
		},
		{
			"win": 0
		},
		{
			"win": 0
		},
		{
			"win": 0
		},
		{
			"win": 0
		},
		{
			"win": 0
		},
		{
			"win": 0
		}
	]
}
';

// Read settings from DB.

// Default values

$minimum_bet = 10;
$maximum_bet = 1000;
$jackpot_threshold = 1000;

$read = $db -> prepare("SELECT * FROM settings");
$read -> execute();

$resultCount = $read -> rowCount();

$result = $read -> fetchAll();

foreach ($result as $key => $value) {
  $setting_name = $value['setting_name'];
  $setting_value = $value['setting_value'];

  if($setting_name == "minimum_bet"){
    $minimum_bet = (float) $setting_value;
    continue;
  }

  if($setting_name == "maximum_bet"){
    $maximum_bet = (float) $setting_value;
    continue;
  }

  if($setting_name == "jackpot_threshold"){
    $jackpot_threshold = (float) $setting_value;
    continue;
  }
}

// check user input
$inputArr = json_decode($input, true);

$input_fail = false;

if(!array_key_exists('bet_list', $inputArr)){
  $input_fail = true;
}

$total_bet = 0;
$atLeastOne = false;
if(array_key_exists('bet_list', $inputArr)){
  foreach ($inputArr['bet_list'] as $key => $value) {
    if(!array_key_exists('win', $value)){
      $input_fail = true;
    }

    if(!is_numeric($value['win'])){
      $input_fail = true;
    }

    if(!array_key_exists($key, $odds_table['simple_bet'])){
      $input_fail = true;
    }

    if($value['win'] < 0){
      $input_fail = true;
    }

    if($value['win'] > 0){
      if($atLeastOne) $input_fail = true;
      $atLeastOne = true;
    }

    $total_bet += round($value['win'], 2);
  }
}

$total_bet = round($total_bet, 2);

if($total_bet < $minimum_bet || $total_bet > $maximum_bet){
  $input_fail = true;
}

if($input_fail){
  $msg = array(
    "status" => "error",
    "message_short" => "unsuitable_input",
    "message" => "The supplied input wasn't suitable. Please contact administrator."
  );

  outputMsg($msg);
}

// Retrieve user information

$stmt = $db -> prepare("SELECT * FROM users WHERE username = :username");
$stmt -> bindValue(":username", $username);
$stmt -> execute();
$result = $stmt -> fetch(); 

$user_balance = $result['balance'];

if($user_balance < $total_bet){
  $msg = array(
    "status" => "error",
    "message_short" => "insufficient_balance",
    "message" => "Insufficient balance.",
  );

  outputMsg($msg);
}


$jackpotBalance = 0;
$houseBalance = 0;

$read = $db -> prepare("SELECT * FROM balance");

$read -> execute();

$result = $read -> fetchAll();

foreach ($result as $key => $value) {
  $balance_name = $value['balance_name'];
  $balance_amount = $value['amount'];

  if($balance_name == "house"){
    $houseBalance = (float) $balance_amount;
    continue;
  }

  if($balance_name == "jackpot"){
    $jackpotBalance = (float) $balance_amount;
    continue;
  }
}

if($houseBalance == 0) {
  echo "Database error.";
  exit();
}

function getRandomElement($weight, $arr){
  $rand = random_int(0, (int) array_sum($weight));

  foreach ($weight as $key => $value) {
    $rand -= $value;
    if ($rand <= 0) {
      return $arr[$key];
    }
  }
}

function getRandomRankings(){
  $resultArr = [];
  $ranksArr = [0,1,2,3,4,5,6,7,8,9,10,11];
  $ranksProbabilityArr = [75,88,92,38,91,66,34,54,78,32,12,54];
  for ($i=0; $i <= 11; $i++) { 

    $candidate = getRandomElement($ranksProbabilityArr, $ranksArr);
    array_push($resultArr, $candidate);

    $key = array_search($candidate, $ranksArr);

    array_splice($ranksArr, $key, 1);
    array_splice($ranksProbabilityArr, $key, 1);
  }
  
  return $resultArr;
}

$game_result = [0,1,2,3,4,5,6,7,8,9,10,11];

function calculateRewards($game_result, $inputArr){
  global $odds_table;
  global $jackpot_threshold;
  global $jackpotBalance;

  $total_earned = 0;

  $wins = array();

  foreach ($inputArr['bet_list'] as $key => $value) {
    $amount = round($value['win'], 2);
    $rate = $odds_table['simple_bet'][$key]['win'];
    $earned = 0;

    if($game_result[0] == $key && $amount > 0){
      $earned = round($amount*$rate, 2);
      $total_earned += $earned;
    }

    if($amount > 0){
      $insert = array("type" => "win", "amount" => $amount, "rate" => $rate, "earned" => $earned, "horse" => $key);
      array_push($wins, $insert);
      break;
    }
  }

  $jackpot_win = 0;

  if($total_earned > 0 && $jackpotBalance >= $jackpot_threshold){

    // If the user won the bet, user has 5% chance of winning the jackpot.

    $chance = random_int(0,99);
    $chance = 3;
    if($chance < 5){
      $insert = array("type" => "jackpot_win", "earned" => $jackpotBalance);
      array_push($wins, $insert);

      $jackpot_win = $jackpotBalance;
    }
  }

  return([$wins, $total_earned, $jackpot_win]);
}

// In case the user wins more than there is available in the house balance, make the user lose.

$reward = [];

while(True){
  $randomResult = getRandomRankings();
  $reward = calculateRewards($randomResult, $inputArr);

  if($reward[1] < $houseBalance){
    break;
  }
}

// TODO: Update database

if($reward[2] > 0){
  $jackpotBalance = 0;
}

$user_balance -= $total_bet;

$expectedProfit = round($houseBalance / 100 * 60);

$jackpotShare = round($expectedProfit / 100 * 10);

$jackpotBalance += $jackpotShare;

$houseBalance += $total_bet - $jackpotShare;

$update = $db -> prepare("UPDATE balance SET amount = :house WHERE balance_name = 'house'");
$update -> bindValue(":house", $houseBalance);
$update -> execute();

$update = $db -> prepare("UPDATE balance SET amount = :jackpot WHERE balance_name = 'jackpot'");
$update -> bindValue(":jackpot", $jackpotBalance);
$update -> execute();

$update = $db -> prepare("UPDATE users SET balance = :user_balance WHERE username = :user");
$update -> bindValue(":user_balance", $user_balance);
$update -> bindValue(":user", $username);
$update -> execute();

$bet_json = json_encode($reward[0]);

$insert = $db -> prepare("INSERT INTO bet_history (user, total_bet, total_win, balance, details) VALUES (:user, :total_bet, :total_win, :balance, :details)");
$insert -> bindValue(":user", $username);
$insert -> bindValue(":total_bet", $total_bet);
$insert -> bindValue(":total_win", $reward[1] + $reward[2]);
$insert -> bindValue(":balance", $user_balance);
$insert -> bindValue(":details", $bet_json);
$insert -> execute();

// Output JSON to the game.

$msg = array(
  "status" => "success",
  "message_short" => "none",
  "message" => $reward
);

outputMsg($msg);
?>
