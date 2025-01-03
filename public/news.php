<?php include_once('../inc/topNav.php') ?>

    <style>
        body {
            background-color: #1a1a3c;
            color: white;
        }
        .news-section h1 {
            color: #ffffff;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .news-section .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .news-section .btn {
            background-color: #1a1a3c;
            color: white;
        }
        .news-section .btn:hover {
            background-color: #145db7;
        }
    </style>

<body>
    <!-- News Section -->
    <section class="news-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1>Latest News</h1>
                <p>Check out the featured news from the Bakhresa Group.</p>
                <a href="#" class="btn btn-primary">Find Out More</a>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-4">
                    <div class="card bg-light">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="News 1">
                        <div class="card-body">
                            <h5 class="card-title">Azam Wheat Flour Launches C...</h5>
                            <p class="card-text text-muted">Sep 21, 2024</p>
                            <a href="#" class="btn btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4">
                    <div class="card bg-light">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="News 2">
                        <div class="card-body">
                            <h5 class="card-title">Azam Media launches digital terr...</h5>
                            <p class="card-text text-muted">May 20, 2023</p>
                            <a href="#" class="btn btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4">
                    <div class="card bg-light">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="News 3">
                        <div class="card-body">
                            <h5 class="card-title">President Dr. Hussein Mwinyi...</h5>
                            <p class="card-text text-muted">Oct 26, 2022</p>
                            <a href="#" class="btn btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
