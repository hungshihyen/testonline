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
<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta http-equiv="content-type"content="text/html;charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
		<link rel="shortcut icon" href="pic.png">
		<title>影片自學系統</title>
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
					<h1 class="text-center"><font color="blue">影片自學系統</font></h1>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="alert alert-light text-center" role="alert">
              			<h3>歡迎來到線上影片學習系統，讓你看影片學習英文。</h3>
        			</div>
				</div>
			</div>
		</div>
		<div class="main">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-sm-offset-3">
						<form class="form-horizontal" method="POST" action="check_tester.php">
							<div class="form-group row">
								<label for="StNumber" class="col-sm-4 col-form-label">您的學號：</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="StNumber" name="SNumber" placeholder="輸入學號">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword" class="col-sm-4 col-form-label">輸入代碼：</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="password" id="inputPassword" placeholder="輸入以下代碼">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">隨機代碼：</label>
								<div class="col-sm-8">
									<h3><?php echo $randomkey;?></h3>
									<input type="hidden" name="randomkey" value="<?php echo $randomkey;?>">
								</div>
							</div>
							<div class="text-center">
								<input class="btn btn-primary btn-lg" type="submit" value="登入">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h5 class="text-center">
						<?php echo date("Y");?>
					</h5>
				</div>
			</div>
		</div>
		<script src="project/jquery-3.3.1.min.js"></script>
	</body>
</html>