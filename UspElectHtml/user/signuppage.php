<?php
// Connect to database
$host = "localhost"; // usually localhost
$user = "root"; // your XAMPP or WAMP username
$pass = ""; // your MySQL password (usually empty in XAMPP)
$db = "uspelect"; // your database name

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $stu_no = $_POST['stunum'];
    $department = $_POST['department'];
    $program = $_POST['program'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Hash password before saving (for security)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $sql = "INSERT INTO voters (stu_no, email, department, program, password) 
                VALUES ('$stu_no', '$email', '$department', '$program', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Account created successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(to bottom, #307730, #baf1ba);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .form-title{
            color: green;
        }

        .signup-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
            padding: 40px 35px;
            text-align: center;
        }

        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #e9ecef;
            margin: 0 auto 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #6c757d;
        }

        .profile-image .material-icons {
            font-size: 36px;
        }

        .input-group {
            position: relative;
            margin-bottom: 30px;
        }

        .input-group .material-icons {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: green;
            font-size: 20px;
        }

        .input-group input, .input-group select {
            width: 100%;
            border: none;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 0 12px 35px;
            font-size: 16px;
            color: #495057;
            background-color: transparent;
            transition: border-color 0.3s;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .input-group select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 16px;
        }

        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-bottom-color: #6c757d;
        }

        .password-toggle {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
        }

        .signup-button {
            width: 100%;
            background-color: green;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 14px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .signup-button:hover {
            background-color: rgb(60, 173, 60);
        }

        .login-link {
            margin-top: 30px;
            color: green;
            font-size: 14px;
        }

        .login-link a {
            color: green;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: rgb(0, 58, 0);
        }

        @media (max-width: 480px) {
            .signup-card {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="signup-card">
        <div class="profile-image">
            <span class="material-icons">person</span>
        </div>
        <div>
            <h2 class="form-title">SIGN UP</h2>
        </div>
        
        <form method="POST" action="" >
            <div class="input-group">
                <span class="material-icons">mail</span>
                <input name="email" type="email" placeholder="Email" required>
            </div>
            
            <div class="input-group">
                <span class="material-icons">person</span>
                <input name="stunum" type="text" placeholder="Student Number" required>
            </div>
            
            <div class="input-group">
                <span class="material-icons">apartment</span>
                <select name="department" required>
                    <option value="" disabled selected>Select Department</option>
                    <option value="cs">Computer Science</option>
                    <option value="engineering">Engineering</option>
                    <option value="business">Business Administration</option>
                    <option value="arts">Arts & Humanities</option>
                </select>
            </div>
            
            <div class="input-group">
                <span class="material-icons">school</span>
                <select name="program" required>
                    <option value="" disabled selected>Select Program</option>
                    <option value="BSA">Bachelor of Science in Accountancy</option>
                    <option value="BSAIS">Bachelor of Science in Accounting Information System</option>
                    <option value="BSMA">Bachelor of Science in Management Accounting</option>
                    <option value="BSECON">Bachelor of Science in Economics</option>
                    <option value="BSP">Bachelor of Science in Psychology</option>
                    <option value="BSBA">Bachelor of Science in Business Administration</option>
                    <option value="BSE">Bachelor of Science in Entrepreneurship</option>
                    <option value="BSOA">Bachelor of Science in Office Administration</option>
                    <option value="BSIS">Bachelor of Science in Information Systems</option>
                    <option value="BSIT">Bachelor of Science in Information Technology</option>
                    <option value="BSCpE">Bachelor of Science in Computer Engineering</option>
                    <option value="BSHM">Bachelor of Science in Hospitality Management</option>
                    <option value="BSTM">Bachelor of Science in Tourism Management</option>

                </select>
            </div>
            
            <div class="input-group">
                <span class="material-icons">lock</span>
                <input name="password" type="password" placeholder="Password" id="password" required>
                <button type="button" class="password-toggle" id="togglePassword">
                    <span class="material-icons">visibility</span>
                </button>
            </div>
            
            <div class="input-group">
                <span class="material-icons">lock</span>
                <input name="confirm-password" type="password" placeholder="Confirm Password" id="confirm-password" required>
                <button type="button" class="password-toggle" id="toggleConfirmPassword">
                    <span class="material-icons">visibility</span>
                </button>
            </div>
            
            <button type="submit" class="signup-button">SIGN UP</button>

        </form>
        
        <div class="login-link">
            Already Have an Account? <a href="../index.php">Log In</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            
            // Toggle password visibility
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle the eye icon
                this.querySelector('.material-icons').textContent = 
                    type === 'password' ? 'visibility' : 'visibility_off';
            });
            
            // Toggle confirm password visibility
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                
                // Toggle the eye icon
                this.querySelector('.material-icons').textContent = 
                    type === 'password' ? 'visibility' : 'visibility_off';
            });
            
        });
    </script>
</body>
</html>