<?php

require_once('db.php');

class Users {

    static function auth($login, $password){

        $db = DBConnection::getInstance();
        $login = mysql_real_escape_string($login);
        $password = md5( mysql_real_escape_string($password) );

        $result = $db->get("SELECT id FROM users WHERE login = '$login' and password = '$password'");

        if(!empty($result[0]))
            return $result[0]->id;

        return False;

    }

    static function get_emai_by_id($id){

        $db = DBConnection::getInstance();
        $id = mysql_real_escape_string($id);

        $result = $db->get("SELECT email FROM users WHERE id = '$id'");

        if(!empty($result[0]))
            return $result[0]->email;

        return False;

    }
} 