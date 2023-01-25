<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: index.php');
    exit();
}

require "dbBroker.php";
require "model/Korisnik.php";
require "model/brod.php";

$korisnik = Korisnik::getKorisnikUsername($_SESSION['current_user'],$konekcija)[0];

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evidencija luka i brodova</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel = "shortcut icon" type = "image/x-icon" href = "logo.jpg"/>
</head>
<body>

<div class="header">
    <div class="naslov">
        <h1>Evidencija luka i brodova</h1>
    </div>

    <div class="navigacija d-flex justify-content-between">
        <ul class="nav" id="navigacija-lista" >
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="pocetna.php">Početna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="brod.php">Brodovi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="luka.php">Luke</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nalog.php">Nalog</a>
            </li>
            <li class="nav-item">
                <p class="">Prijavljen na sistem: <?=$_SESSION['current_user']?></p>
            </li>
        </ul>
        <div>
            <a class="btn btn-danger" style="background-color:rgb(47,79,79);border:none " href="odjava.php">Odjavi se</a>
        </div>
    </div>
</div>

<div class="content">
    <div class="naslov">
        <h2>Brod</h2>
    </div>

    <div class="forma">
        <form method="post" id="formaBrod">
            <input type="hidden" name="id" value="">

            <div class="input-group mb-3 container">
                <input class="form-control" type="text" name="nazivBroda" placeholder="Naziv broda" value="">
            </div>
            <div class="input-group mb-3 container">
                <input class="form-control" type="text" name="zemljaPorekla" placeholder="Zemlja porekla" value="">
            </div>

            <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="vrstaBroda" placeholder="Vrsta broda" value="">
            </div>


            <div class="d-grid gap-2 d-md-block">
                <button type="submit"  class="btn btn-success" style="background-color:rgb(169,169,169); border:none">Sačuvaj brod</button>
                <button type="reset" id="resetBrod" class="btn btn-primary" style="background-color:rgb(119,136,153);border:none ">Reset forme za unos broda</button>
                <button type="button" id="obrisiBrod" class="btn btn-danger" style="background-color:rgb(47,79,79);border:none " >Obrisi brod</button>
            </div>

        </form>
    </div>

    <div class="prikazPodataka">
        <div class="d-flex p-1 justify-content-center align-items-center">
            <div>
                <h3>Brodovi</h3>
            </div>
            <div class="w-50 p-3">
                <input class="form-control" type="text" placeholder="pretraga" id="pretraga">
            </div>
            <div>
                <input class="form-control" type="button" id="sortBtn" value="sortiraj">
            </div>
        </div>

       <div class="row row-cols-1 row-cols-sm-2 g-3">
           <?php
           $brodovi=Brod::getAll($konekcija);
           while (($brod=$brodovi->fetch_assoc())!=null){?>

           <div class="col">
               <div class="card" style="background-color: rgba(42,57,89,0.87);">
                   <div class="card-body">
                       <h5 class="card-title"><?=$brod['nazivBroda']?></h5>
                       <p class="card-text"><?=$brod['zemljaPorekla']?></p>
                       <p class="card-text"><?=$brod['vrstaBroda']?></p>
                       <input type="radio" name="brodCheck" value="<?=$brod['id']?>">
               </div>
           </div>
       </div>

        <?php }
        ?>
       </div>



    </div>
</div>



<br>
<br>
<br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/brod.js"></script> 
<script src="js/sortiranjeipretraga.js"></script> 
</body>
</html>