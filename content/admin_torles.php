
<?php
include("../includes/connect.inc.php");
?>

<div class="urlap">
    <form>
        <fieldset>
            <legend>Admin törlés</legend>
            </br>
            <label class="mezofelirat">Jog szint:</label>
            <select id="jog_valasztas">
                <option value="0">Válassz!</option>
                <option value="2">Diszpécser</option>
                <option value="3">Admin</option>
            </select></br></br>

            <label class="mezofelirat">Felhasználó név:</label>
            <select id="admin_nev">
                <option value="0">Válassz!</option>
                <?php
                $sql = "SELECT * FROM `felhasznalok` WHERE `jog_szint`='2' OR `jog_szint`='3' order by `nev`";
                $adminok = $conn->query($sql);
                while ($admin = $adminok->fetch_array(MYSQLI_ASSOC)) {
                    echo "<option value=" . $admin["felhasznalo_id"] . ">" . $admin["nev"] . "</option>";
                }


                ?>
            </select></br></br>
            <input type="button" id="torol" class="mentes" value="Törlés">
        </fieldset>
    </form>
</div>


<script>

    function admin_nev_valtozas() {
        var admin_id = $("#admin_nev").val();
//        console.log(admin_id);
        if (admin_id == 0) {
            $("#jog_valasztas").val(0);
        } else {
            $.ajax({
                type: "POST",
                url: "includes/admin_torles_nev_valtozas.php",
                data: {admin_id: admin_id},
                success: function (valasz) {
//                    console.log(valasz);
                    $("#jog_valasztas").val(valasz);
                    admin_jog_valtozas();
                }
            });
        }

    }

    function admin_jog_valtozas() {
        var admin_jog = $("#jog_valasztas").val();
//        console.log(admin_jog);
        if (admin_jog == 0) {
            $("#admin_nev option").show();
            $("#admin_nev").val(0);
        } else {
            $.ajax({
                type: "POST",
                url: "includes/admin_torles_jog_valtozas.php",
                data: {admin_jog: admin_jog},
                datatype: "json",
                success: function (valasz) {
                    var valasztomb = JSON.parse(valasz);
                    $("#admin_nev option").hide();
                    for (var i in valasztomb) {
//                        console.log(valasztomb[i]);
                        $("#admin_nev option[value='" + valasztomb[i] + "']").show();
                    }


                }
            });
        }
    }

    function admin_torol() {
        var admin_id = $("#admin_nev").val();
        var admin_nev= $("#admin_nev option:selected").text();
        var admin_jog= $("#jog_valasztas option:selected").text();

//        console.log(admin_id);
//        console.log(admin_nev);
        if (admin_id == 0) {
            alert("Válassz egy nevet!")
        } else {
        if(confirm("Biztos hogy törölni a karod a " + admin_nev + " nevű, " + admin_jog + " jogú felhasználót?")){
                $.ajax({
                    type: "POST",
                    url: "includes/admin_torol.php",
                    data: {admin_id: admin_id},
                    success: function (valasz) {

                        alert(valasz);
                        $("#jog_valasztas").val(0);
                        admin_jog_valtozas();
                    }
                });
            }
        }

    }

    $(document).ready(function () {
        $("#torol").click(admin_torol);
        $("#jog_valasztas").change(admin_jog_valtozas);
        $("#admin_nev").change(admin_nev_valtozas);
    });
</script>