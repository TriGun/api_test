<?php

require_once('users.php');
require_once('db.php');

class Api {

    public $action;
    public $params = [];
    public $errors = [];
    public $messages = [];
    public $response = [];

    public function toArray(){
        return [
            'errors' => $this->errors,
            'messages' => $this->messages,
            'response' => $this->response
        ];
    }

    private function set_error($error){

        array_push($this->errors, $error);

    }

    private function set_messages($messages){

        array_push($this->messages, $messages);

    }

    function do_action($data){

        $this->action = $data['action'];

        switch($this->action){

            case 'auth':

                if(isset($data['login']) && isset($data['password']))
                    $this->auth($data['login'], $data['password']);
                else
                    $this->set_error('No login or password in data');

                break;

            case 'get_email':

                if(isset($data['id']) && isset($data['skey']))
                    $this->get_email($data['id'], $data['skey']);
                else
                    $this->set_error('No users id in data');

                break;
        }

        $this->log_in_db();

    }

    private function auth($login, $password){

        $this->params = [
            'login' => $login,
            'password' => $password];

        $this->response['user'] = Users::auth($login, $password);

        if(!empty($this->response['user']))
            $this->set_messages('Success auth');
        else
            $this->set_error('No valid login or password');

    }

    private function get_email($id, $skey){

        $this->params = ['id' => $id];

        $this->response['email'] = Users::get_emai_by_id($id, $skey);

        if(!empty($this->response['email']))
            $this->set_messages('Success get email by id');
        else
            $this->set_error('No this id in data base');

    }

    private function log_in_db(){

        $db = DBConnection::getInstance();
        $action = $this->action;
        $params = json_encode($this->params);
        $messages = json_encode(array_merge($this->errors, $this->messages));
        $ip = $_SERVER['REMOTE_ADDR'];

        $db->insert("INSERT INTO logs (action, params, messages, ip) VALUES ('$action', '$params', '$messages', '$ip')");

    }
}