<?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/fiction.css"> <!-- Custom CSS for category page -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiction Books - BookMart</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Category Header Section -->
    <div class="container mt-5">
        <h2 class="category-title">Fiction Books</h2>

        <!-- Book Grid Section -->
        <div class="row">
            <?php
                // Database connection (Modify with your actual database credentials)
                $conn = new mysqli('localhost', 'root', '', 'booksmart'); // Update with actual details
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch books in Fiction category
                $sql = "SELECT * FROM books WHERE category = 'Fiction'";
                $result = $conn->query($sql);

                // Loop through each book and display it
                if ($result->num_rows > 0) {
                    while ($book = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-3">
                            <div class="card book-card">
                                <img src="<?php echo $book['image_url']; ?>" class="card-img-top" alt="<?php echo $book['title']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $book['title']; ?></h5>
                                    <p class="card-text"><?php echo $book['author']; ?></p>
                                    <p class="book-price">Rs.<?php echo $book['price']; ?></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="view_details.php?id=<?php echo $book['id']; ?>" class="btn btn-info btn-sm">View Details</a>
                                        <button class="btn btn-success btn-sm">Add to Cart</button>
                                    </div>
                                    <button class="btn btn-primary btn-sm mt-2">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No books available in this category.</p>";
                }

                // Close database connection
                $conn->close();
            ?>
        </div>
    </div>

    <!-- Include Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include('footer.php'); ?>
