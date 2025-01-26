<?php
session_start();

// Check if the cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get the book ID from the POST request
if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];

    // Add the book to the cart (if not already in the cart)
    if (!in_array($book_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $book_id;
    }
}

// Redirect back to the fiction page with a success message
header("Location: fiction.php?success=1");
exit();
?>
