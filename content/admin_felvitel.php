

<div class="urlap">
    <form>
        <fieldset>

            <legend>Admin felvitel</legend>
            </br>
            <label class="mezofelirat">Jog szint:</label>
            <select id="jog_valasztas">
                <option value="0">Válassz!</option>
                <option value="2">Diszpécser</option>
                <option value="3">Admin</option>
            </select></br></br>


            <label class="mezofelirat">Felhasználó név:</label><input type="text" name="felhasznalo_nev"></br></br>
            <label class="mezofelirat">E-mail cím: </label><input type="text" name="email"></br></br>
            <input type="button" id="felvesz" class="mentes" value="Felvesz">
        </fieldset>
    </form>
</div>

<script>
    function admin_felvesz() {

        var jog = $("#jog_valasztas").val();
        var felhasznalo_nev = $("input[name='felhasznalo_nev']").val();
        if (jog == 0) {
            alert("Válaszd ki a jogosultsági szintet!");

        }else{
            if (felhasznalo_nev==""){
                alert("Addja meg a felhasználó nevét!");
            }else{

                if(email_ellenoriz($("input[name='email']"))){
                    var email = $("input[name='email']").val();

                    $.ajax({
                        type: "POST",
                        url: "includes/admin_letrehozas.php",
                        data: {jog: jog, felhasznalo_nev: felhasznalo_nev, email:email},
                        success: function (valasz) {
                            alert(valasz);
                            $("#jog_valasztas").val(0);
                            $("input[name='felhasznalo_nev']").val("");
                        }
                    });


                }else{
                    alert("Az e-mail cím hibás")
                }


            }
        }


    }


    $(document).ready(function () {
        $("#felvesz").click(admin_felvesz);

    });
</script>