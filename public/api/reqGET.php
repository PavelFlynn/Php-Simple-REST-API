<?php

    # Include Databse Connection
    include_once '../../app/api-bootstrap.php';

    # Check Method Request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        # Complete Data
        if (!isset($_GET['id'])) {
            
            # Query Data
            $q = $db->query('SELECT * FROM posts');
            $q = $db->q();

            # HTTP Header
            if ($q) {
                http_response_code(200);
            } else {
                http_response_code(404);
            }

            # Print Data
            print '<pre>';
            print_r( json_encode($q, JSON_PRETTY_PRINT) );
            print '</pre>';

            exit();

        } else {

            # Filter Data
            $filter_ID = trim(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

            # Check Data Filter
            if (!$filter_ID) {
                $message = ['Invalid Filter'];
                $r = print_r(json_encode($message));
                exit();
            }

            # Query Data
            $q = $db->query('SELECT * FROM posts WHERE id = :id');
            $q = $db->bind(':id', $filter_ID);
            $q = $db->q1();

            # HTTP Header
            if ($q) {
                http_response_code(200);
            } else {
                http_response_code(404);
            }

            # Print Data
            print '<pre>';
            print_r( json_encode($q, JSON_PRETTY_PRINT) );
            print '</pre>';

            exit();

        }
    }
    