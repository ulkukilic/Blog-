<?php
include_once 'config.php';
session_start();

// only fetch 3 lates blog post 
$sql = 'SELECT blogs.id, blogs.title, blogs.content, blogs.topic, blogs.created_at,
               users.full_name, users.id AS author_id
        FROM blogs
        JOIN users ON blogs.author_id = users.id
        ORDER BY blogs.created_at DESC
        LIMIT 3';
$result = $conn->query($sql);

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
function base64url_decode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include __DIR__ . '../layouts/header.php'; ?>
 <!-- Hero Section -->
  <section class="relative isolate overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
      <h1 class="text-5xl font-bold tracking-tight text-white sm:text-6xl">
        Welcome to Our Platform
      </h1>
      <p class="mt-6 text-lg leading-8 text-gray-100 max-w-2xl mx-auto">
        Share your ideas, read inspiring blogs, and connect with a creative community.
      </p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <a href="customer/blog.php" class="rounded-md bg-white px-6 py-3 text-lg font-semibold text-indigo-600 shadow hover:bg-gray-100">
          Explore Blogs
        </a>
        <a href="customer/aboutUs.php" class="text-lg font-semibold text-white hover:text-gray-200">
          Learn More →
        </a>
      </div>
    </div>
  </section>
<!-- Features Section -->
  <section class="bg-white dark:bg-gray-900 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
      <h2 class="text-4xl font-bold text-gray-900 dark:text-white">Why Choose Us?</h2>
      <p class="mt-4 text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
        We make it easy to publish, share, and grow with modern tools.
      </p>

      <div class="mt-16 grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Feature 1 -->
        <div class="p-6 rounded-2xl shadow-lg bg-gray-50 dark:bg-gray-800">
          <div class="text-indigo-600 dark:text-indigo-400 text-4xl mb-4">🚀</div>
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Fast & Reliable</h3>
          <p class="mt-3 text-gray-600 dark:text-gray-400">Optimized for performance with modern tech.</p>
        </div>

        <!-- Feature 2 -->
        <div class="p-6 rounded-2xl shadow-lg bg-gray-50 dark:bg-gray-800">
          <div class="text-indigo-600 dark:text-indigo-400 text-4xl mb-4">🎨</div>
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Easy Customization</h3>
          <p class="mt-3 text-gray-600 dark:text-gray-400">Personalize your blog and experience effortlessly.</p>
        </div>

        <!-- Feature 3 -->
        <div class="p-6 rounded-2xl shadow-lg bg-gray-50 dark:bg-gray-800">
          <div class="text-indigo-600 dark:text-indigo-400 text-4xl mb-4">🌍</div>
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Global Community</h3>
          <p class="mt-3 text-gray-600 dark:text-gray-400">Join thousands of users sharing their ideas daily.</p>
        </div>
      </div>
    </div>
  </section>

<!-- Blog Section -->
 
<section class="bg-gray-50 dark:bg-gray-800 py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="text-center">
      <h2 class="text-4xl font-bold text-gray-900 dark:text-white">From the Blog</h2>
      <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
        Latest stories and insights from our authors.
      </p>
    </div>

    <div class="mt-12 grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <article class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow hover:shadow-lg transition flex flex-col justify-between">
            <div>
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                <?php $token = base64url_encode($row['id']); ?>
                <a href="customer/blogDetail.php?token=<?= $token; ?>">
                  <?= htmlspecialchars($row['title']); ?>
                </a>
              </h3>
              <p class="mt-3 text-gray-600 dark:text-gray-400 line-clamp-3">
                <?= htmlspecialchars(substr($row['content'], 0, 150)) . '...'; ?>
              </p>
            </div>

            <div class="mt-6 flex items-center gap-x-4">
              <img src="https://ui-avatars.com/api/?name=<?= urlencode($row['full_name']); ?>&background=random" 
                   alt="<?= htmlspecialchars($row['full_name']); ?>" 
                   class="size-10 rounded-full bg-gray-50 dark:bg-gray-800" />
              <div class="text-sm">
                <p class="font-semibold text-gray-900 dark:text-white">
                  <a href="author.php?id=<?= $row['author_id']; ?>">
                    <?= htmlspecialchars($row['full_name']); ?>
                  </a>
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-xs">
                  <?= date("M d, Y", strtotime($row['created_at'])); ?>
                </p>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-gray-600 dark:text-gray-400">No blog posts found.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Ready to get started -->
  <section class="relative isolate overflow-hidden bg-indigo-600 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
      <h2 class="text-4xl font-bold tracking-tight text-white sm:text-5xl">
        Ready to get started?
      </h2>
      <p class="mt-6 text-lg leading-8 text-indigo-100">
        Join today and take your blogging experience to the next level.
      </p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <a href="customer/contact.php" class="rounded-md bg-white px-6 py-3 text-lg font-semibold text-indigo-600 shadow hover:bg-gray-100">
          Contact Us
        </a>
        <a href="customer/blog.php" class="text-lg font-semibold text-white hover:text-gray-200">
          Explore Blogs →
        </a>
      </div>
    </div>
  </section>

<?php include __DIR__ . '/layouts/footer.php'; ?>
</body>
</html>