<?php
session_start();

if($_POST['password'] != $_POST['randomkey'])
{
	echo "驗證碼錯誤!";
	header("refresh:1;URL=test_login.php");
}else
{
	date_default_timezone_set("Asia/Taipei");
	$dateNow=date('Y-m-d H:i:s');
	include("pdo_class.php");
	$pdo = new MyPDO;
	$str="SELECT SNumber FROM Student WHERE SNumber = '{$_POST["SNumber"]}'";
	$query = $pdo->bindQuery($str);
	//檢查學號是否正確
	if(!$query)
	{
		echo"輸入的學號錯誤!";
		header("refresh:1;URL=test_login.php");
	}else
	{
		foreach($query as $val)
		{
		 $SNumber = $val['SNumber'];
		}
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


	/*
	$date="SELECT * FROM Score WHERE SNumber='$SNumber' ORDER BY time DESC limit 1";
		$result2=mysql_query($date) or die(mysql_errno());
		$date_row=mysql_fetch_array($result2);
		$date2=$date_row[5];
		//echo $date2;
	    $query_threshold="SELECT recommend FROM Recommend WHERE SNumber='$SNumber'";
		$threshold=mysql_query($query_threshold) or die(mysql_errno());
		//echo mysql_num_rows($threshold);
		if(mysql_num_rows($threshold)<4){
			if ($row[0] != $SNumber|| $row[1] !=$SNAME){
			unset($_SESSION[$SNumber]);
			header("refresh:1;URL=test_login.php");
			echo"輸入的學號或姓名錯誤!";
			}
		else{
			if(strtotime($date1)-strtotime($date2)>10){
				header("Location:recommend.php");
			    }
			else{
			    echo"TAKE A BREAK!";
				unset($_SESSION[$SNumber]);
			    header("refresh:1;URL=test_login.php");

			  }
			}
		}
		else{

			header("refresh:1;URL=test_login.php");
			echo "Work too hard, take a break";
		}

	*/
?>
