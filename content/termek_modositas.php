<?php

include("../includes/connect.inc.php");

?>


<div class="urlap">
    <form>
        <fieldset>
            <legend>Termék módosítás</legend>
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

            </select></br></br>

            <label>Termék név: </label>
            <select id="termekek">
                <option value="0">Válassz!</option>
                <?php
                $sql = "SELECT * FROM `termekek` order by `termek_nev`";
                $termekek = $conn->query($sql);
                while ($termek = $termekek->fetch_array(MYSQLI_ASSOC)) {
                    echo "<option value=" . $termek["termek_id"] . ">" . $termek["termek_nev"] . "</option>";
                }
                ?>


            </select></br></br>


            <label>Termék súly: </label><input type="text" name="termek_suly"
                                               style="width: 40px"><label> Kg</label></br></br>

            <label>Termék ár: </label><input type="text" name="termek_ar"
                                             style="width: 40px"><label> Ft</label><span title="Írd be a termék árát!"> - Hibás mező <img
                    src="style/images/question.png" height="12" width="12"></span></br></br>
            <label>Termék leírás:</label></br></br><textarea rows="4" cols="43" id="termek_leiras"></textarea>
            <input type="button" name="torles" class="mentes" value="Módosítás">

        </fieldset>
    </form>
</div>


<script>

    function kateg_valtozas() {

        var kateg = $("#termek_kateg").val();
        $("#termekek").val(0);
        $("input[name='termek_suly']").val("");
        $("input[name='termek_ar']").val("");
        $("#termek_leiras").val("");
        console.log(kateg);
        if (kateg == 0) {
            $("#termekek option").show();
        } else {
            $.ajax({
                type: "POST",
                url: "includes/termek_torles_kateg_valtozas.php",
                data: {kateg: kateg},
                datatype: "json",
                success: function (valasz) {

                    valasztomb = JSON.parse(valasz);
                    $("#termekek option").hide();
                    for (i = 0; i < valasztomb.length; i++) {
                        $("#termekek option[value='" + valasztomb[i] + "']").show()
                    }
                }
            });
        }

    }

    function termek_valtozas() {
        var termek_id = $("#termekek").val()

        if (termek_id != 0) {
            $("input[name='termek_ar']").prop('disabled', false);
            $("#termek_leiras").prop('disabled', false);
            $.ajax({
                type: "POST",
                url: "includes/termek_torles_termek_valtozas.php",
                data: {termek_id: termek_id},
                datatype: "json",
                success: function (valasz) {
                    valasztomb = JSON.parse(valasz);
                    $("#termek_kateg").val(valasztomb["fk_kateg_id"]);
                    $("input[name='termek_suly']").val(valasztomb["termek_suly"]);
                    $("input[name='termek_ar']").val(valasztomb["termek_ar"]);
                    $("#termek_leiras").val(valasztomb["termek_leiras"]);
                }
            });
        } else {
            $("input[name='termek_suly']").val("");
            $("input[name='termek_ar']").val("");
            $("#termek_leiras").val("");
            $("#termek_kateg").val(0);
            $("input[name='termek_ar']").prop('disabled', true);
            $("#termek_leiras").prop('disabled', true);

        }
    }
    function termek_modositas() {
        var id = $("#termekek").val();
        if (id == 0) {
            alert("Válassz ki egy terméket!");
        } else {
            szam_ellenoriz($("input[name='termek_ar']"));

            if(szam_ellenoriz($("input[name='termek_ar']"))) {


                var ar = $("input[name='termek_ar']").val();
                var leiras = $("#termek_leiras").val();
                console.log(ar + "  " + leiras);
                $.ajax({
                    type: "POST",
                    url: "includes/termek_modosit.php",
                    data: {
                        id: id,
                        ar: ar,
                        leiras: leiras
                    },

                    success: function (valasz) {
                        alert(valasz);

                    }
                });
            }
        }
    }

    $(document).ready(function () {
        $("#termek_kateg").change(kateg_valtozas);
        $("#termekek").change(termek_valtozas);
        $("input[type='button']").click(termek_modositas);

        $("input[name='termek_suly']").prop('disabled', true);
        $("input[name='termek_ar']").prop('disabled', true);
        $("#termek_leiras").prop('disabled', true);


        $("span").hide();
    });
</script>

