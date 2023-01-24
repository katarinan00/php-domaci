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
            <a class="btn btn-danger" href="odjava.php">Odjavi se</a>
        </div>
    </div>
</div>

<div class="content">
    <div class="naslov">
        <h2>Luke</h2>
    </div>

    <div class="forma">
        <form method="post" id="formaLuka">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="korisnik_id" value="<?=$korisnik['id']?>">


            <div class="input-group mb-3 container">
                <span class="input-group-text">Brod</span>
                <select class="form-control" type="text" name="brod_id" placeholder="Brod" value="">
                    <option value="0">Nema</option>
                    <?php
                    $brodovi=Brod::getAll($konekcija);
                    while(($brod=$brodovi->fetch_assoc())!=null){?>
                        <option value="<?=$brod['id']?>"><?=$brod['nazivBroda']." ".$brod['zemljaPorekla']?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="input-group mb-3 container">
                <span class="input-group-text">Naziv luke</span>
                <input class="form-control" type="text" name="nazivLuke" value="">
            </div>
            <div class="input-group mb-3 container">
                <span class="input-group-text">Grad</span>
                <input class="form-control" type="text" name="grad" value="">
            </div>



            <div class="d-grid gap-2 d-md-block">
                <button type="submit"  class="btn btn-success" style="background-color: rgba(27,133,24,0.76)">Sačuvaj luku</button>
                <button type="reset" id="resetLuka" class="btn btn-primary">Obriši podatke</button>
                <button type="button" id="obrisiLuku" class="btn btn-danger" style="background-color: rgba(238,5,5,0.8)" >Obriši luku</button>
            </div>

        </form>
    </div>


    <div class="prikazPodataka">
        <div class="d-flex p-1 justify-content-center align-items-center">
            <div>
                <h3>Luke</h3>
            </div>
            <div class="w-50 p-3">
                <input class="form-control" type="text" placeholder="pretraga" id="pretraga">
            </div>
            <div>
                <input class="form-control" type="button" id="sortBtn" value="Sortiraj">
            </div>
            <div>
                <input class="form-control" type="button" id="sortRBtn" value="Sortiraj po gradovima">
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 g-3">
            <?php
            $luke=Luka::getAll($konekcija);
            while (($luka=$luke->fetch_assoc())!=null){?>

                <div class="col">
                    <div class="card" style="background-color: rgba(42,57,89,0.87);">
                        <div class="card-body">
                            <h5 class="card-title"><?=$luka['nazivLuke']?></h5>
                            <?php $brod=Brod::getBrod($luka['brod_id'],$konekcija)[0]?>
                            <p class="card-text">Brod: <?=$brod['nazivBroda']." ".$brod['zemljaPorekla']?></p>
                            <p class="card-text">Naziv luke: <?=$luka['nazivLuke']?></p>
                            <p class="card-text karticaGrad">Grad: <?=$luka['grad']?></p>  
                            <?php $korisnikK=Korisnik::getKorisnik($luka['korisnik_id'],$konekcija)[0]?>
                            <p class="card-text">Korisnik dodao: <?=$korisnikK['username']?></p>
                            <input type="radio" name="lukaCheck" value="<?=$luka['id']?>">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php
if(isset($_POST['id'])){
    echo '<script type="text/javascript">
            popuniFormu('.$_POST["id"].');
        </script>'
    ;

}
?>
</body>
</html>