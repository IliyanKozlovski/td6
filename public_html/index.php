<?php

include '../private_folder/includes/render_functions.php';

$page = '';
//prowerki
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'authors':
            $page = 'authors';
            break;
        case 'add_book':
            $page = 'add_book';
            break;
        default:
            $page = 'index';
            break;
    }
} else {
    $page = 'index';
}


include '../private_folder/' . $page . '.php';