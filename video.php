<?php
session_start();
include("pdo_class.php");
if(!isset($_SESSION['SNumber']))
{
    header("Location:test_login.php");
}else
{
    $SNumber=$_SESSION['SNumber'];

    $pdo = new MyPDO;
    $str = "SELECT * FROM Recommend WHERE SNumber='$SNumber' ORDER BY time DESC limit 1";
    $query = $pdo->bindQuery($str);

    if(!$query)
    {
    echo "error";
    
    }else
    {
        foreach($query as $row)
        {
            $video = $row['recommend'];
            $_SESSION['Unit'] = $row['recommend'];
        }
        $video_web="SELECT web FROM Video WHERE No='$video'";
        $query = $pdo->bindQuery($video_web);

        foreach($query as $value)
        {
            $src = $value['web'];
        }
    }
   
}
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
					<div class="col-xs-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?php echo $src;?>"  allowfullscreen></iframe>
                        </div>
					</div>
				</div>
			</div>
        </div>
        <div>
            <form name="form" method="POST" action="test.php">
                <div class="text-center">
                    <input class="btn btn-light btn-lg" type="submit" value="進入測驗">
                </div>
            </form>
        </div>
	</body>
</html>