<?php

require "../../dbBroker.php";
require "../../model/luka.php";

if(isset($_POST['id'])){

    $obj = Luka::getLuka($_POST['id'],$konekcija);

    echo json_encode($obj);

}

?>