<?php
include '../private_folder/includes/functions.php';
$data = array();

if (isset($_GET['author_id'])) {
    $author_id = (int) $_GET['author_id'];
    /*
      $q = mysqli_query($db, 'SELECT * FROM authors as a LEFT JOIN
      books_authors as ba ON a.author_id=ba.author_id LEFT JOIN books as b
      ON b.book_id=ba.book_id WHERE a.author_id='.$author_id);
     * 
     */
    $searchfor = 'WHERE authors.author_id = "' . $author_id . '"';
    $q = mysqli_query($db, 'SELECT *, (SELECT COUNT( * ) FROM comments WHERE book_id = books.book_id) AS number_of_comments
        FROM authors
        INNER JOIN books_authors ON authors.author_id = books_authors.author_id
        INNER  JOIN books ON books_authors.book_id=books.book_id
        INNER JOIN books_authors as ba ON ba.book_id=books.book_id
        inner JOIN authors as a ON  ba.author_id=a.author_id '
            . $searchfor
    );
} else {
    $q = mysqli_query($db, 'SELECT * FROM books as b INNER JOIN 
    books_authors as ba ON b.book_id=ba.book_id INNER JOIN authors as a
     ON a.author_id=ba.author_id');
}

while ($row = mysqli_fetch_assoc($q)) {
    $data['books'][$row['book_id']]['book_title'] = $row['book_title'];
    $data['books'][$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
}

$data['title'] = 'Списък';
$data['content'] = '/../../templates/index_public.php';