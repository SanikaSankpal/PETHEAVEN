<?php
//session_start(); // Start session for user login

// Include DB connection
include("index.php"); // This should define $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['username']); // Can be email or username if you support both
    $password = $_POST['password'];

    // Prepare statement to fetch user by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password hash
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            echo "✅ Login successful! Welcome, " . htmlspecialchars($user['full_name']);
            // Optionally redirect:
            // header("Location: dashboard.php");
            exit;
        } else {
            echo "❌ Incorrect password.";
        }
    } else {
        echo "⚠️ No account found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>
