<?php
include '../private_folder/includes/functions.php';
$data = array();
$errors = array();

if ($_POST) {
    $author_name = trim($_POST['author_name']);
    if (mb_strlen($author_name) < 2) {
        $errors[] = 'Невалидно име';
    } else {
        $author_esc = mysqli_real_escape_string($db, $author_name);
        $q = mysqli_query($db, 'SELECT * FROM authors WHERE author_name="' . $author_esc . '"');
        if (mysqli_error($db)) {
            $errors[] = 'Грешка';
        }
        if (mysqli_num_rows($q) > 0) {
            $errors[] = 'Има такъв автор';
        } else {
            mysqli_query($db, 'INSERT INTO authors (author_name)
                               VALUES("' . $author_esc . '")');
            if (mysqli_error($db)) {
                $errors[] = 'Грешка';
            } else {
                $errors[] = 'Успешен запис';
            }
        }
    }
}

$authors = getAuthors($db);
if ($authors === false) {
    $errors[] = 'Грешка';
}

$data['title'] = 'Автори';
$data['authors'] = $authors;
$data['errors'] = $errors;

$data['css'] = '/../../templates/layouts/CSS/style.css';
$data['content'] = '/../../templates/authors_public.php';