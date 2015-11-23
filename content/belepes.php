<?php

if ($_SESSION['belepes_probalkozas'] >= 3) {
    ?>

    <script>
        function Hiba_tulsokbelepes() {
            alert("Túl sokszor próbálkoztál! \n Kérlek próbálkozz később!");
        }
        Hiba_tulsokbelepes();
        document.location.href = "http://www.google.hu";
    </script>

    <?php

}

if ($_SESSION['sikeres_belepes'] == false) {

    echo "<form method='post' >";
    echo "<p>Felhasználói név</p>";
    echo "<input type='text' name='nev' class='mezo'>";
    echo "<p>Jelszó</p>";
    echo "<input type='text' name='jelszo' class='mezo'><br>";
    echo '<div style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;" class="g-recaptcha" data-sitekey="6LeGjRETAAAAAEAES58FbdWpbmreZUFic8x5QieV"></div>';

    echo "<input type='submit' name='submit' value='Belépés' id='gomb_belepes'>";
    echo "</form>";

    switch ($_SESSION['belepes_probalkozas']) {
        case 0:
            echo "<p>Még 3 lehetőséged van!</p>";
            break;
        case 1:
            echo "<p>Még 2 lehetőséged van!</p>";
            echo "<p>Rossz felhasnáló név vagy jelszó!</p>";
            break;
        case 2:
            echo "<p>Még 1 lehetőséged van!</p>";
            echo "<p>Rossz felhasnáló név vagy jelszó!</p>";
            break;
        default:
    }
} elseif ($_SESSION['sikeres_belepes'] == true) {
    echo "<p>" . $_SESSION['belepett_felhasznalo'] . "</br> névvel</p>";
    echo "<p>Be vagy jelentkezve</p>";
    echo "<p>mint</p>";
    switch ($_SESSION['jog']) {
        case 1:
            echo "<p>vásárló</p>";
            break;
        case 2:
            echo "<p>diszpécser</p>";
            break;
        case 3:
            echo "<p>administrator</p>";
            break;
    }
    echo "<form action='' method='post'>";
    echo "<input type='submit' name='kilepes' value='Kilépés' id='gomb_kilepes'>";
    echo "<a href='#' style='margin-left: 58px; color: #eb6a0b' onclick=\"load_oldal('jelszo_valtoztatas',event)\">Jelszó változtatás</a>";

}
?>