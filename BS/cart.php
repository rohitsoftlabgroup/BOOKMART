<?php
session_start();

// Database connection (Modify with your actual database credentials)
$conn = new mysqli('localhost', 'root', '', 'booksmart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle actions (add, remove, buy)
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $book_id = $_POST['id'];

    if ($action == 'add') {
        // Check if the cart is initialized
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add the book to the cart (if not already in the cart)
        if (!in_array($book_id, $_SESSION['cart'])) {
            $_SESSION['cart'][] = $book_id;
            echo "Book added to cart successfully!";
        } else {
            echo "This book is already in your cart!";
        }
    }

    if ($action == 'remove') {
        // Remove book from the cart
        if (($key = array_search($book_id, $_SESSION['cart'])) !== false) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['message'] = "Book removed from cart successfully!";
        }
    }

    if ($action == 'buy') {
        // Add the book to the orders session for 'Buy Now'
        if (!isset($_SESSION['orders'])) {
            $_SESSION['orders'] = [];
        }

        if (!in_array($book_id, $_SESSION['orders'])) {
            $_SESSION['orders'][] = $book_id;
        }

        // Redirect to the order page after adding the book to the orders
        header("Location: order.php");
        exit();
    }
}

// Handle "Proceed to Order" logic for moving items from cart to orders
if (isset($_POST['action']) && $_POST['action'] == 'proceed_to_order') {
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        // Add all cart items to orders session
        if (!isset($_SESSION['orders'])) {
            $_SESSION['orders'] = [];
        }

        foreach ($_SESSION['cart'] as $book_id) {
            if (!in_array($book_id, $_SESSION['orders'])) {
                $_SESSION['orders'][] = $book_id;
            }
        }

        // Clear the cart after transferring the items
        unset($_SESSION['cart']);

        // Redirect to the order page
        header("Location: order.php");
        exit();
    }
}

// Fetch cart items
$cart_books = [];
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $book_ids = implode(',', $_SESSION['cart']);
    $sql = "SELECT * FROM books WHERE id IN ($book_ids)";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $cart_books[] = $row;
    }
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
    <title>Shopping Cart - BookMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Include Navbar -->
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h2>Your Cart</h2>

        <!-- Display Cart Books -->
        <?php if (count($cart_books) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_price = 0;
                        foreach ($cart_books as $book):
                            $total_price += $book['price'];
                        ?>
                            <tr>
                                <td><?php echo $book['title']; ?></td>
                                <td><?php echo $book['author']; ?></td>
                                <td>Rs. <?php echo $book['price']; ?></td>
                                <td>
                                    <!-- Remove Button -->
                                    <form method="POST" action="cart.php" style="display:inline;">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Total Price -->
                <div class="d-flex justify-content-end">
                    <h4>Total: Rs. <?php echo $total_price; ?></h4>
                </div>

                <!-- Checkout Button -->
                <div class="d-flex justify-content-between mt-3">
                    <!-- Proceed to Order Button -->
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="action" value="proceed_to_order">
                        <button type="submit" class="btn btn-success btn-lg">Proceed to Order</button>
                    </form>
                    <a href="fiction.php" class="btn btn-secondary btn-lg">Continue Shopping</a>
                </div>
            </div>
        <?php else: ?>
            <p>Your cart is empty! <a href="fiction.php">Browse books</a> and add some.</p>
        <?php endif; ?>
    </div>

    <!-- Include Footer -->
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
