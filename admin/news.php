<?php
require_once('../config/db_config.php');
require_once('../config/session_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $status = 'active'; // Default status

    // Handle image upload
    $image = $_FILES['image'];
    $uploadDir = '../uploads/news/';
    $imagePath = $uploadDir . basename($image['name']);

    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        // Insert data into the database
        try {
            $query = "INSERT INTO news (date, image_path, title, description, status) VALUES (:date, :image_path, :title, :description, :status)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':date' => $date,
                ':image_path' => $imagePath,
                ':title' => $title,
                ':description' => $description,
                ':status' => $status,
            ]);

            // Redirect or display success message
            header("Location: #?success=1");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Failed to upload image.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    try {
        $query = "UPDATE news SET status = :status WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':status' => $status, ':id' => $id]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['news_id'])) {
    $id = $_POST['news_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $image = $_FILES['image'];

    // Handle optional image upload
    if ($image['size'] > 0) {
        $uploadDir = '../uploads/news/';
        $imagePath = $uploadDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
    }

    // Update the database
    try {
        $query = "UPDATE news SET title = :title, description = :description, date = :date" .
            ($image['size'] > 0 ? ", image_path = :image_path" : "") .
            " WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $params = [
            ':title' => $title,
            ':description' => $description,
            ':date' => $date,
            ':id' => $id,
        ];
        if ($image['size'] > 0) $params[':image_path'] = $imagePath;

        $stmt->execute($params);

        header("Location: #?success=1");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


try {
    // Fetch news data from the database
    $query = "SELECT * FROM news ORDER BY date DESC";
    $stmt = $pdo->query($query);
    $newsItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching news: " . $e->getMessage();
}
?>

<style>
    .image-container {
        padding: 15px;
        margin-bottom: 10px;
    }

    .img-news {
        box-shadow: 1px 4px 9px gray;
    }

    #viewNewsModal .modal-body {
        max-height: 80vh;
        /* Ensure the modal doesn't overflow the screen */
        overflow-y: auto;
        /* Enable scrolling inside the modal */
        word-wrap: break-word;
        /* Break long words */
    }

    #viewDescription {
        white-space: pre-wrap;
        /* Preserve line breaks and spacing */
    }
</style>




<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include_once('../inc/admin_sideNav.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include_once('../inc/admin_topNav.php') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row mb-3 align-items-center">
                        <div class="col">
                            <h3>LATEST NEWS</h3>
                        </div>
                        <div class="col-auto">
                            <div class="btn-group">
                                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addNews">Add</button>
                                <button class="btn btn-outline-secondary">Sort</button>
                            </div>
                        </div>
                    </div>


                    <div class="row g-4">
                        <?php if (!empty($newsItems)): ?>
                            <?php foreach ($newsItems as $news): ?>
                                <div class="col-lg-4">
                                    <div class="card" style="border-radius: 0px; border:1px solid #cccaca;">
                                        <div class="col-12 image-container">
                                            <img src="<?= htmlspecialchars($news['image_path']); ?>" class="img-news"
                                                style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 75/36;"
                                                alt="News Image">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($news['title']); ?></h5>
                                            <p class="card-text text-muted"><?= date('M d, Y', strtotime($news['date'])); ?></p>
                                            <p><?= htmlspecialchars(substr($news['description'], 0, 100)); ?>...</p>
                                            <a href="#" class="btn btn-outline-secondary edit-button"
                                                data-id="<?= $news['id']; ?>"
                                                data-title="<?= htmlspecialchars($news['title']); ?>"
                                                data-description="<?= htmlspecialchars($news['description']); ?>"
                                                data-date="<?= htmlspecialchars($news['date']); ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editNewsModal">Edit</a>

                                            <a href="#" class="btn btn-outline-secondary view-button"
                                                data-title="<?= htmlspecialchars($news['title']); ?>"
                                                data-description="<?= htmlspecialchars($news['description']); ?>"
                                                data-date="<?= htmlspecialchars($news['date']); ?>"
                                                data-image="<?= htmlspecialchars($news['image_path']); ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewNewsModal">View</a>

                                            <a href="#" class="btn btn-outline-secondary hide-news-btn" data-id="<?= $news['id']; ?>" data-status="<?= $news['status']; ?>">
                                                <?= $news['status'] === 'active' ? 'Hide' : 'Show'; ?>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No news available at the moment.</p>
                        <?php endif; ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="addNews" tabindex="-1" aria-labelledby="addNewsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="newsForm" method="post" action="#" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewsLabel">Add News</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="datetime-local" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload News</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editNewsForm" method="post" action="#" enctype="multipart/form-data">
                    <input type="hidden" id="editId" name="news_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNewsLabel">Edit News</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editDate" class="form-label">Date</label>
                            <input type="datetime-local" class="form-control" id="editDate" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editImage" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="viewNewsModal" tabindex="-1" aria-labelledby="viewNewsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewNewsLabel">News Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="viewTitle"></h5>
                    <p id="viewDate" class="text-muted"></p>
                    <img id="viewImage" src="#" alt="News Image" style="width: 100%; object-fit: cover; margin-bottom: 15px;">
                    <p id="viewDescription"></p>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="confirmHideModal" tabindex="-1" aria-labelledby="confirmHideLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmHideLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="hideMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmHideBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('editId').value = button.dataset.id;
                document.getElementById('editTitle').value = button.dataset.title;
                document.getElementById('editDescription').value = button.dataset.description;
                document.getElementById('editDate').value = button.dataset.date;
            });
        });

        document.querySelectorAll('.view-button').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('viewTitle').innerText = button.dataset.title;
                document.getElementById('viewDate').innerText = new Date(button.dataset.date).toLocaleString();
                document.getElementById('viewDescription').innerText = button.dataset.description;
                document.getElementById('viewImage').src = button.dataset.image;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const hideButtons = document.querySelectorAll('.hide-news-btn');
            const confirmHideModal = new bootstrap.Modal(document.getElementById('confirmHideModal'));
            const hideMessage = document.getElementById('hideMessage');
            const confirmHideBtn = document.getElementById('confirmHideBtn');

            let selectedNewsId = null;
            let newStatus = null;

            // Attach click event to all hide buttons
            hideButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    selectedNewsId = this.dataset.id;
                    newStatus = this.dataset.status === 'active' ? 'inactive' : 'active';

                    hideMessage.textContent = newStatus === 'inactive' ?
                        "Are you sure you want to hide this news from the public website?" :
                        "Are you sure you want to publish this news to the public website?";

                    confirmHideModal.show();
                });
            });

            // Confirm button click event
            confirmHideBtn.addEventListener('click', function() {
                // Send request to update status
                fetch('#', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: selectedNewsId,
                            status: newStatus
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Reload the page to reflect changes
                            location.reload();
                        } else {
                            alert('Failed to update news status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                confirmHideModal.hide();
            });
        });
    </script>


</body>

</html>