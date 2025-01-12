<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../libs/bootstrap5/css/bootstrap.min.css ">
    <link rel="stylesheet" href="../libs/fontawesome-free/css/all.min.css">

    <script src="../libs/bootstrap5/js/bootstrap.min.js"></script>

    <style>
        .nav-link{
            color: rgba(47, 54, 144, 0.6);
        }

        img{
            height: 70px;
            width: auto;
        }

        .navbar {
        position: sticky;
        top: 0;
        z-index: 1020; /* Ensures it appears above other elements */
        background-color: #f8f9fa; /* Matches your existing bg-light class */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional: Add shadow for better visibility */
    }

    </style>
</head>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light  ">
    <div class="container">
        <img src="../assets/img/logo1.webp" alt="   ">
        <a class="navbar-brand ml-5" href="#">SUMAJKT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../public/index.php">Nyumbani</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../public/index.php#about">Kutuhusu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../public/product.php">Bidhaa na Huduma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../public/news.php">Habari na Matukio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../public/contacts.php">Mawasiliano</a>
                </li>
            </ul>
        </div>
    </div>
</nav>