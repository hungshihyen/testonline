<?php
session_start();
include("pdo_class.php");
$pdo = new MyPDO();
$SNumber=$_SESSION['SNumber'];
$Unit=$_SESSION['Unit'];



$query_ShowScore = $pdo->bindQuery("SELECT SNumber,score FROM Score WHERE SNumber='$SNumber' and Unit='$Unit'");
foreach($query_ShowScore as $value)
  {
    $score = $value['score'];
  }
?>
<html>
	<head>
		<meta http-equiv="content-type"content="text/html;charset=utf-8">
		<script src="project/jquery-3.3.1.min.js"></script>
		<title>英文影片自學系統</title>
</head>
<body>
  <div align="center">
  <h2><font color="#0000FF">測驗成績</font></h2>
  <table width="500"  align="center">
    <tr cellpadding="5">
    <td width="100" align="center">學生代碼: </td>
    <td width="195" align="center"><?php echo $_SESSION['SNumber']; ?></td>
    </tr>
  </table>
  <br>
  <table width="700" border="1">
    <tr>
    <td width="100">
      <div align="center">測驗單元</div></td>
    <td width="100">
      <div align="center"><?php echo "$Unit"; ?>
      </div></td>
    </tr>
    <tr>
    <td width="100">
      <div align="center">單元成績</div></td>
    <td width="100">
      <div align="center"><?php echo $score; ?>
      </div></td>
    </tr>
  </table>
  </div>
</body>
<form name="form1" method="POST" action="test_login.php">
<td colspan="2"><p align="center">
<input name="buttom" type="submit" value="完成測驗">
</form>

<?php
/*
判斷是否全對之後用jquery傳值。


if($score==5){

   ?><form name="form1" method="POST" action="random.php">
   <td colspan="2"><p align="center">
   <input name="buttom" type="submit" value="Next Page">
   </td><?php
}else{

   ?><form name="form1" method="POST" action="analyze.php">
     <td colspan="2"><p align="center">
     <input name="buttom" type="submit" value="Next Page">
     </td><?php
}
*/
?>
