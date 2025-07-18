<?php
// Initialize SQLite database and create tables
try {
    $db = new PDO('sqlite:blog.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create posts table
    $db->exec("CREATE TABLE IF NOT EXISTS posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        excerpt TEXT,
        content TEXT NOT NULL,
        image TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// Insert default admin user if not exists
$adminUser = 'admin';
$adminPass = password_hash('password123', PASSWORD_DEFAULT);
$stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
$stmt->execute([$adminUser]);
if ($stmt->fetchColumn() == 0) {
    $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)")->execute([$adminUser, $adminPass]);
}

// Create pages table
$db->exec("CREATE TABLE IF NOT EXISTS pages (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

// Create comments table
$db->exec("CREATE TABLE IF NOT EXISTS comments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    post_id INTEGER NOT NULL,
    author TEXT NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(post_id) REFERENCES posts(id)
)");

    // Create users table (for admin)
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL -- store hashed passwords
    )");

    // Create likes table
    $db->exec("CREATE TABLE IF NOT EXISTS likes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        post_id INTEGER NOT NULL,
        user_ip TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        UNIQUE(post_id, user_ip),
        FOREIGN KEY(post_id) REFERENCES posts(id)
    )");

    echo "Database initialized successfully.";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
