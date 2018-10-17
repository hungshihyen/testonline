<?php
session_start();
include("pdo_class.php");
$tableRes = "response";
$Unit=$_POST['Unit'];
$SNumber = $_SESSION['SNumber'];
$Total = 0;
$response = NULL;
$res_array = array();

$data_res = array(
    "Unit" => $Unit,
    "SNumber" => $SNumber
);
$pdo = new MyPDO;
//從資料庫取出正確答案
$str = "SELECT Ans FROM qanda WHERE Unit= $Unit";
$query = $pdo->bindQuery($str);
if(!$query)
{
    echo "connect fail";
}

$resp=NULL;
$QNumber=0;
foreach($query as $value)
{
    $QNumber++;
    $a="ans".$QNumber;
    $UserAns=$_POST[$a];
    $Q_No = 'Q'.$QNumber;
    //計算對錯
    if($UserAns == $value['Ans'])
    {
        $Total++;
        $response = "1";
        $res_array[$Q_No] = $response;
    }else
    {
        $response = "0";
        $res_array[$Q_No] = $response;
    }
}
//合併array
$response = array_merge($data_res, $res_array);
//print_r($response);

//insert into response
$query = $pdo->insert_data($tableRes, $response);
if(!$query)
{
    echo "fail";
}

$Score = array();
//更新資料夾
$tableScore = "score";
$Total=$Total*1;
//echo $Total;
$query = $pdo->bindQuery("SELECT * FROM `score` WHERE Unit = '$Unit' AND SNumber = '$SNumber'");
//print_r($query);
if(!$query)
{
    $Score = array(
        'SNumber' => $SNumber,
        'Unit' => $Unit,
        'score' => $Total,

    );
    //echo $Total;
    //var_dump($Score);
    $result = $pdo->insert_data($tableScore, $Score);
    if(!$result) return false;
}else
{
    //echo $Total;
    $Score = array('score' => $Total);
    $colums = array('SNumber' => $SNumber,'Unit' => $Unit);
    //echo "這裡";
    $query = $pdo->update_data($tableScore, $Score, $colums);
    if(!$query) return false;
    //$pdo->error();
}
//推薦新影片
if($Total < 5 )
{
    require_once("analyze.php");
    //header("Location:analyze.php");
}else
{
    require_once("random.php");
}

header("Location:ShowScore.php");
?>
