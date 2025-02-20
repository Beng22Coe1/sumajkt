<?php
include_once('inc/head.php');
include_once('inc/topNav.php')

?>

<style>
    .btn-custom {
        background-color: #3366cc;
        color: white;
    }

    .btn-custom:hover {
        background-color: #254a99;
        color: white;
    }
</style>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="">
            <div class="row align-items-center">

                <!-- Left Column -->
                <div class="col-md-4 mb-4 mb-lg-0">
                    <h1 class="display-5 fw-bold">SUMAJKT</h1>
                    <p>Shirika la Uzalishaji Mali la Jeshi la Kujenga Taifa lilianzishwa kwa mujibu wa sheria ya
                        mashirika ya umma ya mwaka 1974 (iliyorekebishwa mwaka 2002) baada ya amri ya Rais ya mwaka
                        1982. Shirika lilianzishwa ili kusaidia miradi ambayo ina uwezo mkubwa wa uzalishaji ili iweze
                        kuzalisha zaidi na kwa faida na hivyo kusaidia serikali katika kupunguza matumizi ya kuendesha
                        shughuli za Jeshi la Kujenga Taifa.</p>
                    <a href="#" class="btn btn-custom btn-lg">Show More</a>
                </div>

                <!-- Right Column -->
                <div class="col-md-8">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $stmt = $pdo->query("SELECT * FROM slides");
                            $slides = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($slides as $index => $slide): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= $slide['image_url'] ?>" alt="<?= $slide['alt_text'] ?>" class="d-block w-100">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 stats-item">
                    <h1>30</h1>
                    <p>Subsidiaries</p>
                </div>
                <div class="col-lg-4 stats-item">
                    <h1>15</h1>
                    <p>Divisions</p>
                </div>
                <div class="col-lg-4 stats-item">
                    <h1>9</h1>
                    <p>Countries</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold">SUMAJKT</h2>
                    <p>Shirika la Uzalishaji Mali la Jeshi la Kujenga Taifa lilianzishwa kwa mujibu wa sheria ya
                        mashirika ya umma ya mwaka 1974 (iliyorekebishwa mwaka 2002) baada ya amri ya Rais ya mwaka
                        1982. Shirika lilianzishwa ili kusaidia miradi ambayo ina uwezo mkubwa wa uzalishaji ili iweze
                        kuzalisha zaidi na kwa faida na hivyo kusaidia serikali katika kupunguza matumizi ya kuendesha
                        shughuli za Jeshi la Kujenga Taifa.</p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to handle active class for bullets
        const bullets = document.querySelectorAll('.bullet');
        const carousel = document.querySelector('#carouselExample');

        carousel.addEventListener('slid.bs.carousel', (event) => {
            bullets.forEach((bullet, index) => {
                bullet.classList.toggle('active', index === event.to);
            });
        });
    </script>
</body>

</html>