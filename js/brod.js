$('#formaBrod').submit(function (){
    event.preventDefault();
    const $form = $(this);
    const $input = $form.find('input','textarea');

    const data=$form.serialize();

    console.log(data);

    $input.prop('disabled',true);
    if($('input[name="id"]').val()==""){
        req=$.ajax({
            url: 'handler/brod/add.php',
            type:'post',
            data: data
        });
    }else{
        req=$.ajax({
            url: 'handler/brod/update.php',
            type:'post',
            data: data
        });
    }

    $input.prop('disabled',false);

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno sačuvan brod");
            location.reload();
        }else{
            alert("Neuspešno sačuvan brod")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});

$('input[name="brodCheck"]').click(function (){

    let id=$('input[name="brodCheck"]:checked').val();

    req=$.ajax({
        url: 'handler/brod/get.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){

        let brod = $.parseJSON(res)[0];

        $('input[name="id"]').val(brod.id);
        $('input[name="nazivBroda"]').val(brod.nazivBroda);
        $('input[name="zemljaPorekla"]').val(brod.zemljaPorekla);
        $('input[name="vrstaBroda"]').val(brod.vrstaBroda);


    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});

$('#resetBrod').click(function (){
    $('input[name="id"]').val("");
});

$('#obrisiBrod').click(function(){
    let id = $('input[name="id"]').val();

    if(id==""){
        alert("Brod nije odabran");
        return;
    }

    req=$.ajax({
        url: 'handler/brod/delete.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno obrisan brod");
            location.reload();
        }else{
            alert("Neuspešno obrisan brod")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });
});