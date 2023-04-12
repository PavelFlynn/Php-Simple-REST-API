<?php

    # ============================================================================================
    # Working on local or real Server
    # ============================================================================================
    $hostConnt = substr($_SERVER['HTTP_HOST'], 0, 5);
    if (in_array($hostConnt, array('local', '127.0', '192.1'))) {
        $local = true;
    } else {
        $local = false;
    }

    # ============================================================================================
    # Debug Errors 
    # ============================================================================================
    if ($local) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        function errorHandler($e_number, $e_message, $e_file, $e_line, $e_vars) {
            $e_gralMsg = 'Error ocurred in script: '.$e_file.' on line: '.$e_line.' '.$e_message.'<br>';
            $e_gralMsg .= print_r($e_vars, 1);
        }
        set_error_handler('errorHandler');

        # ...................................
        # URL & DB Connection [Development]
        define('__URLROOT__', 'http://localhost:8888');

        include_once '../app/Database/dev/d-db-pdo.php';
        
    } else {

        error_reporting(0);

    }