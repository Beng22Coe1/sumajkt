<?php include_once('../inc/topNav.php') ?>
<style>
    form input.form-control,
    form textarea.form-control,
    form select.form-select {
        border-radius: 0 !important;
        border: 1px solid #ccc;
    }



    h5 {
        font-family: 'Cinzel', Georgia, serif;
        font-weight: bold;
        font-style: normal;
        line-height: 1em;
    }

    form input:focus,
    form textarea:focus,
    form select:focus {
        outline: none;
        box-shadow: none;
        border-color: rgb(164, 163, 175);
    }

    .btn-dark {
        background-color: #333;
        border: none;
        text-transform: uppercase;
    }
</style>

<body>
    <div class="container my-5">
        <div class="row">
            <!-- Contact Information Section -->
            <div class="col-lg-12 mb-4">
                <h5>Contact Information</h5>

                <div class="row text-white p-3 mb-10" style="background-color: gray;">
                    <!-- Phone Section -->
                    <div class="col-md-4 d-flex align-items-center mb-3 mb-md-0">
                        <i class="fas fa-phone fa-lg me-3"></i>
                        <div>
                            <strong>WhatsApp:</strong>
                            <div>+255 73 3768893</div>
                        </div>
                    </div>

                    <!-- Email Section -->
                    <div class="col-md-4 d-flex align-items-center mb-3 mb-md-0">
                        <i class="fas fa-envelope fa-lg me-3"></i>
                        <div>
                            <strong>Email:</strong>
                            <div><a href="mailto:abug@bakhresa.com" class="text-white text-decoration-none">sumajktfurniture@gmail.com</a></div>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="col-md-4 d-flex align-items-center">
                        <i class="fas fa-map-marker-alt fa-lg me-3"></i>
                        <div>
                            <strong>Address:</strong>
                            <div>Masaki, Plot 208, Haile Selassie Rd, Dar es Salaam, Tanzania</div>
                        </div>
                    </div>
                </div>

                <ul class="list-unstyled d-flex gap-3 ">
                    <li class="text-secondary ">
                        <strong>Follow Us</strong>
                    </li>
                    <li>
                        <a href="#" class="text-primary text-decoration-none d-flex align-items-center gap-2">
                            <i class="fab fa-facebook fa-lg"></i>
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-primary text-decoration-none d-flex align-items-center gap-2">
                            <i class="fab fa-twitter fa-lg"></i>
                            <span>Twitter</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-primary text-decoration-none d-flex align-items-center gap-2">
                            <i class="fab fa-linkedin fa-lg"></i>
                            <span>LinkedIn</span>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="col-lg-12 mb-4">
                <h5>Fomu ya kutuma Ujumbe</h5>
            </div>

            <!-- Form Section -->
            <div class="col-lg-12">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="fname" placeholder="First Name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="lname" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" placeholder="Email Address">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="phone" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="company" placeholder="Company">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="country">
                            <option selected disabled>Country</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Uganda">Uganda</option>
                            <!-- Add more countries as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="subject">
                            <option selected disabled>Subject</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Support">Support</option>
                            <option value="Feedback">Feedback</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="message" rows="5" placeholder="Message"></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">SEND MESSAGE</button>
                    </div>
                </form>
            </div>


        </div>
    </div>



    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Bakhresa Group. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>