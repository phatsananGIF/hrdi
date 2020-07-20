<?php
//require("phpMQTT.php");
require("phpMQTT.php");

$payload="";
$topic="smartfarm/#";
$server="128.199.216.127";
$port=1883;


$client_id = "SF001"; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new phpMQTT($server, $port, $client_id);
if(!$mqtt->connect(true, NULL, "", "")) {
	exit(1);
}


$topics["$topic"] = array("qos" => 0, "function" => "procmsg");
$mqtt->subscribe($topics, 0);
while($mqtt->proc()){
		
}

$mqtt->close();


function procmsg($topic, $msg){
    echo "Msg Recieved: " . date("r") . "\n";
    echo "Topic: {$topic}\n\n";
    echo "\t$msg\n\n";
}

?>