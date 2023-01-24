<?php

class Luka
{
    private $id;
    private $nazivLuke;
    private $grad;
    private $korisnik_id;
    private $brod_id;


    public function __construct($id=null, $nazivLuke=null, $grad=null, $korisnik_id=null, $brod_id=null)
    {
        $this->id = $id;
        $this->nazivLuke = $nazivLuke;
        $this->grad = $grad;
        $this->korisnik_id = $korisnik_id;
        $this->brod_id = $brod_id;
    }


    public function add(mysqli $conn){
        $upit = "INSERT INTO luke (nazivLuke,grad,korisnik_id,brod_id) 
                 VALUES ('$this->nazivLuke','$this->grad','$this->korisnik_id','$this->brod_id');";
        return $conn->query($upit);
    }

    public function update(mysqli $conn){
        $upit = "UPDATE luke set nazivLuke = '$this->nazivLuke',grad = '$this->grad',
                   korisnik_id = '$this->korisnik_id',brod_id = '$this->brod_id'  WHERE id=$this->id";
        return $conn->query($upit);
    }

    public function delete(mysqli $conn){
        $upit = "DELETE FROM luke WHERE id='$this->id'";
        return $conn->query($upit);
    }

    public static function getAll(mysqli $conn)
    {
        $upit = "SELECT * FROM luke";
        return $conn->query($upit);
    }


    public static function getLuka($id, mysqli $conn){
        $upit = "SELECT * FROM luke WHERE id='$id'";

        $luka = array();
        if($obj = $conn->query($upit)){
            while($red = $obj->fetch_array(1)){
                $luka[]= $red;
            }
        }

        return $luka;
    }
}