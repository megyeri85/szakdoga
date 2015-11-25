<?php

include("../includes/connect.inc.php");

?>


<div class="urlap">
    <form>
        <fieldset>
            <legend>Termék törlés</legend>
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
                                             style="width: 40px"><label> Ft</label></br></br>
            <label>Termék leírás:</label></br></br><textarea rows="4" cols="43" id="termek_leiras"></textarea>
            <input type="button" name="torles" class="mentes" value="Törlés">

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
//        console.log(kateg);
        if(kateg==0){
            $("#termekek option").show();
        }else {
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

    function termek_valtozas(){
        var termek_id = $("#termekek").val()

        if (termek_id!=0){
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
        }else{
            $("input[name='termek_suly']").val("");
            $("input[name='termek_ar']").val("");
            $("#termek_leiras").val("");
            $("#termek_kateg").val(0);

        }
    }
    function termek_torles(){
        var id = $("#termekek").val();
        if(id==0){
            alert("Válassz ki egy terméket!");
        }else{
            $.ajax({
                type: "POST",
                url: "includes/termek_torol.php",
                data: {id: id},

                success: function (valasz) {
                   alert(valasz);
                    $("#termekek").val(0);
                    $("#termekek").trigger("change");
                }
            });
        }
    }

    $(document).ready(function () {
        $("#termek_kateg").change(kateg_valtozas);
        $("#termekek").change(termek_valtozas);
        $("input[type='button']").click(termek_torles);

        $("input[name='termek_suly']").prop('disabled', true);
        $("input[name='termek_ar']").prop('disabled', true);
        $("#termek_leiras").prop('disabled', true);
    });
</script>

