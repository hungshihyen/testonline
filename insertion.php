<?php
  require('pdo_class.php');
//echo $_POST['answer'];
$data_array = array(
    'Unit' => $_POST['Unit'],
    'QID' => $_POST['QID'],
    'Que' => $_POST['question'],
    'Option1' => $_POST['Option1'],
    'Option2' => $_POST['Option2'],
    'Option3' => $_POST['Option3'],
    'Option4' => $_POST['Option4'],
    'Ans' => $_POST['answer']
);

$pdo = new MyPDO();

$table="qanda";
$ins = $pdo->insert_data($table, $data_array);
if(!$ins)
{
    echo "建立失敗";
}
  echo "建立成功".'<br>';
 ?>
 <a href="qanda.php">繼續建立</a>
