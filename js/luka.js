$('#formaLuka').submit(function (){
    event.preventDefault();
    const $form = $(this);
    const $input = $form.find('input','textarea','select');

    const data=$form.serialize();

    console.log(data);

    $input.prop('disabled',true);
    if($('input[name="id"]').val()==""){
        req=$.ajax({
            url: 'handler/luke/add.php',
            type:'post',
            data: data
        });
    }else{
        req=$.ajax({
            url: 'handler/luke/update.php',
            type:'post',
            data: data
        });
    }

    $input.prop('disabled',false);

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno sačuvana luka");
            location.reload();
        }else{
            alert("Neuspešno sačuvana luka")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});

function popuniFormu(idT){
    let id=idT;

    req=$.ajax({
        url: 'handler/luke/get.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){

        let luka = $.parseJSON(res)[0];

        $('input[name="id"]').val(luka.id);
        $('input[name="korisnik_id"]').val(luka.korisnik_id);
        $('input[name="nazivLuke"]').val(luka.nazivLuke);
        $('select[name="brod_id"]').val(luka.brod_id);
        $('select[name="grad"]').val(luka.grad);

    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });
}

$('input[name="lukaCheck"]').click(function (){
    popuniFormu($('input[name="lukaCheck"]:checked').val());
});

$('#resetLuka').click(function (){
    $('input[name="id"]').val("");
});



$('#obrisiLuku').click(function(){
    let id = $('input[name="id"]').val();

    if(id==""){
        alert("Luka nije odabrana");
        return;
    }

    req=$.ajax({
        url: 'handler/luke/delete.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno obrisana luka");
            location.reload();
        }else{
            alert("Neuspešno obrisana luka")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });
});