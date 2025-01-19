<?php
include_once('../inc/topNav.php');
require('../config/db_config.php');
$stmt = $pdo->query("SELECT * FROM slides");
$slides = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    .hero-section {
        position: relative;
        overflow: visible;
        /* Allow the wave to extend beyond the section */
        z-index: -1;
    }

    .wave-divider {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 150px;
        z-index: -1;
        /* Adjust height if necessary */
        pointer-events: none;
        /* Ensures it does not block interactions */
    }

    .wave-divider svg {
        width: 100%;
        height: 100%;
        display: block;
    }
    .zindex{
        z-index: 1;
    }
</style>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
            <div class="row align-items-center p-3 zindex">

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
                            <!-- Page 1 -->
                            <div class="carousel-item active">
                                <div class="row g-3">
                                    <div class="col-4  " style="aspect-ratio: 75/127;">
                                        <img src="../<?php echo $slides[0]['image_url'] ?>" alt="Energy Product"
                                            style="width: 100%; height: 100%; object-fit: cover;">

                                    </div>
                                    <div class="col-4 " style="aspect-ratio: 75/127;">
                                        <img src="../<?php echo $slides[1]['image_url'] ?>" alt="<?php echo $slides[1]['image_url'] ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div class="col-4 " style="aspect-ratio: 75/127;">
                                        <img src="../<?php echo $slides[2]['image_url'] ?>" alt="<?php echo $slides[2]['image_url'] ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <!-- Page 2 -->
                            <div class="carousel-item">
                                <div class="row g-3">
                                    <!-- Larger Div (Aspect Ratio: 140/118) -->
                                    <div class="col-8 " style="aspect-ratio: 135/111;">
                                        <img src="../<?= $slides[3]['image_url'] ?>" alt="../<?= $slides[2]['image_url'] ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>

                                    <!-- Smaller Divs (Aspect Ratio: 140/78) -->
                                    <div class="col-4">
                                        <div class="row " style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[4]['image_url'] ?>" alt="../<?= $slides[0]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="row mt-1" style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[5]['image_url'] ?>" alt="../<?= $slides[2]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="row mt-1" style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[6]['image_url'] ?>" alt="../<?= $slides[1]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Page 3 -->
                            <div class="carousel-item">
                                <div class="row g-3">
                                    <!-- Larger Div (Aspect Ratio: 140/118) -->
                                    <div class="col-8 " style="aspect-ratio: 135/111;">
                                        <img src="../<?= $slides[7]['image_url'] ?>" alt="../<?= $slides[2]['image_url'] ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>

                                    <!-- Smaller Divs (Aspect Ratio: 140/78) -->
                                    <div class="col-4">
                                        <div class="row " style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[8]['image_url'] ?>" alt="../<?= $slides[8]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="row mt-1" style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[9]['image_url'] ?>" alt="../<?= $slides[9]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="row mt-1" style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[10]['image_url'] ?>" alt="../<?= $slides[10]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Page 4 -->
                            <div class="carousel-item">
                                <div class="row g-3">
                                    <!-- Larger Div (Aspect Ratio: 140/118) -->
                                    <div class="col-8 " style="aspect-ratio: 135/111;">
                                        <img src="../<?= $slides[11]['image_url'] ?>" alt="../<?= $slides[2]['image_url'] ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>

                                    <!-- Smaller Divs (Aspect Ratio: 140/78) -->
                                    <div class="col-4">
                                        <div class="row " style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[12]['image_url'] ?>" alt="../<?= $slides[0]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="row mt-1" style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[13]['image_url'] ?>" alt="../<?= $slides[2]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="row mt-1" style="aspect-ratio: 135/73;">
                                            <img src="../<?= $slides[14]['image_url'] ?>" alt="../<?= $slides[1]['image_url'] ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Bullet Navigation -->
                        <div class="bullet-bar">
                            <span type="button" class="bullet active" data-bs-target="#carouselExample" data-bs-slide-to="0" aria-label="Slide 1"></span>
                            <span type="button" class="bullet" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></span>
                            <span type="button" class="bullet" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></span>
                            <span type="button" class="bullet" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"></span>
                        </div>
                    </div>
                </div>

            </div>

        <!-- Wave SVG -->
        <div class="wave-divider">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 121" preserveAspectRatio="none">
                <path fill="#f8f9fa" d="M0,123L1920,123L1920,6C1596,0,869,-26,0,108L0,123z"></path>
            </svg>
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

    <?php include_once('../inc/footer.php')?>
</body>

</html>