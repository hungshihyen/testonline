<?php
require_once('CosineSimilarity.php');
$SNumber=$_SESSION['SNumber'];
$Unit=$_SESSION['Unit'];
//echo $Unit;

$rep_array = NULL;

$str = "SELECT Q1,Q2,Q3,Q4,Q5 FROM Response WHERE SNumber = '$SNumber' AND Unit = '$Unit'";
$rep_array = $pdo->query_data($str);
//print_r($rep_array);


//echo "-----------------------------------------------------".'<br>';
function removeBOM($str = '')
{
    if (substr($str, 0,3) == pack("CCC",0xef,0xbb,0xbf))
        $str = substr($str, 3);

    return $str;
}


$stu_vec = array();
$i=1;
$k=0;
while($i<=5)
{
      if($rep_array['Q'.$i] == 0){
         //echo "wrong".'<br>';
         $StuVector=fopen("Vectors/".$Unit."/".$Unit."-".$i.".txt","r");
         $a=fread($StuVector,filesize("Vectors/".$Unit."/".$Unit."-".$i.".txt"));
         //print_r($a);

        $a = removeBOM($a);

		  $aa=explode(" ",$a);
		  for ($j=0; $j<80; $j++){
           //print_r($aa[$j]);
			  //if(false !== strpos($aa[$j], '&#65279;')) {
				 //str_replace('&#65279;', '', $aa[$j]);
			//}
           $stu_vec[$k][$j] = $aa[$j];
         }
         $k++;
         //print_r($stu_vec);
      }else{
         //echo "correct".'<br>';
      }
      $i++;
}




//echo "------------------錯誤題目之向量------------------------".'<br>';
//print_r($stu_vec);
//echo @floatval($stu_vec[0][0]);
//echo "------------------錯誤題目之向量加總------------------------".'<br>';
for($b=0;$b<80;$b++){
	$a_index=array();
	for($t=0;$t<5;$t++){
		$a_index[$t]=@$stu_vec[$t][$b];
	}
	$stu_vec2[$b]=array_sum($a_index);

    //$stu_vec2[$b] = @$stu_vec[0][$b]+@$stu_vec[1][$b]+@$stu_vec[2][$b]+@$stu_vec[3][$b]+@$stu_vec[4][$b];
}
//print_r($stu_vec2);
for($p=0;$p<80;$p++){
    $v1[$p]=$stu_vec2[$p]/$k;
}
/*
echo "------------------總錯誤題數------------------------".'<br>';
echo "錯誤題數：".$k.'<br>';
echo "------------------平均向量------------------------".'<br>';
print_r($v1);
echo "------------------計算與文章的相似度------------------------".'<br>';
*/


$DocVector=fopen("Vectors/DocVector.txt","r");
//$Doc_vec=fread($DocVector,filesize("DocVector.txt"));
//echo $DocVector;
//print_r($Doc_vec);
//echo "<hr>";
$i=0;
$video_array=array(100 => -1);
 while(!feof($DocVector) && $i<80){
  $vec_txt=fgets($DocVector);
  $vec_txt = removeBOM($vec_txt);
  $vec_txt2=explode(" ",$vec_txt);
  //print_r($vec_txt2);
  $cs = new CosineSimilarity();
  @$result1[$i] = $cs->similarity($v1,$vec_txt2);
  array_push($video_array,$result1[$i]);
  //echo $result1[$i].'<br>';
  //print_r($video_array1).'<br>';
  $i++;
 }
//fclose($DocVector);
//print_r($video_array);
//echo "------------------排序------------------------".'<br>';
$arr_recom=array();
arsort($video_array);
foreach($video_array as $x=>$x_value)
    {
    //echo "Key=" . $x . ", Value=" . $x_value;
    //echo "<br>";
    array_push($arr_recom,$x);
    }
/*
echo "<hr>";
print_r($arr_recom);
echo "<hr>";
*/

$recom_check=array();
$query_recom="SELECT recommend FROM Recommend Where SNumber='$SNumber'";
//$recom=mysql_query($query_recom) or die("失敗");
$query_recom = $pdo->bindQuery($query_recom);
//print_r($query_recom);
if(!$query_recom)
{
    //echo "表示從未推薦過";
    $recommdVideo = $arr_recom[0];
}else
{
    foreach($query_recom as $value)
    {
        foreach($value as $key => $No)
        {
            //echo $No.'<br>';
            array_push($recom_check, $No);
        }
    }
    //print_r($recom_check);
    //echo "<hr>";
    for($d=0;$d<80;)
    {
        if(in_array($arr_recom[$d],$recom_check))
        {
            $d++;
        }else
        {
            break;
        }
    }
    //echo $d;

    $recommdVideo=$arr_recom[$d];
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
