<?php

session_start();

require 'helpers.php';

#Get form search data

$searchTerm = $_GET['searchTerm'];

# Load book data

$booksJson = file_get_contents('books.json');

$books = json_decode($booksJson, true);

#Filter book data

foreach ($books as $title => $book) {
    if ($title != $searchTerm) {
        unset($books[$title]);
    }
}

#store data in session
$_SESSION['results'] = [
    'searchTerm' => $searchTerm,
    'books' => $books,
    'bookCount' => count($books),
];

#Redirect back to form
header('Location: index.php');

