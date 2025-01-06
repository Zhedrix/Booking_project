<?php
session_start(); // Start session to store login state

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hotelbooking_system";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = ''; // Initialize error message

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to check the user's credentials
    $sql = "SELECT * FROM login WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $email;
            header("Location: homepage.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, #4facfe, #00f2fe);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 50px;
            width: 300px;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #4facfe;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 5px;
        }
        .form-group button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            background-color: #4facfe;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background-color: #3b8dd1;
        }
        .toggle-link {
            margin-top: 10px;
        }
        .toggle-link a {
            color: #4facfe;
            text-decoration: none;
            font-size: 14px;
        }
        .toggle-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #ff6b6b;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Login Form -->
        <div id="login-form">
            <h2>Login</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="username" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
            <?php
            if (isset($error)) {
                echo "<p class='error-message'>$error</p>";
            }
            ?>
            <div class="toggle-link">
                <span>Don't have an account? <a href="#" onclick="toggleForms('register')">Register</a></span>
            </div>
            <div class="toggle-link">
                <span><a href="#" onclick="toggleForms('forgot')">Forgot Password?</a></span>
            </div>
        </div>

        <!-- Registration Form -->
        <div id="register-form" style="display: none;">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="register-username">Username</label>
                    <input type="text" id="register-username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" id="register-email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="register-confirm-password">Confirm Password</label>
                    <input type="password" id="register-confirm-password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Register</button>
                </div>
                <div class="toggle-link">
                    <span><a href="#" onclick="toggleForms('login')">Back to Login</a></span>
                </div>
            </form>
        </div>

        <!-- Forgot Password Form -->
        <div id="forgot-form" style="display: none;">
            <h2>Forgot Password</h2>
            <form action="forgot_password.php" method="POST">
                <div class="form-group">
                    <label for="forgot-email">Enter your email</label>
                    <input type="email" id="forgot-email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <button type="submit">Send Reset Link</button>
                </div>
                <div class="toggle-link">
                    <span><a href="#" onclick="toggleForms('login')">Back to Login</a></span>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleForms(formType) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const forgotForm = document.getElementById('forgot-form');

            loginForm.style.display = 'none';
            registerForm.style.display = 'none';
            forgotForm.style.display = 'none';

            if (formType === 'login') {
                loginForm.style.display = 'block';
            } else if (formType === 'register') {
                registerForm.style.display = 'block';
            } else if (formType === 'forgot') {
                forgotForm.style.display = 'block';
            }
        }
    </script>
</body>
</html>
