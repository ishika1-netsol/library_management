<?php
// class Db
// {  
//     private $host = "localhost";
//     private $db_name  =  "library_mangement";
//     private $username = "root";
//     private $password = "";  

//     protected function __construct()
//     {
//     $mysqli = new mysqli("localhost", "my_user", "my_password", "world");   
//      $dsn = 'mysql:host ='.$this->host . ';dbname='. $this->db_name;
//      $pdo = new PDO($dsn,$this->username,$this->password);
//      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
//     }

//     // public function insert($tablename, $data)
//     // {

//     // }

//     //  public function update($tablename, $id, $data)
//     // {
//     // }
//     // public function delete($tablename, $id)
//     // {

//     // }
//     // public function get($tablename, $id)
//     // {

//     // }
//     // public function getAll($tablename)
//     // {
//     //     $sql = "SELECT * FROM users";
//     //     $stmt = $this->pdo->query($sql);
//     //     while($row = $stmt->fetch()){
//     //       echo $row['id'] ;
//     //     }
//     // }
// }
class DB
{
    protected $_mysqli;
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB = 'library_management';
    public function __construct()
    {
        $this->_mysqli = new mysqli(static::DB_HOST, static::DB_USER, static::DB_PASSWORD, static::DB);
    }
    // public function insert($tableName, $data)
    // {
    //     $stmt = $this->_mysqli->prepare("INSERT INTO " . $tableName . " (" . implode(',', array_keys($data)) . ") VALUES (" . static::getQuestionMarks($data) . ")");
    //     // $stmt->bind_param(static::getVariableType($data), ...$data);
    //     $values = static::getValues($data);
    //     $stmt->bind_param(static::getVariableType($data), ...$values);
    //     return $stmt->execute();
    // }
    // static function getQuestionMarks($data)
    // {
    //     $str = '';
    //     foreach ($data as $value) {
    //         $str .= '?,';
    //     }
    //     return trim($str, ',');
    // }
    // static function getVariableType($data)
    // {
    //     $str = '';
    //     foreach ($data as $value) {
    //         $str .= 's';
    //     }
    //     return trim($str, ',');
    // }
    // static function getValues($data)
    // {
    //     return array_values($data);
    // }
}
// $obj = new DB();
// $obj->insert('users',['name'=>'ishika','status'=>'1'])
?>