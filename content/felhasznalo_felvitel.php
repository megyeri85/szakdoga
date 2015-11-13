<?php
echo "felhasznalo felvitel";
include("../includes/connect.inc.php");

?>
<div class="urlap">
    <form>
        <fieldset>
            <legend>Felhasználó létrehozása</legend>
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

            <label class="mezofelirat">Email cím: </label><input type='text' name='emailcim'></br></br>

            <input type="button" name="felvitel" class="mentes" value="Felhasználó generálás és email kiküldése">

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


            }
        });


    }
    function kuldes() {
        var id = $("#vasarlo").val();
        if (id == 0) {
            alert("Válassz ki egy ceget akihez hozzá akarod rendelni a felhasználót!")
        } else {
            $.ajax({
                type: "POST",
                url: "includes/felhasznalo_letrehozas.php",
                data: {id: id},
                success: function (valasz) {
                    alert(valasz);
                    $("#vasarlo").val(0);
                    $("input[type='text']").val(null);

                }
            });
        }

    }

    $(document).ready(function () {
        $("input[name='cim']").prop('disabled', true);
        $("input[name='emailcim']").prop('disabled', true);


        $("input[type='button']").click(kuldes);
        $("#vasarlo").change(valtozas);
    });
</script>