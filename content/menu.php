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
                        <li><a href='#' onclick="load_oldal('vasarlo_felvitel',event)">Sub Product</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class='fomenu'><a href='#' onclick="load_oldal('kezdolap',event)">Rólunk</a></li>
        <li class='fomenu'><a href='#' onclick="load_oldal('kapcsolat',event)">Kapcsolat</a></li>

        <?php
        if(jog_ellenorzes(DISZPECSER) || jog_ellenorzes(ADMIN) || jog_ellenorzes(VASARLO)){

        ?>
            <li class='fomenu'><a href='#' onclick="load_oldal('rendeles',event)">Rendelés</a></li>
        <?php } ?>
        <?php
        if(jog_ellenorzes(DISZPECSER) || jog_ellenorzes(ADMIN) ){

            ?>
            <li class='fomenu'><a href='#'>Termelés</a>
            <ul>
                <li><a href='#' onclick="load_oldal('szallitolevelek',event)">Szállítólevelek</a></li>
                <li><a href='#' onclick="load_oldal('napi_gyartas',event)">Napi gyártás</a></li>



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
                        <li><a href='#' onclick="load_oldal('felhasznalo_felvitel',event)">Felhasználó felvétel</a></li>
                        <li><a href='#' onclick="load_oldal('felhasznalo_torles',event)">Felhasználó törlés</a></li>
                        <li><a href='#' onclick="load_oldal('felhasznalo_jelszokuldes',event)">Jelszó újraküldés</a></li>
                    </ul>
                </li>



                <li class='has-sub'><a href='#'>Vásárlók</a>
                    <ul>
                        <li><a href='#' onclick="load_oldal('vasarlo_felvitel',event)">Vásárló felvétele</a></li>
                        <li><a href='#' onclick="load_oldal('vasarlo_modositas',event)">Vásárló modositas</a></li>
                        <li><a href='#' onclick="load_oldal('vasarlo_torles',event)">Vásárló törlés</a></li>
                    </ul>
                </li>

                <li class='has-sub'><a href='#'>Admin-ok</a>
                    <ul>
                        <li><a href='#' onclick="load_oldal('admin_felvitel',event)">Admin felvétele</a></li>
                        <li><a href='#' onclick="load_oldal('admin_torles',event)">Admin törlés</a></li>

                    </ul>
                </li>

                <li class='has-sub'><a href='#'>Termékek</a>
                    <ul>
                        <li><a href='#' onclick="load_oldal('termek_felvitel',event)">Termék felvétele</a></li>
                        <li><a href='#' onclick="load_oldal('termek_modositas',event)">Termék modositas</a></li>
                        <li><a href='#' onclick="load_oldal('termek_torles',event)">Termék törlés</a></li>
                    </ul>
                </li>
                <li><a href='#' onclick="load_oldal('hirek_szerkesztese',event)">Hirek szerkesztése</a></li>


            </ul>
        </li>
        <?php }?>
    </ul>
</div>