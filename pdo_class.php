<?php

class MyPDO extends PDO{

  private $_dsn = 'mysql:host=localhost;dbname=testonline';
  private $_user = 'root';
  private $_password;
  private $_encode = 'utf8';
  private $_stmt;


  public function __construct()
  {
    try
    {
        parent::__construct($this->_dsn,$this->_user, $this->_password);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_setEncode();
    }catch(Exception $e)
    {
      print_r($e);
    }
  }

    private function _setEncode()
    {
      $this->query("set names'{$this->_encode}'");
    }
    
    public function __destruct()
    {
        $this->db = null;
    }

    /*
    查詢資料庫fetch all
    */
    public function bindQuery($sql, array $bind = [])
    {
        $this->_stmt = $this->prepare($sql);
        $this->_bind($bind);
        $this->_stmt -> execute();
        return $this->_stmt->fetchALL(PDO::FETCH_ASSOC);

    }
    
    private function _bind($bind)
    {
        foreach($bind as $key => $value){
            $this->_stmt->bindValue($key, $value, is_numeric($value)?PDO::PARAM_INT:PDO::PARAM_STR);
        }
    }
    
    function error()
    {
        $error = $this->_stmt->errorInfo();
        echo 'errorCode:'.$error[0].'<br>';
        echo 'errorString'.$error[2].'<br>';
    }

    //查詢 fetch_assoc
    public function query_data($sql, array $bind = [] )
    {
        $this->_stmt = $this->prepare($sql);
        $this->_bind($bind);
        $this->_stmt -> execute();
        return $this->_stmt->fetch(PDO::FETCH_ASSOC);

    }



    //插入資料
    public function insert_data($table, $data_array)
    {
      if($table===null)return false;
      if(count($data_array) == 0) return false;

      $tmp_col = array();
      $tmp_dat = array();

      foreach ($data_array as $key => $value) {
          $tmp_col[] = $key;
          $tmp_dat[] = ":$key";
          $prepare_array[":".$key] = $value;
      }

      $columns = join(",", $tmp_col);
      $data = join(",", $tmp_dat);

      //insert into qanda (Question, Option1, Option2, Option3, Option4,Ans) value(:question,:option1,:option2,:option3,:option4,:answer)
      $this->sql = "INSERT INTO " . $table . "(" . $columns . ")VALUES(" . $data . ")";
      $stmt = $this->prepare($this->sql);
      $stmt->execute($prepare_array);
      //$this->last_id = $this->db->lastInsertId();
      return true;
    }

    //計算次數
    public function threshold($SNumber)
    {
        $this->sql = "SELECT count(recommend) FROM Recommend WHERE SNumber = $SNumber";
        $this->_stmt = $this->prepare($this->sql);
        $this->_stmt -> execute();
        $row = $this->_stmt->fetch(PDO::FETCH_NUM);
        return $row[0];

    }
   //更新資料
    public function update_data($table, $data_array, $colums)
    {
        if($table == Null) return false;
        if(count($data_array) == 0 ) return false;
        if(!$colums) return false;

        $tmp_col = array();
        $tmp_dat = array();


        foreach($data_array as $key => $value)
        {
            $tmp_col[] = "{$key} = :{$key}";
            //$tmp_dat[":{$key}"] = $value;
            $prepare_array[":".$key] = $value;
        }

        foreach($colums as $key => $value)
        {
            $tmp_dat[] = "{$key} = :{$key}";
            $prepare_array[":".$key] = $value;
        }
        $tmp_dat = join("\tAND\t", $tmp_dat);

        $this->sql = "UPDATE $table SET ". implode(",", $tmp_col). " WHERE ". $tmp_dat;
        $stmt = $this->prepare($this->sql);
        $stmt->execute($prepare_array);
        return true;

    }

    function randomkeys($length)
    {
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
        $key = null;
        for($i=0;$i<$length;$i++){
        $key .= $pattern{rand(0,35)};
        }
        return $key;
    }
        //echo "key = ".randomkeys(8)."";

}

?>
