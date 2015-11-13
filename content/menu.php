<div id='cssmenu'>
    <ul>
        <li class='fomenu active'><a href='#' ">Kezdőlap</a></li>
        <li class='fomenu has-sub'><a href='#'>Termékek</a>
            <ul>
                <li class='has-sub'><a href='#'>Product 1</a>
                    <ul>
                        <li><a href='#'>Sub Product</a></li>
                        <li><a href='#'>Sub Product</a></li>
                    </ul>
                </li>
                <li class='has-sub'><a href='#'>Product 2</a>
                    <ul>
                        <li><a href='#'>Sub Product</a></li>
                        <li><a href='#' onclick="load_oldal('vasarlo_felvitel')">Sub Product</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class='fomenu'><a href='#' onclick="load_oldal('kezdolap')">Rólunk</a></li>
        <li class='fomenu'><a href='#' onclick="load_oldal('kapcsolat')">Kapcsolat</a></li>

        <?php
        if(jog_ellenorzes(DISZPECSER) || jog_ellenorzes(ADMIN) || jog_ellenorzes(VASARLO)){

        ?>
            <li class='fomenu'><a href='#' onclick="load_oldal('rendeles')">Rendelés</a></li>

            <li class='fomenu'><a href='#'>Vásárlók</a>
            <ul>
                <li><a href='#' onclick="load_oldal('vasarlo_felvitel')">Vásárló felvételt</a></li>
                <li><a href='#' onclick="load_oldal('vasarlo_modositas')">Vásárló modositas</a></li>
                <li><a href='#' onclick="load_oldal('vasarlo_torles')">Vásárló törlés</a></li>


            </ul>
        </li>
        <?php } ?>

        <?php
        if(jog_ellenorzes(ADMIN) ){

        ?>
        <li class='fomenu'><a href='#'>Admin</a>
            <ul>
                <li class='has-sub'><a href='#'>Felhasználók</a>
                    <ul>
                        <li><a href='#' onclick="load_oldal('felhasznalo_felvitel')">Felhasználó felvétel</a></li>
                        <li><a href='#' onclick="load_oldal('felhasznalo_torles')">Felhasználó törlés</a></li>
                    </ul>
                </li>



                <li class='has-sub'><a href='#'>Vásárlók</a>
                    <ul>
                        <li><a href='#' onclick="load_oldal('vasarlo_felvitel')">Vásárló felvétele</a></li>
                        <li><a href='#' onclick="load_oldal('vasarlo_modositas')">Vásárló modositas</a></li>
                        <li><a href='#' onclick="load_oldal('vasarlo_torles')">Vásárló törlés</a></li>
                    </ul>
                </li>

                <li class='has-sub'><a href='#'>Admin-ok</a>
                    <ul>
                        <li><a href='#' onclick="load_oldal('admin_felvitel')">Admin felvétele</a></li>
                        <li><a href='#' onclick="load_oldal('admin_torles')">Admin törlés</a></li>

                    </ul>
                </li>

                <li class='has-sub'><a href='#'>Termékek</a>
                    <ul>
                        <li><a href='#' onclick="load_oldal('termek_felvitel')">Termék felvétele</a></li>
                        <li><a href='#' onclick="load_oldal('termek_modositas')">Termék modositas</a></li>
                        <li><a href='#' onclick="load_oldal('termek_torles')">Termék törlés</a></li>
                    </ul>
                </li>


            </ul>
        </li>
        <?php }?>
    </ul>
</div>