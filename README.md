irzeit Flat Rent

A PHP + MySQL web application for renting flats . Customers can search and rent flats, owners can list flats for rent, and a manager approves new listings.

Features
User authentication (customer, owner, manager roles) with hashed passwords
Flat listings with photos, search and filtering (location, price, bedrooms, bathrooms, furnished)
Owners can offer flats for rent and add marketing info (nearby places)
Manager approval workflow for new flat offers
Rental booking flow with visit appointment scheduling
In-app messages between the system and owners/managers
Tech Stack
PHP (PDO + prepared statements)
MySQL
Vanilla HTML/CSS (no framework)
Requirements
PHP 8+ with the PDO MySQL extension
MySQL server
A local server stack such as XAMPP or WAMP
Getting Started
Copy the project folder into your server's web root (e.g. htdocs for XAMPP).
Import dbschema_1220704.sql into your MySQL server (via phpMyAdmin or the CLI) to create the database and tables.
Copy db.credentials.example.php to a new file named db.credentials.php, and fill in your local database settings:
php
   define("DB_HOST", "localhost");
   define("DB_NAME", "your_database_name");
   define("DB_USER", "your_database_user");
   define("DB_PASS", "your_database_password");

db.credentials.php must sit at the project root. It's excluded from version control since it holds sensitive credentials. 4. Start Apache and MySQL, then open HomePage.php in your browser.

