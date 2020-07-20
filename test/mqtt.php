
<?php
//require("phpMQTT.php");
require("phpMQTT.php");

$payload="";
$topic="smartfarm/#";
$server="128.199.216.127";
$port=1883;

if(isset($_POST['payload']) )
{
  $payload=trim($_POST['payload']);
  $server=trim($_POST['server']);
  $topic=trim($_POST['topic']);
  
  if(isset($_POST['publish'])){
   
    $mqtt = new phpMQTT($server, $port, "SF001"); 

    if ( $mqtt->connect(true,NULL,"","") ) { 
      	$mqtt->publish("$topic",$payload, 0); 
        $mqtt->close(); 
     }else{ 
      echo "Fail or time out<br />";
     }
  }

  if(isset($_POST['subscribe'])){
    echo "subscribe";
  }
  

}

?>

<html>
<body>

<h3>Command<h3>

<form method="post">
  Server : <br>
  <input type="text" size="30" name="server" value="<?php echo $server ?>"> <br>
  Topic : <br>
  <input type="text" size="30" name="topic" value="<?php echo $topic ?>"> <br>
  payload:<br>
  <input type="text" size="100" name="payload" value="<?php echo $payload ?>"><br>
  <input type="submit" name="publish" value="publish">
  <input type="submit" name="subscribe" value="subscribe">
</form>

</body>
</html>
