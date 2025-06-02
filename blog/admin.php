<?php
session_start();
$db = new PDO('sqlite:blog.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errors = [];
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple hardcoded admin credentials (for demo purposes)
    $adminUser = 'admin';
    $adminPass = 'password123'; // In real app, use hashed passwords

    if ($username === $adminUser && $password === $adminPass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $errors[] = 'Invalid username or password';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

if (!isset($_SESSION['admin_logged_in'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login - Simple Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black font-roboto min-h-screen flex flex-col justify-center items-center">
    <div class="w-full max-w-sm p-6 border border-gray-300 rounded shadow">
        <h1 class="text-2xl font-bold mb-4 text-center">Admin Login</h1>
        <?php if ($errors): ?>
            <div class="mb-4 text-red-600"><?= implode('<br>', $errors) ?></div>
        <?php endif; ?>
        <form method="post">
            <label class="block mb-2">Username</label>
            <input type="text" name="username" class="w-full p-2 border border-gray-400 rounded mb-4" required />
            <label class="block mb-2">Password</label>
            <input type="password" name="password" class="w-full p-2 border border-gray-400 rounded mb-4" required />
            <button type="submit" name="login" class="w-full bg-black text-white p-2 rounded hover:bg-gray-800">Login</button>
        </form>
    </div>
</body>
</html>
<?php
    exit;
}

// Admin dashboard (simple placeholder)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - Simple Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black font-roboto min-h-screen flex flex-col">
    <nav class="bg-black text-white p-4 flex justify-between items-center">
        <a href="index.php" class="text-xl font-bold">Simple Blog</a>
        <div>
            <a href="index.php" class="mr-4 hover:underline">Home</a>
            <a href="admin.php?logout=1" class="hover:underline">Logout</a>
        </div>
    </nav>

    <main class="flex-grow container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
        <p>Here you can add, edit, and organize posts and pages.</p>

        <section class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Add New Post</h2>
            <form method="post" enctype="multipart/form-data">
                <label class="block mb-2">Title</label>
                <input type="text" name="title" class="w-full p-2 border border-gray-400 rounded mb-4" required />

                <label class="block mb-2">Excerpt</label>
                <textarea name="excerpt" class="w-full p-2 border border-gray-400 rounded mb-4" rows="3"></textarea>

                <label class="block mb-2">Content</label>
                <textarea name="content" class="w-full p-2 border border-gray-400 rounded mb-4" rows="6" required></textarea>

                <label class="block mb-2">Upload Image</label>
                <input type="file" name="image" class="mb-4" />

                <button type="submit" name="add_post" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Add Post</button>
            </form>
        </section>
    </main>

    <footer class="bg-black text-white p-4 text-center">
        &amp;copy; <?= date('Y') ?> Simple Blog. All rights reserved.
    </footer>
</body>
</html>

<?php
if (isset($_POST['add_post'])) {
    $title = $_POST['title'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $content = $_POST['content'] ?? '';

    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $imagePath = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        // Store relative path for database
        $imagePath = 'uploads/' . basename($_FILES['image']['name']);
    }

    $stmt = $db->prepare("INSERT INTO posts (title, excerpt, content) VALUES (?, ?, ?)");
    $stmt->execute([$title, $excerpt, $content]);

    header('Location: admin.php');
    exit;
}
?>
