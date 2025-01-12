<?php
session_start();
require_once('config/db_config.php');

// Check if admin is logged in
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     header("Location: /login.php");
//     exit();
// }

// Handle slide upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['slide_image'])) {
    $targetDir = "uploads/slides/";
    $fileName = basename($_FILES["slide_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["slide_image"]["tmp_name"], $targetFilePath)) {
        $altText = $_POST['alt_text'] ?? 'Slide';
        $stmt = $pdo->prepare("INSERT INTO slides (image_url, alt_text) VALUES (?, ?)");
        $stmt->execute([$targetFilePath, $altText]);

        $success = "Slide uploaded successfully.";
    } else {
        $error = "Failed to upload the slide.";
    }
}

// Handle slide deletion
if (isset($_GET['delete_id'])) {
    $slideId = (int)$_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM slides WHERE id = ?");
    $stmt->execute([$slideId]);

    $success = "Slide deleted successfully.";
}

// Fetch all slides
$stmt = $pdo->query("SELECT * FROM slides");
$slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo json_encode($slides);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Manage Slides</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Manage Slides</h1>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="admin_slides.php" method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label for="slide_image" class="form-label">Slide Image</label>
                <input type="file" name="slide_image" id="slide_image" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="alt_text" class="form-label">Alt Text</label>
                <input type="text" name="alt_text" id="alt_text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Upload Slide</button>
        </form>

        <h2>Uploaded Slides</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Alt Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slides as $slide): ?>
                    <tr>
                        <td><?= $slide['id'] ?></td>
                        <td><img src="<?= $slide['image_url'] ?>" alt="<?= $slide['alt_text'] ?>" style="width: 100px; height: auto;"></td>
                        <td><?= $slide['alt_text'] ?></td>
                        <td>
                            <a href="admin_slides.php?delete_id=<?= $slide['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
