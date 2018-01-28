<?php
//Home Assistant Service Url w/ api password
$_ENV["url"]= 'http://HOMEASSISTANTIP/api/services/light/turn_on?api_password=XXXXXX';

$rawinput = htmlspecialchars($_GET["input"]);
$input = strtolower($rawinput);

////Interpet Colors//
if ($input == "red") {
    print "💡 Changing light to Red!";
    $_ENV["color"]= 'red' ;
    updateColorName();
} elseif ($input == "green") {
    print "💡 Changing light to Green!";
    $_ENV["color"]= 'green' ;
    updateColorName();
} elseif ($input == "blue") {
    print "💡 Changing light to Blue!";
    $_ENV["color"]= 'blue' ;
    updateColorName();
} elseif ($input == "white") {
    $_ENV["color"]= 'white' ;
    print "💡 Changing light to White!";
    updateColorName();
} elseif ($input == "salt") {
    $_ENV["color"]= 'darkslategrey' ;
    print "💡 Getting salty...";
    updateColorName();
} elseif ($input == "pink") {
    $_ENV["color"]= 'deeppink' ;
    print "💡 Changing light to Pink!";
    updateColorName();
} elseif ($input == "orange") {
    $_ENV["color"]= 'orangered' ;
    print "💡 Changing light to Orange!";
    updateColorName();
} elseif ($input == "royal") {
    $_ENV["color"]= 'royalblue' ;
    print "💡 Changing light to Royal Blue!";
    updateColorName();
} elseif ($input == "loop") {
    $_ENV["color"]= 'Random Loop' ;
    print "💡 Looping the lights!";
    updateColorEffect();
} elseif ($input == "alarm") {
    $_ENV["color"]= 'Alarm' ;
    print "💡 Red alert!";
    updateColorEffect();
} else {
    print "⚠️ That's not a possible color! Try !colors";
    $_ENV["color"]= '' ;
}

////Post to Home Assistant////
function updateColorName() {
 
//Initiate cURL.
$ch = curl_init($_ENV["url"]);
 
//The JSON data.
$jsonData = array(
    'entity_id' => 'light.yeelight_strip_34ce0087ed96',
    'color_name' => $_ENV["color"],
);
 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
 
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Execute the request
$result = curl_exec($ch);
//print "Light updated!"; 
}

function updateColorEffect() {
//Initiate cURL.
$ch = curl_init($_ENV["url"]);
 
//The JSON data.
$jsonData = array(
    'entity_id' => 'light.yeelight_strip_34ce0087ed96',
    'effect' => $_ENV["color"],
);
 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
 
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Execute the request
$result = curl_exec($ch);
//print "Light updated!"; 
}
?>
