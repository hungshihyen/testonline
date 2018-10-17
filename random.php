<?php
//session_start();
//include("pdo_class.php");
//$pdo = new MyPDO;
$SNumber=$_SESSION['SNumber'];


$recom_check=array();
$query_recom="SELECT recommend FROM Recommend Where SNumber='$SNumber'";
$query_recom = $pdo->bindQuery($query_recom);

if(!$query_recom)
{
    //表示從未推薦過
    $recommdVideo = rand(101,180);
}else
{
    foreach($query_recom as $value)
    {
        foreach($value as $key => $No)
        {
            array_push($recom_check, $No);
        }
    }

    $recommdVideo = 0;
    for($i = 0;$i < 80;)
    {
      $recommdVideo = rand(101,180);
      if(in_array($recommdVideo, $recom_check))
      {
       $i++;
      }else
      {
       break;
      }
    }
}

$lastUnitCheck = array();
$query = "SELECT lastUnit FROM Recommend WHERE SNumber = '$SNumber'";
$query = $pdo->bindQuery($query);

foreach ($query as $value)
{
    foreach($value as $val)
    {
        array_push($lastUnitCheck, $val);
    }
}

if(!in_array($Unit, $lastUnitCheck))
{
    $table = "Recommend";
    $data_array = array(
    "SNumber" => $_SESSION['SNumber'],
    "lastUnit" => $Unit,
    'recommend' => $recommdVideo
    );

    $query = $pdo->insert_data($table, $data_array);
    
}else
{
    //break;
}

//session_destroy();
//header("Location:test_login.php");
?>
