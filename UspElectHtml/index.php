<?php
// Database connection and login processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', '', 'uspelect');
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $student_no = $_POST['stu_no'];
    $password = $_POST['password'];
    
    // Use prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM voters WHERE stu_no = ?");
    $stmt->bind_param("s", $student_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            // ✅ Password correct
            session_start();
            $_SESSION['stu_no'] = $row['stu_no'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['department'] = $row['department'];
            $_SESSION['program'] = $row['program'];

            header("Location: ./user page/votepage.php");
            exit();

        } else {
            $login_error = true; // wrong password
        }

        } else {
            $login_error = true; // student not found
        }


    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="./styles/loginstyle.css" rel="stylesheet">
</head>
<body>
    <!-- Modal for invalid login -->
    <div id="errorModal" class="modal" <?php if (isset($login_error) && $login_error) echo 'style="display: flex;"'; ?>>
        <div class="modal-content">
            <p>Student Number not found or Invalid password.</p>
            <button id="closeModal">OK</button>
        </div>
    </div>

    <div class="login-card">
        <div class="profile-image">
            <span class="material-icons">person</span>
        </div>
        <div>
            <h2 class="form-title">LOG IN</h2>
        </div>

        <form method="POST" action="">
            <div class="input-group">
                <span class="material-icons">mail</span>
                <input name="stu_no" type="text" placeholder="Student Number" required value="<?php echo isset($_POST['stu_no']) ? htmlspecialchars($_POST['stu_no']) : ''; ?>">
            </div>
            
            <div class="input-group">
                <span class="material-icons">lock</span>
                <input name="password" type="password" placeholder="Password" id="password" required>
                <button type="button" class="password-toggle" id="togglePassword">
                    <span class="material-icons">visibility</span>
                </button>
            </div>
            
            <button type="submit" class="login-button">LOG IN</button>
        </form>
        
        <a href="#" class="forgot-password">Forgot Password?</a>
        
        <div class="register-link">
            Don't Have an Account? <a href="./user page/signuppage.php">Register</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle the eye icon
                this.querySelector('.material-icons').textContent = 
                    type === 'password' ? 'visibility' : 'visibility_off';
            });

            // close modal when OK button is clicked
            document.getElementById("closeModal").addEventListener("click", () => {
                document.getElementById("errorModal").style.display = "none";
            });
        });
    </script>
</body>
</html>