<?php
session_start();

// Include the navbar
include('navbar.php');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'booksmart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch book details
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $book_id = intval($_GET['id']);
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "<p>Book not found!</p>";
        exit();
    }
} else {
    echo "<p>Invalid book ID!</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/fiction.css"> <!-- Custom CSS for category page -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $book['title']; ?> - BookMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $book['image_url']; ?>" class="img-fluid book-image" alt="<?php echo $book['title']; ?>">
            </div>
            <div class="col-md-8">
                <h1><?php echo $book['title']; ?></h1>
                <p><strong>Author:</strong> <?php echo $book['author']; ?></p>
                <p><strong>Price:</strong> Rs.<?php echo $book['price']; ?></p>
                <p><strong>Category:</strong> <?php echo $book['category']; ?></p>
                <p><strong>Description:</strong></p>
                <p><?php echo $book['description']; ?></p>
                <div class="d-flex gap-3 mt-3">
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                        <input type="hidden" name="action" value="add">
                        <button type="submit" class="btn btn-success btn-lg">Add to Cart</button>
                    </form>
                    <a href="cart.php?action=buy&id=<?php echo $book['id']; ?>" class="btn btn-primary btn-lg">Buy Now</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Include the footer
include('footer.php');

// Close the database connection
$conn->close();
?>
