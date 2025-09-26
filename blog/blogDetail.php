<?php
include_once '../config.php';
session_start();
$token= $_GET['token'] ?? null; // get the token
if (!$token){
    echo "Invalid request.";
    exit;
}
$blogId=  base64url_decode($token); // decode the token id for blog id  // NOTE : base64_encode veriyi şifreli gibi görünen bir string’e çevirir ama URL için güvenli değildir.

$sql='SELECT blogs.id, blogs.title, blogs.content, blogs.topic, blogs.created_at,
        users.full_name, users.id AS author_id
        FROM blogs
        JOIN users ON blogs.author_id = users.id
        WHERE blogs.id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $blogId);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows === 0) {
    echo("Blog not found.");
}
$blog = $result->fetch_assoc();

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
    <title>Blog Detil</title>
    <link rel="stylesheet" href="/Blog-/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>    
<section class= 'blogDetail-container'>
<section class="max-w-4xl mx-auto py-12 px-6 mt-9 mb-12">
    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
    <?= htmlspecialchars($blog['title']); ?>
    </h1>

     <!-- Meta Information -->
     <div class="flex items-center gap-7 text-sm text-gray-500 dark:text-gray-400 mb-8 mt-9">
        <time datetime="<?= $blog['created_at']; ?>">
        <?= date("F d, Y", strtotime($blog['created_at'])); ?>
        </time>
        <span class="bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
        <?= htmlspecialchars($blog['topic']); ?>
        </span>
     </div>


    <!-- Content -->
     <div class="prose dark:prose-invert max-w-none">
        <p><?= nl2br(htmlspecialchars($blog['content'])); ?></p>
     </div>
     
     <!-- Author -->
     <div class="mt-8 flex items-center gap-3">
        <img src="https://ui-avatars.com/api/?name=<?= urlencode($blog['full_name']); ?>&background=random" 
            alt="<?= htmlspecialchars($blog['full_name']); ?>" 
            class="w-10 h-10 rounded-full"/>
        <div>
        <p class="text-gray-900 dark:text-white font-medium"><?= htmlspecialchars($blog['full_name']); ?></p>
        <p class="text-gray-500 dark:text-gray-400 text-sm">Author</p>
        </div>
     </div>
</section>
</section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>