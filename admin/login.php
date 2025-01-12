<?php 
include_once('../inc/head.php');
require_once('../config/db_config.php');

session_start(); // Start the session to manage login state

$error = ""; // Variable to hold error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['InputUsername']); // Assuming the username field is used for email
    $password = $_POST['InputPassword'];

    try {
        // Prepare and execute the SQL statement
        $stmt = $pdo->prepare("SELECT id, first_name, email, password FROM users WHERE email = :email");
        $stmt->execute(['email' => $username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the provided password with the stored hashed password
            if (password_verify($password, $user['password'])) {
                // Password is correct, set up the session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['first_name'];
                $_SESSION['last_activity'] = time();

                // Redirect to a dashboard or home page
                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid password. Please try again.";
            }
        } else {
            $error = "No account found with that email.";
        }
    } catch (Exception $e) {
        $error = "An error occurred: " . $e->getMessage();
    }
}
?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-9 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <!-- Display error message -->
                                    <?php if ($error): ?>
                                    <div class="alert alert-danger">
                                        <?= htmlspecialchars($error) ?>
                                    </div>
                                    <?php endif; ?>

                                    <form class="user" method="POST" action="#">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                                name="InputUsername" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                                name="InputPassword" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>
