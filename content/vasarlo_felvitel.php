<?php

?>
<div class="urlap">
    <form>
        <fieldset>
            <legend>Vásárló felvitel</legend></br>
            <label class="mezofelirat">Cég név: </label><input type='text' name='cegnev'><span title="Írd be a nevet"> - Hibás mező <img src="style/images/question.png" height="12" width="12"></span></br></br>
            <label class="mezofelirat">Cím: </label><input type='text' name='cim' id="cim"><span title="Írd be a címet"> - Hibás mező <img src="style/images/question.png" height="12" width="12"></span></br></br>
            <label class="mezofelirat">Telefonszam: </label><input type='text' maxlength="9" min="8" name='telefonszam' style="width: 120px;"><span title="A telefonszám 8 vagy 9 számjegy elválasztójel nélkül"> - Hibás mező <img src="style/images/question.png" height="12" width="12"></span></br></br>
            <label class="mezofelirat">Cégjegyzégszám: </label><input type='text' name='cegjegyzekszam1' maxlength="2" style="width: 16px;""><label>
                - </label><input type='text' name='cegjegyzekszam2' maxlength="2" style="width: 16px;""><label>
                - </label><input type='text' name='cegjegyzekszam3' maxlength="6" style="width: 64px;""><span title="A cégjegyzekszam 12-12-123456 formátumú"> - Hibás mező <img src="style/images/question.png" height="12" width="12"></span></br></br>
            <label class="mezofelirat">Adószám: </label><input type='text' name='adoszam1' maxlength="8" style="width: 60px;""><label>
                - </label><input type='text' name='adoszam2' maxlength="1" style="width: 8px;"><label> - </label><input
                type='text' name='adoszam3' maxlength="2" style="width: 16px;"><span title="Az adószám 12345678-1-12 formátumú"> - Hibás mező <img src="style/images/question.png" height="12" width="12"></span></br></br>
            <label class="mezofelirat">Email cím: </label><input type='text' name='emailcim'><span title="Az email aaa@aaa.aa formátumú"> - Hibás mező <img src="style/images/question.png" height="12" width="12"></span></br></br>
            <input type="button" name="mentes" class="mentes" value="Mentés">
        </fieldset>
    </form>
</div>


<script>

    function mentes(){
        var nev = $("input[name='cegnev']").val();
        var cim = $("input[name='cim']").val();
        var email = $("input[name='emailcim']").val();
        var telefonszam = $("input[name='telefonszam']").val();
        var cegjegyzekszam1 = $("input[name='cegjegyzekszam1']").val();
        var cegjegyzekszam2 = $("input[name='cegjegyzekszam2']").val();
        var cegjegyzekszam3 = $("input[name='cegjegyzekszam3']").val();
        var adoszam1 = $("input[name='adoszam1']").val();
        var adoszam2 = $("input[name='adoszam2']").val();
        var adoszam3 = $("input[name='adoszam3']").val();

        uresmezo_ellenoriz($("input[name='cegnev']"));
        uresmezo_ellenoriz($("input[name='cim']")) ;
        telefonmezo_ellenoriz($("input[name='telefonszam']")) ;
        cegjegyzek_ellenoriz($("input[name='cegjegyzekszam1']"), $("input[name='cegjegyzekszam2']"), $("input[name='cegjegyzekszam3']")) ;
        adoszam_ellenoriz($("input[name='adoszam1']"), $("input[name='adoszam2']"), $("input[name='adoszam3']")) ;
        email_ellenoriz($("input[name='emailcim']"));

        if(
            uresmezo_ellenoriz($("input[name='cegnev']")) &&
            uresmezo_ellenoriz($("input[name='cim']")) &&
            telefonmezo_ellenoriz($("input[name='telefonszam']")) &&
            cegjegyzek_ellenoriz($("input[name='cegjegyzekszam1']"), $("input[name='cegjegyzekszam2']"), $("input[name='cegjegyzekszam3']")) &&
            adoszam_ellenoriz($("input[name='adoszam1']"), $("input[name='adoszam2']"), $("input[name='adoszam3']")) &&
            email_ellenoriz($("input[name='emailcim']")) ) {


            $.ajax({
                type: "POST",
                url: "includes/vasarlo_mentes2.php",
                data: {
                    nev: nev,

                    cim: cim,
                    email: email,
                    telefonszam: telefonszam,
                    cegjegyzekszam1: cegjegyzekszam1,
                    cegjegyzekszam2: cegjegyzekszam2,
                    cegjegyzekszam3: cegjegyzekszam3,
                    adoszam1: adoszam1,
                    adoszam2: adoszam2,
                    adoszam3: adoszam3
                },
                success: function (valasz) {

                    alert(valasz);
                    $("input[name='cegnev']").val("");
                    $("input[name='cim']").val("");
                    $("input[name='emailcim']").val("");
                    $("input[name='telefonszam']").val("");
                    $("input[name='cegjegyzekszam1']").val("");
                    $("input[name='cegjegyzekszam2']").val("");
                    $("input[name='cegjegyzekszam3']").val("");
                    $("input[name='adoszam1']").val("");
                    $("input[name='adoszam2']").val("");
                    $("input[name='adoszam3']").val("");
                }
            });


        }
    }



    $(document).ready(function () {


        $("span").hide();
        $("input[type='button']").click(mentes);
    });

</script>