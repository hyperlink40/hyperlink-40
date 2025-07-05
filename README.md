
html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>hyperlink-40 - PHP Blog Platform</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 2em; background: #fafbfc; color: #222; }
    h1, h2 { color: #2c3e50; }
    pre, code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }
    ul { margin-bottom: 1.5em; }
    .section { margin-bottom: 2em; }
  </style>
</head>
<body>
  <h1>hyperlink-40</h1>
  <p>A simple PHP blog platform using SQLite.</p>
  <div class="section">
    <h2>Features</h2>
    <ul>
      <li>Admin login/logout</li>
      <li>Create, edit, and delete blog posts (with image upload)</li>
      <li>Static pages support</li>
      <li>Like system for posts</li>
      <li>(Optional) Comments system</li>
    </ul>
  </div>
  <div class="section">
    <h2>Getting Started</h2>
    <ol>
      <li>
        <strong>Clone the repository:</strong>
        <pre><code>git clone [your-repo-url]
cd hyperlink-40/blog</code></pre>
        <pre><code># replace [your-repo-url] with the actual repository URL</code></pre>
      </li>
      <li>
        <strong>Initialize the database:</strong>
        <pre><code>php init_db.php</code></pre>
      </li>
      <li>
        <strong>Run with PHP’s built-in server:</strong>
        <pre><code>php -S localhost:8000</code></pre>
        <p>Then open <a href="http://localhost:8000/admin.php">http://localhost:8000/admin.php</a> in your browser.</p>
      </li>
      <li>
        <strong>Default Admin Login:</strong>
        <ul>
          <li>Username: <code>admin</code></li>
          <li>Password: <code>password123</code></li>
        </ul>
      </li>
    </ol>
  </div>
  <div class="section">
    <h2>Folder Structure</h2>
    <ul>
      <li><code>blog/</code> - Main PHP application</li>
      <li><code>uploads/</code> - Uploaded images</li>
    </ul>
  </div>
  <div class="section">
    <h2>Security Notes</h2>
    <ul>
      <li>Change the default admin password after first login.</li>
      <li>File uploads are not fully validated—add checks in production.</li>
    </ul>
  </div>
  <div class="section">
    <h2>License</h2>
    <p>MIT</p>
  </div>
</body>
</html>
