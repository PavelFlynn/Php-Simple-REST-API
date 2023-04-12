<?php

    session_start(['cookie_lifetime' => 604800]);

    # Set Time Zone
    ini_set('date.timezone', 'America/Mexico_City');

    # ============================================================================================
    # Libraries
    # ============================================================================================

    include_once '../app/bootstrap.php';

    # ============================================================================================
    # Program
    # ============================================================================================

    # ...................................
    # Decode String
    function strngDecodeUTF($s) {
        return trim(strip_tags(stripslashes(html_entity_decode($s, ENT_QUOTES, 'UTF-8'))));
    }

