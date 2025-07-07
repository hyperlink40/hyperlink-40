
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Simple Blog - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black font-roboto min-h-screen flex flex-col">
    <nav class="bg-black text-white p-4 flex justify-between items-center">
        <a href="index.php" class="text-xl font-bold">Simple Blog</a>
        <div>
            <a href="admin.php" class="hover:underline">Admin</a>
        </div>
    </nav>
    <main class="flex-grow container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Latest Posts</h1>
        <?php if (empty($posts)): ?>
            <p>No posts yet. Check back soon!</p>
        <?php else: ?>
            <div class="grid gap-8 md:grid-cols-2">
                <?php foreach ($posts as $post): ?>
                    <div class="border border-gray-300 rounded p-4 shadow bg-white">
                        <h2 class="text-2xl font-bold mb-2">
                            <?= htmlspecialchars($post['title']) ?>
                        </h2>
                        <?php if (!empty($post['image'])): ?>
                            <img src="<?= htmlspecialchars($post['image']) ?>" alt="Post Image" class="max-h-48 mb-2 rounded" />
                        <?php endif; ?>
                        <p class="mb-2 text-gray-700">
                            <?= nl2br(htmlspecialchars($post['excerpt'])) ?>
                        </p>
                        <a href="post.php?id=<?= $post['id'] ?>" class="text-blue-600 hover:underline">Read More</a>
                        <div class="text-xs text-gray-500 mt-2">Posted on <?= htmlspecialchars($post['created_at']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
    <footer class="bg-black text-white p-4 text-center">
        &copy; <?= date('Y') ?> Simple Blog. All rights reserved.
    </footer>
</body>
</html>
