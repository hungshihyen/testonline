<?php
include("pdo_class.php");
$pdo = new MyPDO;

$str = "SELECT * FROM student WHERE SNumber = '{$_POST["n"]}'";
$query = $pdo->bindQuery($str);
if(!$query)
{
    echo "noEntry";
}else
{
    echo "Entry";
}

?>