<?php
include("../includes/connect.inc.php");

?>

<div class="urlap">
    <form style="text-align: center">
        <fieldset>
            <legend>Hírek szerkesztése</legend>
            </br>

            <?php
            $sql = "SELECT * FROM `hirek` WHERE 1";
            $eredmeny = $conn->query($sql);
            while ($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
                echo "<label>".$sor["hir_id"]." HÍR</label></br></br><textarea rows='6' cols='43' class='hirek' id='hir_".$sor["hir_id"]."'>".$sor["hir_szoveg"]."</textarea>";
            }

            ?>

            <input type="button" name="mentes" class="mentes" value="Mentés">

        </fieldset>
    </form>
</div>

<script>
    function hir_mentes(){
        console.log("mentes");
        var hir1 = $("#hir_1").val();
        var hir2 = $("#hir_2").val();
        var hir3 = $("#hir_3").val();
        $.ajax({
            type: "POST",
            url: "includes/hir_modosit.php",
            data: {hir1 : hir1,
                hir2 : hir2,
                hir3 : hir3,},

            success: function (valasz) {
                alert(valasz);
                location.reload();

            }
        });
    }


    $(document).ready(function () {
        $("input[type='button']").click(hir_mentes);
    });
</script>
