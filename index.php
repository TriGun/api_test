<?php

require_once('api.php');
require_once('db.php');

if(isset($_POST['action'])){

    $db = DBConnection::getInstance();
    $db->connect();

    $api = new Api();
    $api->do_action($_POST);

    echo json_encode($api->toArray());

}



