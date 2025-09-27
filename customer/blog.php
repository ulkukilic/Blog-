<?php
include_once '../config.php';
session_start();
// collecting blogs posts with autor details from database
$sql = 'SELECT blogs.id ,blogs.title,blogs.content,blogs.topic,blogs.created_at,
        users.full_name,users.id AS author_id
        FROM blogs
        JOIN users ON blogs.author_id = users.id
        ORDER BY blogs.created_at DESC';
$result = $conn->query($sql);      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog </title>
    <link rel="icon" type="image/x-icon" href="/Blog-/img/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Blog-/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/header.php'; ?>
<section class="blog-container">
  <div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
          From the blog
        </h2>
        <p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-300">
          Learn how to grow your business with our expert advice.
        </p>
      </div>

      <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 
                  border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 
                  lg:mx-0 lg:max-w-none lg:grid-cols-3 dark:border-gray-700">

        <?php if ($result->num_rows > 0): ?>   <!-- checking blogs post available  -->
          <?php while ($row = $result->fetch_assoc()): ?>  <!-- if available fetching one by one -->
            <article class="flex max-w-xl flex-col items-start justify-between">
              <div class="flex items-center gap-x-4 text-xs">
                <time datetime="<?= $row['created_at']; ?>" class="text-gray-500 dark:text-gray-400">
                  <?= date("M d, Y", strtotime($row['created_at'])); ?>
                </time>
                <span class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium 
                             text-gray-600 hover:bg-gray-100 dark:bg-gray-800/60 
                             dark:text-gray-300 dark:hover:bg-gray-800">
                  <?= htmlspecialchars($row['topic']); ?>
                </span>
              </div>

              <div class="group relative grow">
                <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 
                           group-hover:text-gray-600 dark:text-white dark:group-hover:text-gray-300">
                   <?php $token = base64_encode($row['id']); ?> <!--  add  token to the url for security --> 
                    <a href="blogDetail.php?token=<?= $token; ?>">
                        <?= htmlspecialchars($row['title']); ?>
                    </a>
                </h3>
                <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600 dark:text-gray-400">
                  <?= htmlspecialchars(substr($row['content'], 0, 150)) . '...'; ?>
                </p>
              </div>

              <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($row['full_name']); ?>&background=random" 
                     alt="<?= htmlspecialchars($row['full_name']); ?>" 
                     class="size-10 rounded-full bg-gray-50 dark:bg-gray-800" />
                <div class="text-sm/6">
                  <p class="font-semibold text-gray-900 dark:text-white">
                    <a href="author.php?id=<?= $row['author_id']; ?>">
                      <span class="absolute inset-0"></span>
                      <?= htmlspecialchars($row['full_name']); ?>
                    </a>
                  </p>
                  <p class="text-gray-600 dark:text-gray-400">Author</p>
                </div>
              </div>
            </article>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-gray-600 dark:text-gray-400">No blog posts found.</p>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>