<?php

class DBConnection{

    protected static $_instance;

    protected $connection;

    private function __construct(){}

    private function __clone(){}

    public static function getInstance(){

        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function connect(){

        $this->connection = mysql_connect('localhost:3306', 'root', 'root');
        mysql_select_db("api_db");

    }

    public function get($query){

        $result_data = [];
        $result = mysql_query($query);

        if($result){
            while ($row = mysql_fetch_object($result))
            {
                array_push($result_data, $row);
            }
            mysql_free_result($result);
        }

        return $result_data;

    }

    public function insert($query){

        mysql_query($query);

        return mysql_insert_id();

    }

    public function update($query){

        mysql_query($query);

    }

}