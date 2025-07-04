# hyperlink-40# hyperlink-40

A simple PHP blog platform using SQLite.

## Features

- Admin login/logout
- Create, edit, and delete blog posts (with image upload)
- Static pages support
- Like system for posts
- (Optional) Comments system

## Getting Started

1. **Clone the repository:**

   git clone [your-repo-url]
   cd hyperlink-40/blog

   ```sh
   # replace [your-repo-url] with the actual repository URL
   ```

2. **Initialize the database:**

   ```sh
   php init_db.php
   ```

3. **Run with PHP’s built-in server:**

   ```sh
   php -S localhost:8000
   ```

   Then open [http://localhost:8000/admin.php](http://localhost:8000/admin.php) in your browser.

4. **Default Admin Login:**
   - Username: `admin`
   - Password: `password123`

## Folder Structure

- `blog/` - Main PHP application
- `uploads/` - Uploaded images

## Security Notes

- Change the default admin password after first login.
- File uploads are not fully validated—add checks in production.

## License

MIT
