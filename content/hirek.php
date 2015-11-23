<?php
include("includes/connect.inc.php");

?>
<h1>Hírek</h1>

<?php

$sql = "SELECT * FROM `hirek` WHERE 1";
$eredmeny = $conn->query($sql);
while ($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
    echo "<div class='hir'><p>".$sor["hir_szoveg"]."</p></div>";
}


?>

