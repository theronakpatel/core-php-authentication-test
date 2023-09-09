# Create `user_db` table and `users` table.

```
-- Create the user_db database if it doesn't exist
CREATE DATABASE IF NOT EXISTS user_db;

-- Switch to the user_db database
USE user_db;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP
);

```