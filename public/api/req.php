<?php

    /*
    * Test methods in Postman
    */

    # Include Databse Connection
    include_once '../../app/api-bootstrap.php';

    # Check Method Request : * optional
    if ($_SERVER['REQUEST_METHOD'] !== 'GET' && $_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'DELETE') {

        # HTTP Header
        http_response_code(400);
        # Message Respond
        $message = ['Invalid Request'];
        $r = print_r(json_encode($message));

        exit();
    }

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
            print_r(json_encode($q, JSON_PRETTY_PRINT));

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
            print_r(json_encode($q, JSON_PRETTY_PRINT));

            exit();

        }
    }

    # Check Method Request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        # Check Data
        if (!isset($_POST['category'], $_POST['title'], $_POST['body'], $_POST['author'])) {
            $message = ['Invalid Data'];
            $r = print_r(json_encode($message));
            exit();
        }

        # Filter Data
        $filter_category = trim(filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT));
        $filter_title = trim(filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $filter_body = trim(filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $filter_author = trim(filter_var($_POST['author'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        # Check Data Filter
        if (!$filter_category || !$filter_title || !$filter_body || !$filter_author) {
            $message = ['Invalid Filter'];
            $r = print_r(json_encode($message));
            exit();
        }

        # POST Filter Values 
        $a_vals = [];
        foreach ($_POST as $f_POST_k => $f_POST_v) {
            $a_vals[$f_POST_k] = $f_POST_v;
        }

        # Query Data
        $q = $db->query('INSERT into posts (category_id, title, body, author) VALUES(:category_id, :title, :body, :author)');
        $q = $db->bind(':category_id', $filter_category);
        $q = $db->bind(':title', $filter_title);
        $q = $db->bind(':body', $filter_body);
        $q = $db->bind(':author', $filter_author);
        $q = $db->execute();

        # HTTP Header
        if ($q) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }

        # Print Data
        print_r(json_encode($a_vals, JSON_PRETTY_PRINT));

        exit();
    }

    # Check Method Request
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

        # Check Data
        if (!isset($_GET['id'])) {
            $message = ['Invalid Data'];
            $r = print_r(json_encode($message));
            exit();
        }

        # Filter Data
        $filter_title = trim(filter_var($_GET['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $filter_body = trim(filter_var($_GET['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $filter_author = trim(filter_var($_GET['author'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $filter_ID = trim(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

        # Check Data Filter
        if (!$filter_ID) {
            $message = ['Invalid Filter'];
            $r = print_r(json_encode($message));
            exit();
        }

        # POST Filter Values 
        $a_vals = [];
        foreach ($_GET as $f_GET_k => $f_GET_v) {
            $a_vals[$f_GET_k] = $f_GET_v;
        }

        # Query Data
        $q = $db->query('UPDATE posts SET title = :title, body = :body, author = :author WHERE id = :id');
        $q = $db->bind(':title', $filter_title);
        $q = $db->bind(':body', $filter_body);
        $q = $db->bind(':author', $filter_author);
        $q = $db->bind(':id', $filter_ID);
        $q = $db->execute();

        # HTTP Header
        if ($q) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }

        # Print Data
        print_r(json_encode($a_vals, JSON_PRETTY_PRINT));

        exit();
    }

    # Check Method Request
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

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
        print_r(json_encode($q_ID, JSON_PRETTY_PRINT));

        exit();

    }
    