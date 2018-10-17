<?php
session_start();
include("pdo_class.php");
$pdo = new MyPDO;
$Unit=$_SESSION['Unit'];
$QNumber=0;
$query = $pdo->bindQuery("SELECT QID,Que,Option1,Option2,Option3,Option4,Ans FROM qanda WHERE Unit='$Unit'");

foreach($query as $value)
{
    $Que = $value['Que'];
    $Option1 = $value['Option1'];
    $Option2 = $value['Option2'];
    $Option3 = $value['Option3'];
    $Option4 = $value['Option4'];
    $QNumber++;

?>
    <form name="form1" method="POST" action="Count.php">
    <div>
    <table cellpadding="5">
    <tr>
        <td align="center"><b><font color="#000080"><?php echo $QNumber;?></font></b></td>
        <td><b><font color="#000080"><?php echo $Que;?></font></b></td>
    </tr>
    <tr>
        <td width="5%" align="center">
        <input type="radio" name="ans<?php echo $QNumber;?>" value="Option1"></td>
        <td width="95%"><?php echo $Option1;?></td>
    </tr>
    <tr>
        <td width="5%" align="center">
        <input type="radio" name="ans<?php echo $QNumber;?>" value="Option2"></td>
        <td width="95%"><?php echo $Option2;?></td>
    </tr>
    <tr>
        <td width="5%" align="center">
        <input type="radio" name="ans<?php echo $QNumber;?>" value="Option3"></td>
        <td width="95%"><?php echo $Option3;?></td>
    </tr>
    <tr>
        <td width="5%" align="center">
        <input type="radio" name="ans<?php echo $QNumber;?>" value="Option4"></td>
        <td width="95%"><?php echo $Option4;?></td>
    </tr>
    <br>
<?php
}
?>
    <input type=hidden name='Unit' value="<?php echo $Unit; ?>">
    </table>
    </div>

<p align="center">
<input type="submit" name="Submit" value="計算成績"></p>
		
