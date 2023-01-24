<?php

if(!isset($_GET["SESSION"])){
  header("Location: /greyhound_racing/admin/");
}

$odds_table = array(
  "simple_bet" => array(

    // Win: 1st place

    // Greyhound 1
    0 => array(
      "win" => 3.77,
    ),

    // Greyhound 2
    1 => array(
      "win" => 3.21,
    ),

    // Greyhound 3
    2 => array(
      "win" => 3.1,
    ),

    // Greyhound 4
    3 => array(
      "win" => 7.5,
    ),

    // Greyhound 5
    4 => array(
      "win" => 3.11,
    ),

    // Greyhound 6
    5 => array(
      "win" => 4.37,
    ),

    // Greyhound 7
    6 => array(
      "win" => 8.26,
    ), 
    
    // Greyhound 8
    7 => array(
      "win" => 5.42,
    ),

    // Greyhound 9
    8 => array(
      "win" => 3.69,
    ),

    // Greyhound 10
    9 => array(
      "win" => 9.03,
    ),

    // Greyhound 11
    10 => array(
      "win" => 24.24,
    ),

     // Greyhound 12
    11 => array(
      "win" => 5.32,
    )
  ),
);
?>
