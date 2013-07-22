<?php

class DAO {
    private static $Database = null;
    private static $mysqli = null;
    
    public static function GetDatabase() {
        if((self::$Database) === null) {
            self::$Database = new DAO();
        }
        return self::$Database;
    }

    private function __construct() {
        
        $server = "localhost"; 
        $database = "usr_web5_3";
        $username = "web5";
        $password = "k1nbRmiWNG";

        self::$mysqli = @new mysqli($server, $username, $password, $database);

        if (mysqli_connect_errno()) {
            print("Database connection failed: \n" . mysqli_connect_error());
            exit();
        }
    }

    public function GetRowsOfQuery($query) {
        $result = self::$mysqli->query($query);

        $return = array();

        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $return[] = $row;
        }

        return $return;
    } 

    public function GetQueryResult($query) {
        return self::$mysqli->query($query);
    }
}
?>