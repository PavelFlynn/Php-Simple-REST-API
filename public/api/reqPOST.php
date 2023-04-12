<?php

    # Include Databse Connection
    include_once '../../app/api-bootstrap.php';

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
        print '<pre>';
        print_r( json_encode($a_vals, JSON_PRETTY_PRINT) );
        print '</pre>';

        exit();
    }
    