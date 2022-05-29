<?php
require('App/NameParser.php');

use App\NameParser;

if(isset($_FILES['file'])){
    $data = NameParser::parse($_FILES['file']["tmp_name"]);
    echo json_encode($data);
    exit;
}

?>
