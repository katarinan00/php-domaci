<?php

require "../../dbBroker.php";
require "../../model/luka.php";

if(isset($_POST['id'])){

    $luka = new Luka($_POST['id']);

    $status = $luka->delete($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo $status;
        echo "Neuspesno";
    }

}

?>