<?php
echo "sdfgdfgdf";
include("../includes/connect.inc.php");
?>
<div class="urlap">
    <form>
        <fieldset>
            <legend>Vásárló törlés</legend>
            </br>
            <label class="mezofelirat">Cég név: </label>
            <select id="vasarlo">
                <option value="0">Bármelyik</option>

                <?php
                $sql = "select * from vasarlok order by ceg_nev";
                $vasarlok = $conn->query($sql);
                while ($vasarlo = $vasarlok->fetch_array(MYSQLI_ASSOC)) {
                    echo "<option value=" . $vasarlo["vasarlo_id"] . ">" . $vasarlo["ceg_nev"] . "</option>";
                }
                ?>


            </select></br></br>
            <label class="mezofelirat">Cím: </label><input type='text' name='cim' id="cim"></br></br>
            <label class="mezofelirat">Telefonszam: </label><input type='text' maxlength="9" min="8" name='telefonszam'></br></br>
            <label class="mezofelirat">Cégjegyzégszám: </label><input type='text' name='cegjegyzekszam1' maxlength="2" style="width: 16px;""><label>
                - </label><input type='text' name='cegjegyzekszam2' maxlength="2" style="width: 16px;""><label>
                - </label><input type='text' name='cegjegyzekszam3' maxlength="6" style="width: 64px;""></br></br>
            <label class="mezofelirat">Adószám: </label><input type='text' name='adoszam1' maxlength="8" style="width: 60px;""><label>
                - </label><input type='text' name='adoszam2' maxlength="1" style="width: 8px;"><label> - </label><input
                type='text' name='adoszam3' maxlength="2" style="width: 16px;"></br></br>
            <label class="mezofelirat">Email cím: </label><input type='text' name='emailcim'></br></br>
            <input type="button" name="torles" class="mentes" value="Törlés">

        </fieldset>
    </form>
</div>

<script>
    function valtozas() {
        var id = $("#vasarlo").val();


        $.ajax({
            type: "POST",
            url: "includes/vasarlo_listaz.php",
            data: {id: id},
            datatype: "json",
            success: function (valasz) {
                valasztomb = JSON.parse(valasz);
                $("input[name='cim']").val(valasztomb["ceg_cim"]);
                $("input[name='emailcim']").val(valasztomb["ceg_email"]);
                $("input[name='telefonszam']").val(valasztomb["ceg_telefonszam"]);
                $("input[name='cegjegyzekszam1']").val(valasztomb["ceg_cegjegyzekszam"].substr(0, 2));
                $("input[name='cegjegyzekszam2']").val(valasztomb["ceg_cegjegyzekszam"].substr(2, 2));
                $("input[name='cegjegyzekszam3']").val(valasztomb["ceg_cegjegyzekszam"].substr(4, 6));
                $("input[name='adoszam1']").val(valasztomb["ceg_adoszam"].substr(0, 8));
                $("input[name='adoszam2']").val(valasztomb["ceg_adoszam"].substr(8, 1));
                $("input[name='adoszam3']").val(valasztomb["ceg_adoszam"].substr(9, 2));


            }
        });
    }

    function torles() {

        var id = $("#vasarlo").val();
        var cim = $("input[name='cim']").val();
        var email = $("input[name='emailcim']").val();
        var telefonszam = $("input[name='telefonszam']").val();
        var cegjegyzekszam1 = $("input[name='cegjegyzekszam1']").val();
        var cegjegyzekszam2 = $("input[name='cegjegyzekszam2']").val();
        var cegjegyzekszam3 = $("input[name='cegjegyzekszam3']").val();
        var adoszam1 = $("input[name='adoszam1']").val();
        var adoszam2 = $("input[name='adoszam2']").val();
        var adoszam3 = $("input[name='adoszam3']").val();
        console.log("törlés");
        if (id == 0)alert("Válaasz ki egy vásárlót"); else {
            if (confirm("Biztos hogy törölni akarod ezt a vásárlót az összes adatával együtt?")) {
                $.ajax({
                    type: "POST",
                    url: "includes/vasarlo_torol.php",
                    data: {
                        id: id,
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
                        $("#vasarlo").val(0);
                        $("input[type='text']").val(null);

                    }
                });
            }
        }
    }


    $(document).ready(function () {
        $("input[name='cim']").prop('disabled', true);
        $("input[name='emailcim']").prop('disabled', true);
        $("input[name='telefonszam']").prop('disabled', true);
        $("input[name='cegjegyzekszam1']").prop('disabled', true);
        $("input[name='cegjegyzekszam2']").prop('disabled', true);
        $("input[name='cegjegyzekszam3']").prop('disabled', true);
        $("input[name='adoszam1']").prop('disabled', true);
        $("input[name='adoszam2']").prop('disabled', true);
        $("input[name='adoszam3']").prop('disabled', true);


        $("#vasarlo").change(valtozas);
        $("input[type='button']").click(torles);
    });
</script>