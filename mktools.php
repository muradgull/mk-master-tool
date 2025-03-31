<?php
$toolsDir = 'tools/'; // جہاں ڈاؤنلوڈ شدہ ٹولز اسٹور ہوں گے
$githubRepo = 'https://raw.githubusercontent.com/muradgull/mk-master-tool/main/mktools.php'; // GitHub فائل لنک

// پیکیج اپڈیٹ کا فنکشن
if (isset($_GET['update'])) {
    file_put_contents(__FILE__, file_get_contents($githubRepo));
    header("Location: mktools.php");
    exit;
}

// ٹول ڈاؤنلوڈ کا فنکشن
if (isset($_GET['load'])) {
    $toolName = basename($_GET['load']);
    $toolUrl = "https://raw.githubusercontent.com/muradgull/mk-master-tool/main/{$toolName}";
    file_put_contents($toolsDir . $toolName, file_get_contents($toolUrl));
    header("Location: mktools.php");
    exit;
}

// ٹول ڈیلیٹ کا فنکشن
if (isset($_GET['delete'])) {
    $toolName = basename($_GET['delete']);
    unlink($toolsDir . $toolName);
    header("Location: mktools.php");
    exit;
}

// تمام ٹولز کی لسٹ لوڈ کریں
$tools = array_diff(scandir($toolsDir), array('..', '.'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Master Tools</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { width: 50%; margin: auto; }
        button { margin: 5px; padding: 10px; }
        .tool { border: 1px solid #ddd; padding: 10px; margin: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>MK Master Tools</h1>
        <button onclick="location.href='?update=true'">Update Package</button>
        
        <h2>Available Tools</h2>
        <?php foreach ($tools as $tool): ?>
            <div class="tool">
                <strong><?= $tool ?></strong><br>
                <button onclick="location.href='?load=<?= $tool ?>'">Load Tool</button>
                <button onclick="location.href='?delete=<?= $tool ?>'">Delete</button>
                <button onclick="window.open('<?= $toolsDir . $tool ?>', '_blank')">Open</button>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

