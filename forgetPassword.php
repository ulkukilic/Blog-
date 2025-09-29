<?php
include_once 'config.php';
require __DIR__ . '/vendor/autoload.php'; 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = " Invalid email format.";
    } else {
        $stmt = $conn->prepare("SELECT id, full_name FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            $token = bin2hex(random_bytes(16));
            $expires = date("Y-m-d H:i:s", time() + 3600); // 1 hour

            $update = $conn->prepare("UPDATE users SET reset_token=?, reset_expires=? WHERE id=?");
            $update->bind_param("ssi", $token, $expires, $user['id']);
            $update->execute();

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = "xxxxxxxx";
                $mail->SMTPAuth = true;
                $mail->Username = "xxxxxxxx";
                $mail->Password = "xxxxxxxx";
                $mail->SMTPSecure = "tls";
                $mail->Port = 587;

                $mail->setFrom("xxxxxxxx", "Blog");
                $mail->addAddress($email, $user['full_name']);
                $mail->isHTML(true);
                $mail->Subject = "Reset Your Password";
                $resetLink = "http://localhost/Blog-/reset_password.php?token=$token";
                $mail->Body = "Hi {$user['full_name']},<br><br>
                               Click the link to reset your password:<br>
                               <a href='$resetLink'>$resetLink</a><br><br>
                               This link will expire in 1 hour.";

                $mail->send();
                $message = " If this email exists, a reset link has been sent.";
            } catch (Exception $e) {
                $message = " Mail error: " . $mail->ErrorInfo;
            }
        } else {
            $message = "If this email exists, a reset link has been sent.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="icon" type="image/x-icon" href="/Blog-/img/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center h-screen">
  <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md max-w-md w-full">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Forgot Password</h1>
    <?php if ($message): ?>
      <p class="mb-4 text-gray-700 dark:text-gray-300"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post">
      <input type="email" name="email" placeholder="Enter your email" required
             class="w-full p-2 mb-4 border rounded">
      <button type="submit"
              class="w-full px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
        Send Reset Link
      </button>
    </form>
  </div>
</body>
</html>
