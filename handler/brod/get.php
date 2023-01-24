<?php

require "../../dbBroker.php";
require "../../model/brod.php";

if(isset($_POST['id'])){

    $obj = Brod::getBrod($_POST['id'],$konekcija);

    echo json_encode($obj);

}

?>