<?php
    abstract class Database_Object
    {
        protected static $DB_Name;
        protected static $DB_Open;
        protected static $DB_Conn;

        protected function __construct($database, $hostname, $hostport, $username, $password)
        {
        	//TODO: We could have this in a property file
        	$database="mind_power";
        	$hostname="127.0.0.1";
        	$hostport="3306";
        	$username="mind_power";
        	$password="mind_power";
        	
            self::$DB_Name = $database;
            self::$DB_Conn = mysql_connect($hostname . ":" . $hostport, $username, $password);
            if (!self::$DB_Conn) { die('Critical Stop Error: Database Error<br />' . mysql_error()); }
            mysql_select_db(self::$DB_Name, self::$DB_Conn);
        }

        private function __clone() {}

        public function __destruct()
        {
           mysql_close(self::$DB_Conn);
           //  <-- commented out due to current shared-link close 'feature'.  If left in, causes a warning that this is not a valid link resource.
        }
    }

    final class DB extends Database_Object
    {
        public static function Open($database = DB_NAME, $hostname = DB_HOST, $hostport = DB_PORT, $username = DB_USER, $password = DB_PASS)
        {
            if (!self::$DB_Open)
            {
                self::$DB_Open = new self($database, $hostname, $hostport, $username, $password);
            }
            else
            {
                self::$DB_Open = null;
                self::$DB_Open = new self($database, $hostname, $hostport, $username, $password);
            }
            return self::$DB_Open;
        }

        public function qry($sql, $return_format = 0)
        {
            $query = mysql_query($sql, self::$DB_Conn) OR die(mysql_error());
            switch ($return_format)
            {
                case 1:
                    $query = mysql_fetch_row($query);
                    return $query;
                    break;
                case 2:
                    $query = mysql_fetch_array($query);
                    return $query;
                    break;
                case 3:
                    $query = mysql_fetch_row($query);
                    $query = $query[0];
                    return $query;
                default:
                    return $query;
            }
        }
        
        public function qry_row_num($result){
        	return mysql_numrows($result);
        }
    }
?>