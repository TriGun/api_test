<?php

require_once('api.php');
require_once('db.php');
require_once('aes.php');

$EN_KEY = '4375NDYHBHBK34534BL534B534';

if(isset($_POST['q'])){

    parse_str(AesCtr::decrypt(base64_decode($_POST['q']), $EN_KEY, 128), $data);

    if(isset($data['action'])){

        $db = DBConnection::getInstance();
        $db->connect();

        $api = new Api();
        $api->do_action($data);

        echo base64_encode(AesCtr::encrypt( json_encode( $api->toArray() ), $EN_KEY, 128));

    }

}