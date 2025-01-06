<?php 
require_once('../config/db_config.php');
include_once('../inc/head.php');

$message = ""; // To hold success or error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate inputs
        $fName = trim($_POST['InputFirstName']);//trim removes white spaces
        $sName = trim($_POST['InputSecondName']);
        $lName = trim($_POST['InputLastName']);
        $email = trim($_POST['InputEmail']);
        $phone = trim($_POST['InputPhone']);
        $password = $_POST['InputPassword'];
        $repeatPassword = $_POST['exampleRepeatPassword'];

        // Check if passwords match
        if ($password !== $repeatPassword) {
            throw new Exception("Passwords do not match. Please try again.");
        }

        // Insert into the database
        $stmt = $pdo->prepare("INSERT INTO users(first_name, second_name, last_name, email, phone, password) 
                               VALUES(:fn, :sn, :ln, :email, :phone, :pass)");
        $stmt->execute([
            'fn' => $fName,
            'sn' => $sName,
            'ln' => $lName,
            'email' => $email,
            'phone' => $phone,
            'pass' => password_hash($password, PASSWORD_BCRYPT) // Use hashed password for security
        ]);

        $message = "<div class='alert alert-success'>Registration successful! You can now <a href='login.php'>log in</a>.</div>";
    } catch (Exception $e) {
        $message = "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}
?>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>

                            <!-- Display message -->
                            <?= $message; ?>

                            <form action="#" method="POST" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="FirstName" name="InputFirstName"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="SecondName" name="InputSecondName"
                                            placeholder="Second Name" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="LastName" name="InputLastName"
                                            placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="InputEmail"
                                            placeholder="Email Address" required>
                                    </div>
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="InputPhone" name="InputPhone"
                                            placeholder="Phone" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="InputPassword" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="exampleRepeatPassword" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
