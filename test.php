<?php
session_start();
include("pdo_class.php");
$pdo = new MyPDO;
$Unit=$_SESSION['Unit'];
$QNumber=0;
$query = $pdo->bindQuery("SELECT QID,Que,Option1,Option2,Option3,Option4,Ans FROM qanda WHERE Unit='$Unit'");
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
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                        <form method="POST" action="Count.php">
                            <div>
                                <?php foreach($query as $value):?>
                                    <?php $QNumber++;?>
                                    <?php $Que = $value['Que']; ?>
                                    <div class="form-group">
                                        <?php echo $QNumber;?>
                                        <?php echo $Que;?>
                                    </div>
                                    <div class="form-check">
                                        <?php $Option1 = $value['Option1'];?>
                                        <input class="form-check-input" type="radio" name="ans<?php echo $QNumber;?>" value="Option1"></td>
                                        <?php echo $Option1;?>
                                    </div>
                                    <div class="form-check">
                                        <?php $Option2 = $value['Option2'];?>
                                        <input class="form-check-input" type="radio" name="ans<?php echo $QNumber;?>" value="Option2"></td>
                                        <?php echo $Option2;?>
                                    </div>
                                    <div class="form-check">
                                        <?php $Option3 = $value['Option3'];?>
                                        <input class="form-check-input" type="radio" name="ans<?php echo $QNumber;?>" value="Option2"></td>
                                        <?php echo $Option3;?>
                                    </div>
                                    <div class="form-check">
                                        <?php $Option4 = $value['Option4'];?>
                                        <input class="form-check-input" type="radio" name="ans<?php echo $QNumber;?>" value="Option4"></td>
                                        <?php echo $Option4;?>
                                    </div>
                                    <br>
                                <?php endforeach;?>
                                <input type=hidden name='Unit' value="<?php echo $Unit;?>">
                            </div>
                            <div class="text-center">
                                <input class="btn btn-light btn-lg" type="submit" name="Submit" value="計算成績">
                            </div>
                        </form>
                    </div>     
                </div>
            </div>
        </div> 
    </body>
</html>
