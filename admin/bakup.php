<?php
include_once '../config.php';
session_start();
// Task scheduler ile her 2 gunde bir yedekleme yapilacak
$backupDir = __DIR__ . '/../backups/';
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true); 
}
echo "<p class='bg-blue-100 text-blue-800 p-3 rounded mt-10'>
ℹ️ Backup is automatically created by Task Scheduler.
</p>";

// Mevcut yedek dosyalarini listeleme
$files = glob($backupDir . "*.sql");
if ($files) {
    echo "<h2 class='text-xl font-semibold mt-6 mb-2'> Backups :  </h2>";
    echo "<ul class='list-disc ml-6'>";
    foreach ($files as $file) {
        $name = basename($file);
        echo "<li><a href='../backups/$name' class='text-indigo-600 hover:underline'>$name</a></li>";
    }
    echo "</ul>";
}

// sayfa girisi oldugunda yedekleme yapilmasin diye yorum satiri yapildi
// Veritabanini yedekleme islemi
// $backupDir = __DIR__ . '/../backups/';
// if (!is_dir($backupDir)) {
//     mkdir($backupDir, 0755, true); // if the directory does not exist, create it
// }

// $backupFile = $backupDir . 'backup_' . date('Ymd_His') . '.sql'; // create file name with timestamp

// $command = "mysqldump -h $host -u $user --password=$pass $db > $backupFile";
// system($command);
// // command degiskeninde mysqldump komutu ile veritabanini yedekliyoruz
// echo "<p class='bg-green-100 text-green-800 p-3 rounded'>Backup created successfully: $backupFile</p>";


// Get all tables in the database
$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Blog-/css/style.css">
</head>
<body class="bg-gray-100 text-gray-900">
<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<section class="max-w-6xl mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-8">📊 Database Tables</h1>

    <!-- Tabloları listele -->
    <div class="grid gap-10 grid-cols-1 lg:grid-cols-2">
      <?php foreach ($tables as $table): ?>
        <div class="bg-white rounded-lg shadow p-6 overflow-x-auto max-h-[400px]">
          <h2 class="text-xl font-semibold mb-4"><?= htmlspecialchars($table) ?></h2>

          <table class="w-full border border-gray-200 text-sm text-left table-auto">
            <thead class="bg-gray-50">
              <tr>
                <?php
                
                $columns = $conn->query("SHOW COLUMNS FROM $table");
                while ($col = $columns->fetch_assoc()): ?>
                  <th class="border px-3 py-2 text-left"><?= htmlspecialchars($col['Field']) ?></th>
                <?php endwhile; ?>
              </tr>
            </thead>
            <tbody>
              <?php
              
              $rows = $conn->query("SELECT * FROM $table LIMIT 5");
              while ($r = $rows->fetch_assoc()): ?>
                <tr class="hover:bg-gray-50">
                  <?php foreach ($r as $val): ?>
                    <td class="border px-3 py-2 break-words"><?= htmlspecialchars($val ?? '') ?></td>
                  <?php endforeach; ?>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <p class="text-xs text-gray-500 mt-2">Showing max 5 rows</p>
        </div>
      <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>

<!-- 
📌 NOT: Backup'u otomatik almak için
Linux/MacOS: 
    crontab -e
    0 2 */2 * * php /path/to/your/project/admin/backup.php
    
Windows: 
    Task Scheduler kullan (Win + R -> taskschd.msc -> Create Basic Task)
-->