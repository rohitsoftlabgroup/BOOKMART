<?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/footer.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Styles for Categories Header */
        .categories-header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <!-- Categories Header Section -->
    <div class="categories-header">
        <h2>Categories</h2>
    </div>

    <!-- Categories Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/fiction.jpeg" alt="Fiction">
                    <h3><a href="fiction.php">Fiction</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/nonfiction.jpg" alt="Non-Fiction">
                    <h3><a href="non-fiction.html">Non-Fiction</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/business.jpeg" alt="Business">
                    <h3><a href="business.html">Business</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/love.jpg" alt="Romance">
                    <h3><a href="romance.html">Romance</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/motivation.jpeg" alt="Motivation">
                    <h3><a href="motivation.html">Motivation</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/selfimprovement.jpeg" alt="Self Improvement">
                    <h3><a href="self-improvement.html">Self Improvement</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/discipline.jpg" alt="Discipline">
                    <h3><a href="discipline.html">Discipline</a></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php include('footer.php'); ?>
