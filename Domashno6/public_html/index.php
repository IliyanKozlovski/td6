<?php

include '../private_folder/includes/render_functions.php';

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

$data['header'] = '/../../templates/header_public.php';

render($data, '/../templates/layouts/normal_layout.php');