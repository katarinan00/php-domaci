<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: index.php');
    exit();
}

require "dbBroker.php"; 
require "model/Korisnik.php";
require "model/brod.php";
require "model/luka.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evidencija luka i brodova </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            <a class="btn btn-danger" href="odjava.php" >Odjavi se</a>
        </div>
    </div>
</div>

<div class="pocetnaStranaSadrzaj">

    <div class="d-flex p-1 justify-content-center align-items-center">
        <div>
            <h3>Sve luke</h3>
        </div>
        <div class="w-50 p-3">
            <input class="form-control" type="text" placeholder="pretraga" id="pretraga">
        </div>
        <div>
            <input class="form-control" type="button" id="sortBtn" value="sortiraj">
        </div>
    </div>



</div>

<div class="row row-cols-1 row-cols-sm-2 g-3 justify-content-center">
<?php
        $luke=Luka::getAll($konekcija);
        while (($luka=$luke->fetch_assoc())!=null){?>
                <form method="post" action="luka.php"  class="col">
                    <div class="card" style="background-color: rgba(42,57,89,0.87); width: 35vw; margin-left: auto; margin-right: auto">
                        <div class="card-body">
                        <input type="hidden" name="id_luke" value="<?=$luka['id']?>" >
                            <h5 class="card-title"><?=$luka['nazivLuke']?></h5>
                            <?php $brod=Brod::getBrod($luka['brod_id'],$konekcija)[0]?>
                            <p class="card-text">Brod: <?=$brod['nazivBroda']." ".$brod['zemljaPorekla']?></p>                                     
                            <p class="card-text">Naziv Luke: <?=$luka['nazivLuke']?></p>
                            <p class="card-text">Grad: <?=$luka['grad']?></p>                     
                            <?php $korisnikK=Korisnik::getKorisnik($luka['korisnik_id'],$konekcija)[0]?>
                            <p class="card-text">Korisnik dodao: <?=$korisnikK['username']?></p>
                            <button type="submit" class="btn btn-primary">Pogledaj</button>
                        </div>
                    </div>
                </form>
        <?php }
        ?>

    </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>