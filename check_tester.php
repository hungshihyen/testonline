<?php
session_start();

date_default_timezone_set("Asia/Taipei");
$dateNow=date('Y-m-d H:i:s');
include("pdo_class.php");
$pdo = new MyPDO;
$str="SELECT `SNumber`, `Password` FROM Student WHERE SNumber = '{$_POST["SNumber"]}'";
$query = $pdo->bindQuery($str);
//檢查學號是否正確
if(!$query)
{
	echo "沒有這個使用者！";
	header("refresh:1;URL=test_login.php");
}else
{
	foreach($query as $val)
	{
		 $SNumber = $val['SNumber'];
		 $Password = $val['Password'];
	}

	if($SNumber != $_POST['SNumber'] || $Password != $_POST['Password'])
	{
		print_r($_POST);
		header("refresh:1;URL=test_login.php");
	}else
	{
		//設置時間阻擋
		$str = "SELECT `time` FROM Score WHERE SNumber='$SNumber' ORDER BY time DESC limit 1";
		$query_time = $pdo->bindQuery($str);
		if(!$query_time)
		{
			//完全沒做過測驗
			//echo "welcome";
			$_SESSION['SNumber']=$SNumber;
			header("Location:first_video.php");
		}else
		{
			foreach($query_time as $val)
			{
				$lastTime = $val['time'];
			}

			//現在時間-上次測驗時間 < 100秒 就跳出
			if(strtotime($dateNow)-strtotime($lastTime)<10)
			{
				echo "Work too Hard!";
				header("refresh:1;URL=test_login.php");
			}else
			{
				//設置次數阻擋
				//echo $SNumber;
				$threshold = $pdo->bindQuery("SELECT * FROM `recommend` WHERE `SNumber`= '$SNumber'");
				//var_dump(count($threshold));
				$threshold = count($threshold);
				//var_dump($threshold);
				if(!$threshold)
				{
					$_SESSION['SNumber']=$SNumber;
					header("Location:video.php");
				}else
				{
					//如果 推薦次數 >  N 就跳出。
					if($threshold>=2)
					{
					echo "Work too hard, take a break";
					header("refresh:1;URL=test_login.php");
					}else
					{
					$_SESSION['SNumber']=$SNumber;
					header("Location:video.php");
					}
				}
			}
		}
	}
}
?>
