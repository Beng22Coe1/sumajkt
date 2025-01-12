<?php
require_once('../config/db_config.php');
require_once('../config/session_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imageFile'])) {
    $targetDir = "../uploads/slides/";
    $fileName = basename($_FILES["imageFile"]["name"]);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $targetFile = $targetDir . $fileName;

    // Allowed file types
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Invalid file type. Only JPG, JPEG, PNG, and WEBP files are allowed.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        exit;
    }

    // Check if the file is an image
    $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetFile)) {
            try {
                // Prepare the SQL query for updating the image_url and alt_text in the database
                $stmt = $pdo->prepare("UPDATE slides SET image_url = :image_url, alt_text = :alt_text WHERE id = :id");
                $stmt->bindParam(':image_url', $filePath);
                $stmt->bindParam(':alt_text', $altText);
                $stmt->bindParam(':id', $slideId); // Assuming slideId is passed from the form

                // Set parameters
                $filePath = "uploads/slides/" . $fileName; // Use relative path for database
                $altText = htmlspecialchars($_POST['alt_text'] ?? 'Default Alt Text');
                $slideId = $_POST['slide_id'];

                // Execute the query
                if ($stmt->execute()) {
                    echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            The file <strong>" . htmlspecialchars($fileName) . "</strong> has been uploaded and the database updated.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } else {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            File uploaded, but failed to update the database.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            } catch (PDOException $e) {
                echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Database error: " . $e->getMessage() . "
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Sorry, there was an error uploading your file.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    } else {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                File is not an image.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
}


$stmt = $pdo->query("SELECT * FROM slides");
$slides = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<style>
    .image-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        box-shadow: 1px 1px 9px black;
        border-radius: 5px;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .image-container:hover img {
        transform: scale(1.1);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        cursor: pointer;
    }

    .image-container:hover .image-overlay {
        opacity: 1;
    }

    .image-overlay i {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .image-overlay p {
        font-size: 1rem;
        margin: 0;
    }

    


</style>

<body id="page-top">
    <div id="wrapper">
        <?php include_once('../inc/admin_sideNav.php') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once('../inc/admin_topNav.php') ?>

                <div class="container-fluid">
                    <div class="row">

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="carousel-item active">
                                        <div class="row g-3">
                                            <div class="col-4" style="aspect-ratio: 75/127;">
                                                <div class="image-container">
                                                    <img src="../<?= $slides[0]['image_url'] ?>" alt="../<?= $slides[0]['image_url'] ?>">
                                                    <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[0]['id'] ?>" >
                                                        <i class="fas fa-image"></i>
                                                        <p>Update this slide</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4" style="aspect-ratio: 75/127;">
                                                <div class="image-container">
                                                    <img src="../<?= $slides[1]['image_url'] ?>" alt="../<?= $slides[0]['image_url'] ?>">
                                                    <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[1]['id'] ?>" >
                                                        <i class="fas fa-image"></i>
                                                        <p>Update this slide</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4" style="aspect-ratio: 75/127;">
                                                <div class="image-container">
                                                <img src="../<?= $slides[2]['image_url'] ?>" alt="../<?= $slides[0]['image_url'] ?>">
                                                <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[2]['id'] ?>" >
                                                        <i class="fas fa-image"></i>
                                                        <p>Update this slide</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p>Page 1</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                    <!-- Page 2 -->
                                    <div class="carousel-item active">
                                        <div class="row g-3">
                                            <!-- Larger Div (Aspect Ratio: 140/118) -->
                                            <div class="col-8 " style="aspect-ratio: 135/111;">
                                                <div class="image-container dropdown">
                                                    <img src="../<?= $slides[3]['image_url'] ?>" alt="../<?= $slides[2]['image_url'] ?>"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                    <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[3]['id'] ?>" >
                                                        <i class="fas fa-image"></i>
                                                        <p>Update this slide</p>

                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Smaller Divs (Aspect Ratio: 140/78) -->
                                            <div class="col-4">
                                                <div class="row " style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">
                                                        <img src="../<?= $slides[4]['image_url'] ?>" alt="../<?= $slides[0]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[4]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-1" style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">

                                                        <img src="../<?= $slides[5]['image_url'] ?>" alt="../<?= $slides[5]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[5]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-1" style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">
                                                        <img src="../<?= $slides[6]['image_url'] ?>" alt="../<?= $slides[6]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[6]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p>Page 2</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                    <!-- Page 2 -->
                                    <div class="carousel-item active">
                                        <div class="row g-3">
                                            <!-- Larger Div (Aspect Ratio: 140/118) -->
                                            <div class="col-8 " style="aspect-ratio: 135/111;">
                                                <div class="image-container dropdown">
                                                    <img src="../<?= $slides[7]['image_url'] ?>" alt="../<?= $slides[7]['image_url'] ?>"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                    <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[7]['id'] ?>" >
                                                        <i class="fas fa-image"></i>
                                                        <p>Update this slide</p>

                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Smaller Divs (Aspect Ratio: 140/78) -->
                                            <div class="col-4">
                                                <div class="row " style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">
                                                        <img src="../<?= $slides[8]['image_url'] ?>" alt="../<?= $slides[8]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[7]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-1" style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">

                                                        <img src="../<?= $slides[9]['image_url'] ?>" alt="../<?= $slides[9]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[9]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-1" style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">
                                                        <img src="../<?= $slides[10]['image_url'] ?>" alt="../<?= $slides[10]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[10]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p>Page 3</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                    <!-- Page 2 -->
                                    <div class="carousel-item active">
                                        <div class="row g-3">
                                            <!-- Larger Div (Aspect Ratio: 140/118) -->
                                            <div class="col-8 " style="aspect-ratio: 135/111;">
                                                <div class="image-container dropdown">
                                                    <img src="../<?= $slides[11]['image_url'] ?>" alt="../<?= $slides[11]['image_url'] ?>"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                    <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[11]['id'] ?>" >
                                                        <i class="fas fa-image"></i>
                                                        <p>Update this slide</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Smaller Divs (Aspect Ratio: 140/78) -->
                                            <div class="col-4">
                                                <div class="row " style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">
                                                        <img src="../<?= $slides[12]['image_url'] ?>" alt="../<?= $slides[12]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[12]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-1" style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">

                                                        <img src="../<?= $slides[13]['image_url'] ?>" alt="../<?= $slides[13]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[13]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-1" style="aspect-ratio: 135/73;">
                                                    <div class="image-container dropdown">
                                                        <img src="../<?= $slides[14]['image_url'] ?>" alt="../<?= $slides[14]['image_url'] ?>"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                        <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $slides[14]['id'] ?>" >
                                                            <i class="fas fa-image"></i>
                                                            <p>Update this slide</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p>Page 4</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="slide_id" value=""> <!-- Slide ID, replace with dynamic value -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="imageFile" class="form-label">Choose an image file</label>
                            <input class="form-control" type="file" id="imageFile" name="imageFile" required>
                        </div>
                        <div class="mb-3">
                            <label for="alt_text" class="form-label">Alt Text</label>
                            <input class="form-control" type="text" id="alt_text" name="alt_text" placeholder="Enter alternative text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Get all image overlays
        const imageOverlays = document.querySelectorAll('.image-overlay');

        // Add click event listener to each overlay
        imageOverlays.forEach(overlay => {
            overlay.addEventListener('click', () => {
                // Get the slide ID from the data-id attribute
                const slideId = overlay.getAttribute('data-id');

                // Set the value of the hidden input field in the modal
                const slideIdInput = document.querySelector('#uploadModal input[name="slide_id"]');
                if (slideIdInput) {
                    slideIdInput.value = slideId;
                }
            });
        });
    });
</script>

</body>

</html>