<?php
include_once '../config.php';
session_start();
// fetch contact messages with user id details
$sql = "SELECT c.id, c.subject, c.message, c.created_at, 
               u.full_name, u.email
        FROM contacts c
        JOIN users u ON c.user_id = u.id
        ORDER BY c.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact </title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="/Blog-/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>
<section class='contact-container'>
    <section class="p-6">
  <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Contact Messages</h1>

  <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow overflow-x-auto">
    <table id="contactsTable" class="display w-full">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['full_name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['subject']) ?></td>
              <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
              <td><?= date("M d, Y H:i", strtotime($row['created_at'])) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>
</section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
<script>
$(document).ready(function() {
  $('#contactsTable').DataTable({
    pageLength: 10,
    order: [[0, "desc"]],
    responsive: true
  });
});
</script>
</body>
</html>