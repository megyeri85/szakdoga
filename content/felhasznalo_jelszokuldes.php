<?php


include("../includes/connect.inc.php");

?>
<div class="urlap">
    <form>
        <fieldset>
            <legend>Felhasználó új jelszavának kiküldése</legend>
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
            <label class="mezofelirat">Felhasznalok: </label>
            <select id="felhasznalo">
                <option value="0">Bármelyik</option>

                <?php
                $sql = "select * from felhasznalok WHERE `jog_szint`='1' order by nev";
                $felhasznalok = $conn->query($sql);
                while ($felhasznalo = $felhasznalok->fetch_array(MYSQLI_ASSOC)) {
                    echo "<option value=" . $felhasznalo["felhasznalo_id"] . ">" . $felhasznalo["nev"] . "</option>";
                }
                ?>


            </select></br></br>


            <input type="button" name="jelszo_kuld" class="mentes" value="Jelszó generálás és küldés">

        </fieldset>
    </form>
</div>
<script>

    function felhasznalo_valtozas() {
        var id = $("#felhasznalo").val();
        if ($("#felhasznalo").val() == 0) {
            $("#vasarlo").val(0);
        } else {

            $.ajax({
                type: "POST",
                url: "includes/felhasznalo_torles_valtozas.php",
                data: {felhasznaloid: id},
                success: function (valasz) {

                    $("#vasarlo").val(valasz);


                }
            });
        }
    }

    function vasarlo_valtozas() {
        var id = $("#vasarlo").val();
//        console.log(id);
        $.ajax({
            type: "POST",
            url: "includes/felhasznalo_torles_valtozas.php",
            data: {vasarloid: id},
            datatype: "json",
            success: function (valasz) {
                var valasztomb = JSON.parse(valasz);
//                console.log(valasztomb);

                if ($("#vasarlo").val() == 0) {
//                    console.log("vasarlo 0");
                    $("#felhasznalo option").show();
                    $("#felhasznalo").val(0);
                } else {
                    $("#felhasznalo option").hide();
                    $("#felhasznalo").val(0);
                    for (var i in valasztomb) {

                        $("#felhasznalo option[value='" + i + "']").show();
//                        $("felhasznalo").val(0);
//                        console.log(i);
//                        console.log(valasztomb[i]);
                    }

                }
            }
        });
    }

    function felhasznalo_jelszokuld() {

        var nev = $("#felhasznalo option:selected").text();

        if ($("#felhasznalo").val() == 0) {
            alert("Válassz egy felhasználótt!");
        } else {
            var id = $("#felhasznalo").val();




                $.ajax({
                    type: "POST",
                    url: "includes/felhasznalo_jelszo_kuld.php",
                    data: {felhasznaloid: id},
                    success: function (valasz) {

                        alert(valasz);
                        $("#vasarlo").val(0);
                        $("#felhasznalo").val(0);

                    }
                });

        }
    }


    $(document).ready(function () {


        $("#vasarlo").change(vasarlo_valtozas);
        $("#felhasznalo").change(felhasznalo_valtozas);
        $("input[name='jelszo_kuld']").click(felhasznalo_jelszokuld);
    });
</script>