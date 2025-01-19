<?php
require_once('../config/db_config.php');
require_once('../config/session_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $product_name = $_POST['product-name'];
    $status = 'active'; // Default status

    // Handle image upload
    $image = $_FILES['image'];
    $uploadDir = '../uploads/products/';
    $imagePath = $uploadDir . basename($image['name']);

    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        // Insert data into the database
        try {
            $query = "INSERT INTO products (name, path, description, status) VALUES (:name, :image_path, :description, :status)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':name' => $product_name,
                ':image_path' => $imagePath,
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
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $imagePath = null;

    // Handle image upload if a new image is provided
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $uploadDir = '../uploads/products/';
        $imagePath = $uploadDir . basename($image['name']);

        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            die("Failed to upload image.");
        }
    }

    try {
        // Update product details
        $query = "UPDATE products 
                  SET name = :name, 
                      description = :description" .
            ($imagePath ? ", path = :path" : "") .
            " WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $params = [
            ':name' => $productName,
            ':description' => $description,
            ':id' => $productId,
        ];
        if ($imagePath) {
            $params[':path'] = $imagePath;
        }
        $stmt->execute($params);

        // Redirect back with success message
        header("Location: #?success=1");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['id'], $input['status'])) {
        $productId = $input['id'];
        $newStatus = $input['status'];

        try {
            $query = "UPDATE products SET status = :status WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':status' => $newStatus, ':id' => $productId]);

            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input.']);
    }
}



try {
    // Fetch products data from the database
    $query = "SELECT * FROM products ORDER BY id DESC";
    $stmt = $pdo->query($query);
    $productsItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching products: " . $e->getMessage();
}
?>
<style>
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

                    <!-- Page Heading -->
                    <div class="row mb-3 align-items-center">
                        <div class="col">
                            <h3>Products</h3>
                        </div>
                        <div class="col-auto">
                            <div class="btn-group">
                                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addProduct">Add</button>
                                <button class="btn btn-outline-secondary">Sort</button>
                            </div>
                        </div>
                    </div>


                    <!-- Content Row -->

                    <div class="row">

                        <div class="container my-5">
                            <div class="row ">
                                <div class="row">
                                    <?php foreach ($productsItems as $product): ?>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="card">
                                                <div class="card-body rounded p-2" style="display: flex; align-items: center; justify-content: center;">
                                                    <img src="<?= htmlspecialchars($product['path']); ?>" alt="<?= htmlspecialchars($product['name']); ?>"
                                                        class="img-fluid rounded"
                                                        style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 75/65;">
                                                </div>
                                                <div class="card-footer">
                                                    <p class="m-0 p-0 text-bold"><?= htmlspecialchars($product['name']); ?></p>
                                                    <small><?= htmlspecialchars($product['description']); ?></small>
                                                    <div>
                                                        <a href="#"
                                                            class="btn btn-outline-secondary edit-button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editProductModal"
                                                            data-id="<?= $product['id']; ?>"
                                                            data-name="<?= htmlspecialchars($product['name']); ?>"
                                                            data-description="<?= htmlspecialchars($product['description']); ?>"
                                                            data-image="<?= htmlspecialchars($product['path']); ?>">
                                                            Edit
                                                        </a>
                                                        <a href="#"
                                                            class="btn btn-outline-secondary view-button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewProductModal"
                                                            data-id="<?= $product['id']; ?>"
                                                            data-name="<?= htmlspecialchars($product['name']); ?>"
                                                            data-description="<?= htmlspecialchars($product['description']); ?>"
                                                            data-image="<?= htmlspecialchars($product['path']); ?>">
                                                            View
                                                        </a>
                                                        <a href="#"
                                                            class="btn btn-outline-secondary toggle-visibility-btn"
                                                            data-id="<?= $product['id']; ?>"
                                                            data-status="<?= $product['status']; ?>">
                                                            <?= $product['status'] === 'active' ? 'Hide' : 'Show'; ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

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

    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="productForm" method="post" action="#" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product-name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="product-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProductForm" method="post" action="#" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editProductId" name="product_id">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editProductName" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editImage" name="image">
                            <small>Leave blank to keep the current image</small>
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

    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProductLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="viewProductImage" src="" alt="Product Image" class="img-fluid rounded" style="max-height: 300px;">
                    </div>
                    <h5 id="viewProductName" class="text-center"></h5>
                    <p id="viewProductDescription" class="mt-3"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="confirmationMessage">
                <!-- Dynamic confirmation message -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmAction">Yes</button>
            </div>
        </div>
    </div>
</div>


    

    <script>
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', event => {
                const productId = button.getAttribute('data-id');
                const productName = button.getAttribute('data-name');
                const description = button.getAttribute('data-description');
                const image = button.getAttribute('data-image');

                // Populate modal fields
                document.getElementById('editProductId').value = productId;
                document.getElementById('editProductName').value = productName;
                document.getElementById('editDescription').value = description;
            });
        });

        document.querySelectorAll('.view-button').forEach(button => {
            button.addEventListener('click', event => {
                const productName = button.getAttribute('data-name');
                const description = button.getAttribute('data-description');
                const image = button.getAttribute('data-image');

                // Populate modal fields
                document.getElementById('viewProductName').textContent = productName;
                document.getElementById('viewProductDescription').textContent = description;
                document.getElementById('viewProductImage').src = image;
            });
        });

        document.querySelectorAll('.toggle-visibility-btn').forEach(button => {
        button.addEventListener('click', event => {
            event.preventDefault();

            const productId = button.getAttribute('data-id');
            const currentStatus = button.getAttribute('data-status');
            const newStatus = currentStatus === 'active' ? 'hidden' : 'active';

            const message = currentStatus === 'active' ?
                "Are you sure you want to hide this news from the public website?" :
                "Are you sure you want to publish this news to the public website?";

            // Set the message in the modal
            document.getElementById('confirmationMessage').textContent = message;

            // Show the modal
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();

            // Handle confirmation action
            document.getElementById('confirmAction').onclick = () => {
                confirmationModal.hide();

                // Perform the AJAX request
                fetch('#', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: productId, status: newStatus }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            button.setAttribute('data-status', newStatus);
                            button.textContent = newStatus === 'active' ? 'Hide' : 'Show';
                        } else {
                            alert('Failed to update product visibility.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            };
        });
    });
    </script>


</body>

</html>