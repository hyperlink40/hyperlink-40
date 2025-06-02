<?php
session_start();
$db = new PDO('sqlite:blog.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];
$stmt = $db->prepare("SELECT id, title, content, created_at FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($post['title']) ?> - Simple Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black font-roboto min-h-screen flex flex-col">
    <nav class="bg-black text-white p-4 flex justify-between items-center">
        <a href="index.php" class="text-xl font-bold">Simple Blog</a>
        <div>
            <a href="index.php" class="mr-4 hover:underline">Home</a>
            <a href="admin.php" class="hover:underline">Admin</a>
        </div>
    </nav>

    <main class="flex-grow container mx-auto p-4 max-w-3xl">
        <article>
            <h1 class="text-4xl font-bold mb-4"><?= htmlspecialchars($post['title']) ?></h1>
            <time class="text-sm text-gray-500 block mb-6"><?= htmlspecialchars($post['created_at']) ?></time>
            <div class="prose max-w-none"><?= nl2br(htmlspecialchars($post['content'])) ?></div>
        </article>
    </main>

    <footer class="bg-black text-white p-4 text-center">
        &amp;copy; <?= date('Y') ?> Simple Blog. All rights reserved.
    </footer>
</body>
</html>
