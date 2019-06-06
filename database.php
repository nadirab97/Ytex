<?php
  require_once('db_credentials.php');
header('Content-type: text/html; charset=UTF-8');

  class Database{
    private $connection;

    public function __construct(){
      $this->open_db_connection();
    }
    private function open_db_connection() {
       error_reporting(E_ERROR);
      $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
      $this->connection->set_charset("utf8");

      if ($this->connection->connect_errno){
        $this->connection=null;
        exit("Connect failed: %s\n". $this->connection->connect_error);
      }

      $charset = $this->connection->set_charset("utf8");
    }

	   public function get_connection(){
       return $this->connection;
     }

     public function db_disconnect() {
       if(isset($this->connection)){
         $this->connection -> close();
       }
     }
   }

   $database=new Database();
   function confirm_result_set($result_set) {
     if (!$result_set) {
       exit("Database query failed.");
     } elseif (!$result_set-> num_rows > 0) {
     $_SESSION['message'] = "No records found in the Database.";
     }
   }
   $database=new Database();
?>
