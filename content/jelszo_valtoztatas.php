<div class="urlap">
    <form>
        <fieldset>
            <legend>Jelszó módosítás</legend>
            </br>


            <label class="mezofelirat">Régi jelszó: </label><input type='password' name='regi_jelszo'
                                                                   style="width: 100px"><span
                title="Hibás régi jelszó!"> - Hibás mező <img
                    src="style/images/question.png" height="12" width="12"></span></br></br>
            <label class="mezofelirat">Új jelszó: </label><input type='password' name='uj_jelszo'
                                                                 style="width: 100px"></br></br>
            <label class="mezofelirat">Új jelszó újra: </label><input type='password' name='uj_jelszo_ujra'
                                                                      style="width: 100px"><span
                title="Nem egyeznek a megadott új jelszavak!"> - Hibás mező <img
                    src="style/images/question.png" height="12" width="12"></span></br></br>

            <input type="button" name="felvitel" class="mentes" value="Jelszó módosítás">

        </fieldset>
    </form>
</div>


<script>
    function jelszo_modosit() {


        var regi_jelszo = $("input[name='regi_jelszo']").val();
        $.ajax({
            type: "POST",
            url: "includes/jelszo_ellenoriz.php",
            data: {
                regi_jelszo: regi_jelszo

            },
            success: function (valasz) {

                if (valasz == true) {
                    $("input[name='regi_jelszo']").next("span").hide();
                    if ($("input[name='uj_jelszo']").val() == "") {
                        alert("ird be az uj jelszot");
                    } else {

                        if ($("input[name='uj_jelszo']").val() != $("input[name='uj_jelszo_ujra']").val()) {
                            $("input[name='uj_jelszo_ujra']").next("span").show();
                        } else {
                            $("input[name='uj_jelszo_ujra']").next("span").hide();
//                            console.log("minden jó");

                            var uj_jelszo =$("input[name='uj_jelszo']").val();
                            var uj_jelszo2 = $("input[name='uj_jelszo_ujra']").val();


                            $.ajax({
                                type: "POST",
                                url: "includes/jelszo_valtoztat.php",
                                data: {
                                    regi_jelszo: regi_jelszo,
                                    uj_jelszo : uj_jelszo,
                                    uj_jelszo2 : uj_jelszo2

                                },
                                success: function (valasz) {
                                    if(valasz="siker"){
                                        alert("A jelszó módosítása sikeres, jelentkezz be az ujjelszavaddal!");

                                        $("#gomb_kilepes").click();
                                    }else{
                                        alert(valasz);
                                    }

                                }
                            });

                        }
                    }
                }
                else {

                    $("input[name='regi_jelszo']").next("span").show();
                }
            }
        });


    }
    ;

    $(document).ready(function () {


        $("span").hide();
        $("input[type='button']").click(jelszo_modosit);
    });

</script>
