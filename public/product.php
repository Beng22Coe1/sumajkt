<?php 
include_once('../inc/topNav.php') ;
require_once('../config/db_config.php');

try {
    // Fetch products data from the database
    $query = "SELECT * FROM products ORDER BY id DESC";
    $stmt = $pdo->query($query);
    $productsItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching products: " . $e->getMessage();
}
?>

<body>


    <div class="container my-5">
            <div class="row g-3">
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
                                        class="btn btn-outline-secondary view-button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewProductModal"
                                        data-id="<?= $product['id']; ?>"
                                        data-name="<?= htmlspecialchars($product['name']); ?>"
                                        data-description="<?= htmlspecialchars($product['description']); ?>"
                                        data-image="<?= htmlspecialchars($product['path']); ?>">
                                        View
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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

<?php include_once('../inc/footer.php')?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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

    </script>
</body>

</html>