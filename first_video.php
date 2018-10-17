<?php 
session_start();
include("pdo_class.php");
if(!isset($_SESSION['SNumber']))
{
    header("Location:test_login.php");
}else
{

    $_SESSION['Unit']="201";
    $src="https://www.youtube.com/embed/vH-0mMy5Jgk";
}
?> 

<p align="center">
<iframe width="1200" height="700" src="<?php echo $src;?>" frameborder="0" allowfullscreen></iframe>
<form name="form1" method="POST" action="test.php">
<div>
<td colspan="2"><p align="center">
<input name="buttom" type="submit" value="進入測驗">
</td>
</div>