function load_oldal(oldal) {
    deaktiv();
    $(event.target).closest(".fomenu").addClass("active");
    $.ajax({
        type: "POST",
        url: "includes/oldal.php",
        data: {page: oldal},
        success: function (valasz) {
            $("#rightside").html(valasz);
        }
    });
}

function deaktiv(){
    $(".active").removeClass("active");
}

function uresmezo_ellenoriz(mezo){
    if(mezo.val() == ""){
        mezo.next("span").show();

        return false;

    }else{
        mezo.next("span").hide();
        return true;
    }
}


function telefonmezo_ellenoriz(mezo){
    if(mezo.val().length >= 8 && mezo.val().match(/^\d+$/)){
        mezo.next("span").hide();
        return true;
    }else{
        mezo.next("span").show();
        return false;
    }

}

function cegjegyzek_ellenoriz(mezo1, mezo2, mezo3){
    if(mezo1.val().length == 2 && mezo1.val().match(/^\d+$/) && mezo2.val().length == 2 && mezo2.val().match(/^\d+$/) && mezo3.val().length == 6 && mezo3.val().match(/^\d+$/)){
        mezo3.next("span").hide();
        return true;
    }else{
        mezo3.next("span").show();
        return false;
    }
}

function adoszam_ellenoriz(mezo1, mezo2, mezo3){
    if(mezo1.val().length == 8 && mezo1.val().match(/^\d+$/) && mezo2.val().length == 1 && mezo2.val().match(/^\d+$/) && mezo3.val().length == 2 && mezo3.val().match(/^\d+$/)){
        mezo3.next("span").hide();
        return true;
    }else{
        mezo3.next("span").show();
        return false;
    }
}

function email_ellenoriz(mezo){
   if( mezo.val().match(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/) ){
        mezo.next("span").hide();
       return true;
   }else{
       mezo.next("span").show();
       return false;
   }
}

function kosar_frissites(id,db){
    $.ajax({
        type: "POST",
        url: "includes/kosar.php",
        data: {id : id,
            mennyiseg :db

        },
        success: function (valasz) {
            console.log(valasz);
        }
    });

}