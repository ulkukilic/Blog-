<?php
include_once 'config.php';
session_start();

$token = $_GET['token'] ?? '';

if (empty($token)) {
    die(" Invalid request. No token provided.");
}

$sql = "SELECT id, full_name, email_verified FROM users WHERE verify_token = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if ($user['email_verified'] == 1) {
        $message = " Your email is already verified. You can log in.";
    } else {
        $update = $conn->prepare("UPDATE users SET email_verified = 1, verify_token = NULL WHERE id = ?");
        $update->bind_param("i", $user['id']);
        if ($update->execute()) {
            $message = " Email verified successfully! You can now log in.";
        } else {
            $message = "Something went wrong, please try again later.";
        }
        $update->close();
    }
} else {
    $message = "Invalid or expired verification link.";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Email Verification</title>
  <link rel="icon" type="image/x-icon" href="/Blog-/img/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center h-screen">
  <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md max-w-md w-full text-center">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Email Verification</h1>
    <p class="text-gray-700 dark:text-gray-300 mb-6">
      <?= htmlspecialchars($message) ?>
    </p>
    <a href="login.php" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">Go to Login</a>
  </div>
</body>
</html>
