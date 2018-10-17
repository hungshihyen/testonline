<?php
session_start();
if($_SESSION)
{
	session_unset();
}
include("pdo_class.php");
$pdo = new MyPDO;
$length = 4;
$randomkey = $pdo->randomkeys($length);
?>
<html>
	<head>
		<meta http-equiv="content-type"content="text/html;charset=utf-8">
		<script src="project/jquery-3.3.1.min.js"></script>
		<title>影片自學系統</title>
	</head>
	<body>
		<div align="center"><font color="#0000FF"><font size="50">影片自學系統</font><br>
		</div>
		<form name="form1" method="POST" action="check_tester.php">
			<div align="center">
				<center>
					<table>
						<tr><br>
							<td width="60" align="center"><font color="#000000">學號：</font>
							</td>
							<td width="200" align="center">
							<div align="left">
								<input name="SNumber" type="text" Size="20">
								</div></td>
						</tr>
						<tr>
							<td width="100" align="center">輸入代碼:</td>
							<td width="200" align="center">
							<div align="left">
							<input name="password" type="text" Size="20"></td>
						</tr>
						<tr>
							<td width="100" align="center">隨機代碼:</td>
							<td width="200" align="center">
							<div align="center"><h3><?php echo $randomkey;?></h3></div>
							<input type="hidden" name="randomkey" value="<?php echo $randomkey;?>">
						</tr>
						<tr>
							<td colspan="2"><p align="center">
								<input name="buttom" type="submit" value="登入"></b>
							</td>
						</tr>
					</table>
				</center>
			</div>
		</form>
	</body>
</html>