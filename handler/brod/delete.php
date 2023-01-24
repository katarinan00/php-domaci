<?php

require "../../dbBroker.php";
require "../../model/brod.php";

if(isset($_POST['id'])){

    $brod = new Brod($_POST['id']);

    $status = $brod->delete($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo $status;
        echo "Neuspesno";
    }

}

?>