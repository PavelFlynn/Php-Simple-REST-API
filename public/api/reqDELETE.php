<?php

    # Include Databse Connection
    include_once '../../app/api-bootstrap.php';

    # Check Method Request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        # Check Data
        if (!isset($_GET['id'])) {
            $message = ['Invalid Data'];
            $r = print_r(json_encode($message));
            exit();
        }

        # Filter Data
        $filter_ID = trim(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

        # Check Data Filter
        if (!$filter_ID) {
            $message = ['Invalid Filter'];
            $r = print_r(json_encode($message));
            exit();
        }

        # Query Data
        $q_ID = $db->query('SELECT * FROM posts WHERE id = :id');
        $q_ID = $db->bind(':id', $filter_ID);
        $q_ID = $db->q1();

        # Query Data
        $q = $db->query('DELETE FROM posts WHERE id = :id');
        $q = $db->bind(':id', $filter_ID);
        $q = $db->execute();

        # HTTP Header
        if ($q) {
            http_response_code(200);
        } else {
            http_response_code(404);
        }

        # Print Data
        print '<pre>';
        print_r( json_encode($q_ID, JSON_PRETTY_PRINT) );
        print '</pre>';

        exit();

    }
    