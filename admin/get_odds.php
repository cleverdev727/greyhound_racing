<?php 

if(!isset($_GET["SESSION"])){
  header("Location: /greyhound_racing/admin/");
}

$returnToPlayer = 40;

function getRandomElement($weight, $arr){
    $rand = random_int(0, (int) array_sum($weight));
  
    foreach ($weight as $key => $value) {
      $rand -= $value;
      if ($rand <= 0) {
        return $arr[$key];
      }
    }
  }

  $ranksProbabilityArr = [75,88,92,38,91,66,34,54,78,32,12,54];
  $ranksArr = [0,1,2,3,4,5,6,7,8,9,10,11];

function getRandomRankings($ranksProbabilityArr, $ranksArr){
    $resultArr = [];

    for ($i=0; $i <= 5; $i++) { 
  
      $candidate = getRandomElement($ranksProbabilityArr, $ranksArr);
      array_push($resultArr, $candidate);
  
      $key = array_search($candidate, $ranksArr);
  
      array_splice($ranksArr, $key, 1);
      array_splice($ranksProbabilityArr, $key, 1);
    }
    
    return $resultArr;
}

$ranksArr = [0,1,2,3,4,5,6,7,8,9,10,11];
//$ranksProbabilityArr = [random_int(20,100),random_int(20,100),random_int(20,100),random_int(20,100),random_int(20,100),random_int(20,100)];  

$win_total = 0;
// Simulating real world results.

$tries = 1000000;

$probabilities = array(
    "win" => array(),
);

for($x = 0; $x < $tries; $x++){
    $res = getRandomRankings($ranksProbabilityArr, $ranksArr);

    for($z = 0; $z<=12; $z++){
        if($res[0] == $z){
            if(array_key_exists($z, $probabilities['win'])){
                $probabilities['win'][$z]++;
            }else {
                $probabilities['win'][$z] = 1;
            }
        }
    }
}

for ($i=0; $i <= 11; $i++) { 
        $win = round($probabilities["win"][$i]/$tries*100,2);
        $win_total+=$win;
        $greyhound_num = $i+1;

        $winReturn = round($returnToPlayer/$win,2); // Win RTP 40%
        
        echo "Greyhound {$greyhound_num} - Win: {$win}% {$winReturn}x ". "\n";

}

echo "Simple Bet Total - Win: {$win_total}%";
?>