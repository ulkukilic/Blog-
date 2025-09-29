<?php
include_once 'config.php';
session_start();

$token = $_GET['token'] ?? '';
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password'] ?? '';
    $token = $_POST['token'] ?? '';

    if (empty($newPassword) || empty($token)) {
        $message = "Invalid request.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token=? AND reset_expires > NOW() LIMIT 1");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expires=NULL WHERE id=?");
            $update->bind_param("si", $hash, $user['id']);
            $update->execute();
            $message = "Password updated successfully! You can now <a href='login.php'>login</a>.";
        } else {
            $message = "Invalid or expired token.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center h-screen">
  <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md max-w-md w-full">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Reset Password</h1>
    <?php if ($message): ?>
      <p class="mb-4 text-gray-700 dark:text-gray-300"><?= $message ?></p>
    <?php endif; ?>
    <?php if (!$message || str_starts_with($message, "Invalid")): ?>
      <form method="post">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <input type="password" name="password" placeholder="Enter new password" required
               class="w-full p-2 mb-4 border rounded">
        <button type="submit"
                class="w-full px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
          Reset Password
        </button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
