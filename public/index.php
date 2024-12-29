<?php include_once('../inc/topNav.php')?>

<style>
        .hero-section {
            background-color: #1a1a3c;
            color: white;
            padding: 50px 0;
        }

        .hero-section img {
            max-width: 100%;
            height: auto;
        }

        .btn-custom {
            background-color: #3366cc;
            color: white;
        }

        .btn-custom:hover {
            background-color: #254a99;
            color: white;
        }

        .stats-section {
            padding: 50px 0;
        }

        .stats-item {
            text-align: center;
        }

        .stats-item h1 {
            font-size: 3rem;
            color: #1a1a3c;
        }

        .stats-item p {
            font-size: 1.2rem;
            color: #666;
        }
    </style>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-5 fw-bold">SUMAJKT</h1>
                    <p>Shirika la Uzalishaji Mali la Jeshi la Kujenga Taifa lilianzishwa kwa mujibu wa sheria ya
                        mashirika ya umma ya mwaka 1974 (iliyorekebishwa mwaka 2002) baada ya amri ya Rais ya mwaka
                        1982. Shirika lilianzishwa ili kusaidia miradi ambayo ina uwezo mkubwa wa uzalishaji ili iweze
                        kuzalisha zaidi na kwa faida na hivyo kusaidia serikali katika kupunguza matumizi ya kuendesha
                        shughuli za Jeshi la Kujenga Taifa.</p>
                    <a href="#" class="btn btn-custom btn-lg">Show More</a>
                </div>
                
                <!-- Right Column -->
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-4">
                            <img src="../uploads/sumajkt_prod1.webp" alt="Map">
                        </div>
                        <div class="col-4">
                            <img src="../uploads/sumajkt_prod1.webp" alt="Business">
                        </div>
                        <div class="col-4">
                            <img src="../uploads/sumajkt_prod1.webp" alt="Wildlife">
                        </div>
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
                    <img src="https://via.placeholder.com/500x400" alt="Global Network" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold">SUMAJKT </h2>
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
</body>

</html>