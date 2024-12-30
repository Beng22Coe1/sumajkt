<?php include_once('../inc/topNav.php') ?>

<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Wasiliana Nasi Leo SumaJKT</h2>
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Write your message here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="border border-secondary rounded p-2 mb-4" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <p class="text-secondary">Placeholder for Contact Image</p>
                </div>
                <h5>Contact Information</h5>
                <ul class="list-unstyled">
                    <li><strong>Phone:</strong> +255 222 861 116</li>
                    <li><strong>Email:</strong> <a href="mailto:abug@bakhresa.com">abug@bakhresa.com</a></li>
                    <li><strong>Address:</strong> Masaki, Plot 208, Haile Selassie Rd, Dar es Salaam, Tanzania</li>
                </ul>
                <h5 class="mt-4">Follow Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Bakhresa Group. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
