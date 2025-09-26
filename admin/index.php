<?php
include_once '../config.php';
session_start();

//  toplam blog yazısı, toplam kullanıcı ve bugün eklenen blog yazısı sayısını al
$totalBlogs = $conn->query("SELECT COUNT(*) AS count FROM blogs")->fetch_assoc()['count'];
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$todayBlogs = $conn->query("SELECT COUNT(*) AS count FROM blogs WHERE DATE(created_at) = CURDATE()")->fetch_assoc()['count'];

// fetchig only last 6 blog posts
$sql = 'SELECT blogs.id, blogs.title, blogs.created_at, users.full_name
        FROM blogs
        JOIN users ON blogs.author_id = users.id
        ORDER BY blogs.created_at DESC
        LIMIT 6';
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Blog-/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>
<section class='homePage-container'>
    <section class="px-6 py-10 mt-12">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Welcome back, Admin 👋</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Here is the latest overview of your platform.</p>
    </section>

    <section class="px-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
      <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
      <p class="text-sm text-gray-500 dark:text-gray-400">Total Blogs</p>
      <h3 class="text-2xl font-bold text-gray-900 dark:text-white"><?= $totalBlogs ?></h3>
      </div>
      <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
      <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
      <h3 class="text-2xl font-bold text-gray-900 dark:text-white"><?= $totalUsers ?></h3>
      </div>
      <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
      <p class="text-sm text-gray-500 dark:text-gray-400">Blogs Today</p>
      <h3 class="text-2xl font-bold text-gray-900 dark:text-white"><?= $todayBlogs ?></h3>
      </div>
    </section>

    <section class="px-6 mt-12">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Recent Blogs</h2>
    <div class="mt-4 bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 dark:bg-gray-700">
          <tr>
            <th class="p-4">Title</th>
            <th class="p-4">Author</th>
            <th class="p-4">Date</th>
            <th class="p-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr class="border-t border-gray-200 dark:border-gray-700">
                <td class="p-4"><?= htmlspecialchars($row['title']) ?></td>
                <td class="p-4"><?= htmlspecialchars($row['full_name']) ?></td>
                <td class="p-4"><?= date("M d, Y", strtotime($row['created_at'])) ?></td>
                <td class="p-4">
                  <a href="editBlog.php?id=<?= $row['id'] ?>" class="text-indigo-600 hover:underline">Edit</a> | 
                  <a href="deleteBlog.php?id=<?= $row['id'] ?>" class="text-red-600 hover:underline">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="p-4 text-gray-600 dark:text-gray-400">No blogs found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>

   
</section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>