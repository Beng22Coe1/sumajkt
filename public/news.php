<?php
include_once('../inc/topNav.php');
require_once('../config/db_config.php');


try {
    $query = "SELECT * FROM news WHERE status = 'active' ORDER BY date DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

?>

<style>
    body {
        color: black;
    }

    .news-section h3 {
        color: rgb(65, 63, 63);
        font-size: 1.5rem;
        margin-bottom: 40px;
        font-family: 'Georgia';
        font-weight: bold;

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

    .image-container {
        padding: 15px;
        margin-bottom: 10px;
    }

    .img-news {
        box-shadow: 1px 4px 9px gray;
    }

    .card {
        border-radius: 0px;
    }

    .truncate-text {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        /* Number of lines to display */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<body>
    <!-- News Section -->
    <section class="news-section py-5">
        <div class="container">
            <h3>LATEST NEWS</h3>

            <div class="row g-4">
                <?php foreach ($news as $item): ?>
                    <div class="col-lg-6">
                        <div class="card" style="border-radius: 0px; border:1px solid #cccaca;">
                            <div class="col-12 image-container">
                                <img src="<?= htmlspecialchars($item['image_path']); ?>"
                                    class="img-news"
                                    style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 75/36;"
                                    alt="<?= htmlspecialchars($item['title']); ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['title']); ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($item['date']); ?></p>
                                <p class="truncate-text"><?= htmlspecialchars($item['description']); ?></p>
                                <button class="btn btn-outline-primary read-more-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#newsModal"
                                    data-title="<?= htmlspecialchars($item['title']); ?>"
                                    data-date="<?= htmlspecialchars($item['date']); ?>"
                                    data-image="../uploads/<?= htmlspecialchars($item['image_path']); ?>"
                                    data-content="<?= htmlspecialchars($item['description']); ?>">
                                    Read More
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newsModalLabel">News Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="newsModalImage" src="" alt="News Image" class="img-fluid mb-3" style="width: 100%;">
                    <p id="newsModalDate" class="text-muted"></p>
                    <p id="newsModalContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const readMoreButtons = document.querySelectorAll('.read-more-btn');

        readMoreButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Get data attributes
                const title = this.getAttribute('data-title');
                const date = this.getAttribute('data-date');
                const image = this.getAttribute('data-image');
                const content = this.getAttribute('data-content');

                // Populate modal elements
                document.getElementById('newsModalLabel').textContent = title;
                document.getElementById('newsModalDate').textContent = date;
                document.getElementById('newsModalImage').src = image;
                document.getElementById('newsModalContent').textContent = content;
            });
        });
    });
</script>

</body>

</html>