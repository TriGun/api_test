<?php

require_once('api.php');
require_once('db.php');

if(isset($_POST['q'])){

    parse_str(base64_decode($_POST['q']), $data);

    if(isset($data['action'])){

        $db = DBConnection::getInstance();
        $db->connect();

        $api = new Api();
        $api->do_action($data);

        echo base64_encode(json_encode( $api->toArray() ));

    }

}





