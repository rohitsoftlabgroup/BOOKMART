<?php 
// Start the session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="navbar-wrapper">
    <link rel="stylesheet" href="styles/navbar.css">
    <div class="header">
        <h1>Online Book Shop</h1>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">BOOKMART</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Left-aligned menu items -->
               
                <!-- Right-aligned user profile section -->
                <ul class="navbar-nav d-flex mb-2 mb-lg-0 ms-auto"> <!-- ms-auto for right alignment -->
                <li class="nav-item">
                        <a class="nav-link" href="order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                        <!-- If logged in, display user info and logout option -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/usericon.png" alt="User Icon" class="rounded-circle" width="30" height="30"> 
                                <?php echo $_SESSION['user_name']; ?> <!-- Display the user's name -->
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="order.php">My Orders</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <!-- If not logged in, show Login and Register links -->
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
