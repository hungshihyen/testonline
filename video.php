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
<p align="center">
<iframe width="1200" height="700" src="<?php echo $src;?>" frameborder="0" allowfullscreen></iframe>
<div>
    <form name="form1" method="POST" action="test.php">
        <td colspan="2"><p align="center">
        <input name="buttom" type="submit" value="進入測驗">
        </td>
    </form>
</div>