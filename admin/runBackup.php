<?php
include_once "C:/laragon/www/Blog-/config.php";

if (php_sapi_name() !== 'cli') {
    session_start();
}

$backupDir = __DIR__ . '/../backups/';
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$backupFile = $backupDir . 'backup_' . date('Ymd_His') . '.sql';

$mysqldumpPath = "C:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump.exe";

$command = "\"$mysqldumpPath\" -h $host -u $user --password=$pass $db > \"$backupFile\"";
system($command);

file_put_contents(
    $backupDir . "backup_log.txt",
    "[" . date('Y-m-d H:i:s') . "] Backup created: $backupFile\n",
    FILE_APPEND
);
