<?php
include_once '../config.php';
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

session_start();

$message = "";

// Form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
    $fileTmpPath = $_FILES['excel_file']['tmp_name'];

    try {
        // Excel dosyasını oku
        $spreadsheet = IOFactory::load($fileTmpPath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $isFirstRow = true;
        $inserted = 0;

        foreach ($rows as $row) {
            if ($isFirstRow) {
                $isFirstRow = false; // başlık satırını atla
                continue;
            }

            $title = trim($row[0] ?? '');
            $content = trim($row[1] ?? '');
            $topic = trim($row[2] ?? null);
            $author_id = trim($row[3] ?? '');

            if (!empty($author_id)) {
                $author_id = filter_var($author_id, FILTER_VALIDATE_INT);
            }


           
            if (!empty($title) && !empty($content) && $author_id !== false) {
                $stmt = $conn->prepare("
                    INSERT INTO blogs (title, content, topic, author_id, image_url, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, NOW(), NOW())
                ");

                $image_url = null; // default veya NULL
                $stmt->bind_param("sssis", $title, $content, $topic, $author_id, $image_url);

                if ($stmt->execute()) {
                    $inserted++;
                } else {
                    $errors[] = "Row {$index}: DB Error - " . $stmt->error;
                }
            } else {
                $errors[] = "Row {$index}: Missing or invalid required fields";
            }

        }

        $message = " $inserted  Blog successfully imported! ";
    } catch (Exception $e) {
        $message = " Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Import</title>
    <link rel="icon" type="image/x-icon" href="/Blog-/img/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<section class="max-w-3xl mx-auto py-12 px-6 mt-12">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Import Blogs from Excel</h1>

    <?php if (!empty($message)): ?>
        <div class="p-4 mb-4 rounded 
                    <?= str_starts_with($message, '✅') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Upload Excel File (.xlsx)
        </label>
        <input type="file" name="excel_file" required
               class="mb-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-500">
            Import
        </button>
    </form>
</section>
<section class="max-w-4xl mx-auto my-12 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
  <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">📊 Example Excel Format</h2>
  <p class="mb-4 text-gray-600 dark:text-gray-400">
    Your Excel file should look like this before importing:
  </p>

  <div class="overflow-x-auto">
    <table class="min-w-full border border-gray-300 dark:border-gray-700 text-sm text-left">
      <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
          <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Title</th>
          <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Content</th>
          <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Topic</th>
          <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Author_id</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Welcome Post</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">This is the very first blog post.</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">General</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">1</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">PHP & MySQL Guide</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Learn how to connect PHP with MySQL easily</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Programming</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">2</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Travel to Japan</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">My amazing trip to Tokyo and Kyoto</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Travel</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">1</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Healthy Lifestyle</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Tips for a balanced and healthy lifestyle</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Lifestyle</td>
          <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">3</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>


<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
