<?php

include("../includes/connect.inc.php");

?>


<div class="urlap">
    <form>
        <fieldset>
            <legend>Termék felvitel</legend>
            </br>
            <label>Termék kategória: </label>
            <select id="termek_kateg">
                <option value="0">Válassz!</option>
                <?php
                $sql = "SELECT * FROM `termek_ketegoriak` ORDER BY `kategoria_nev`";
                $termek_kategek = $conn->query($sql);
                while ($termek_kateg = $termek_kategek->fetch_array(MYSQLI_ASSOC)) {
                    echo "<option value=" . $termek_kateg["kategoria_id"] . ">" . $termek_kateg["kategoria_nev"] . "</option>";
                }
                ?>

            </select> <span title="Válassz egy kategóriát!"> - Hibás mező <img src="style/images/question.png"
                                                                               height="12" width="12"></span></br></br>

            <label>Termék név: </label><input type="text" name="termek_nev" style="width: 150px"><span
                title="Írd be a termék nevét"> - Hibás mező <img src="style/images/question.png" height="12" width="12"></span></br></br>


            <label>Termék súly: </label><input type="text" name="termek_suly"
                                               style="width: 40px"><label> Kg</label><span
                title="Vagy egész számot vagy .-al elválasztott törtet írj be. pl: 0.01"> - Hibás mező <img
                    src="style/images/question.png" height="12" width="12"></span></br></br>

            <label>Termék ár: </label><input type="text" name="termek_ar"
                                             style="width: 40px"><label> Ft</label><span title="Írd be a termék árát!"> - Hibás mező <img
                    src="style/images/question.png" height="12" width="12"></span></br></br>
            <label>Termék leírás:</label></br></br><textarea rows="4" cols="43" id="termek_leiras"></textarea>
            <input type="button" name="mentes" class="mentes" value="Mentés">

        </fieldset>
    </form>
</div>

<script>
    function mentes() {

        kategoria_ellenoriz($("#termek_kateg"));
        uresmezo_ellenoriz($("input[name='termek_nev']"));
        szam_ellenoriz($("input[name='termek_ar']"));
        suly_ellenoriz($("input[name='termek_suly']"));

        if (
            kategoria_ellenoriz($("#termek_kateg")) &&
            uresmezo_ellenoriz($("input[name='termek_nev']")) &&
            szam_ellenoriz($("input[name='termek_ar']")) &&
            suly_ellenoriz($("input[name='termek_suly']"))
        ) {
            var termek_nev = $("input[name='termek_nev']").val();
            var termek_ar = $("input[name='termek_ar']").val();
            var termek_suly = $("input[name='termek_suly']").val();
            var termek_kateg = $("#termek_kateg").val();
            var termek_leiras = $("#termek_leiras").val();

//            console.log(termek_ar,termek_kateg,termek_nev,termek_suly);
            $.ajax({
                type: "POST",
                url: "includes/termek_mentes.php",
                data: {
                    termek_ar: termek_ar,
                    termek_nev: termek_nev,
                    termek_kateg: termek_kateg,
                    termek_suly: termek_suly,
                    termek_leiras: termek_leiras

                },
                success: function (valasz) {

                    alert(valasz);
                    $("input[name='termek_nev']").val("");
                    $("input[name='termek_ar']").val("");
                    $("input[name='termek_suly']").val("");
                    $("#termek_kateg").val(0);
                    $("#termek_leiras").val("");
                }
            });
        }

    }


    $(document).ready(function () {

        $("span").hide();


        $("input[type='button']").click(mentes);
    });
</script>