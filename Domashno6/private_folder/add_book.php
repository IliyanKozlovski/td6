<?php

include '../private_folder/includes/functions.php';
$data = array();
$errors = array();

if ($_POST) {
    $book_name = trim($_POST['book_name']);
    if (!isset($_POST['authors'])) {
        $_POST['authors'] = '';
    }
    $authors = $_POST['authors'];
    $er = [];
    if (mb_strlen($book_name) < 2) {
        $errors[] = 'Невалидно име';
    }
    if (!is_array($authors) || count($authors) == 0) {
        $errors[] = 'Грешка';
    }
    if (!isAuthorIdExists($db, $authors)) {
        $errors[] = 'невалиден автор';
    }

    if (isset($_POST['book_name']) && isBookExists($db, $book_name)) {
        $errors[] = 'има такава книга';
    }

    if (count($errors) < 1) {
        mysqli_query($db, 'INSERT INTO books (book_title) VALUES("' .
                          mysqli_real_escape_string($db, $book_name) . '")');
        if (mysqli_error($db)) {
            $errors[] = 'Error';
            exit;
        }
        $id = mysqli_insert_id($db);
        foreach ($authors as $authorId) {
            mysqli_query($db, 'INSERT INTO books_authors (book_id,author_id)
                               VALUES (' . $id . ',' . $authorId . ')');
            if (mysqli_error($db)) {
                $errors[] = 'Error';
                //echo mysqli_error($db);
                exit;
            }
        }
        $errors[] = 'Книгата е добавена';
    }
}


$authors = getAuthors($db);
if ($authors === false) {
    $errors[] = 'Грешка';
}

$data['title'] = 'Нова книга';
$data['css'] = '/../../templates/layouts/CSS/style.css';
$data['content'] = '/../../templates/add_book_public.php';
$data['header'] = '/../../templates/header_public.php';
$data['authors'] = $authors;
$data['errors'] = $errors;

render($data, '/../templates/layouts/normal_layout.php');