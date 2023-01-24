<?php

class Brod
{

    private $id;
    private $nazivBroda;
    private $zemljaPorekla;
    private $vrstaBroda;



    public function __construct($id=null, $nazivBroda=null, $zemljaPorekla=null, $vrstaBroda=null)
    {
        $this->id = $id;
        $this->nazivBroda = $nazivBroda;
        $this->zemljaPorekla = $zemljaPorekla;
        $this->vrstaBroda = $vrstaBroda;

    }


    public function add(mysqli $conn){
        $upit = "INSERT INTO brodovi (nazivBroda,zemljaPorekla,vrstaBroda) 
                 VALUES ('$this->nazivBroda','$this->zemljaPorekla','$this->vrstaBroda');";
        return $conn->query($upit);
    }

    public function update(mysqli $conn){
        $upit = "UPDATE brodovi set nazivBroda = '$this->nazivBroda',zemljaPorekla = '$this->zemljaPorekla',
                   vrstaBroda = '$this->vrstaBroda'  WHERE id='$this->id'";
        return $conn->query($upit);
    }

    public function delete(mysqli $conn){
        $upit = "DELETE FROM brodovi WHERE id='$this->id'";
        return $conn->query($upit);
    }

    public static function getAll(mysqli $conn)
    {
        $upit = "SELECT * FROM brodovi";
        return $conn->query($upit);
    }


    public static function getBrod($id, mysqli $conn){
        $upit = "SELECT * FROM brodovi WHERE id='$id'";

        $brod = array();
        if($obj = $conn->query($upit)){
            while($red = $obj->fetch_array(1)){
                $brod[]= $red;
            }
        }

        return $brod;
    }


}