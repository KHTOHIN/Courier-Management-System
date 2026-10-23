# Courier Management System

A web-based courier management system built with **PHP** and **MySQL**, with a public website for customers and an admin panel for managing branches, shipments and payments. Developed as an academic project.

## Features

**Customer site**
- Book a courier and view services
- Track a parcel
- Branch information and contact page

**Admin panel**
- Secure admin login
- Create and manage branches
- Create and manage shipments
- Record and update payments

**Other**
- Email notifications with PHPMailer
- Server-side form validation with Valitron
- Map integration for branch locations

## Tech Stack

PHP · MySQL · Bootstrap (SB Admin) · Composer · PHPMailer · Valitron

## Getting Started

**Prerequisites:** PHP, MySQL, Composer (e.g. XAMPP)

1. Clone the repository into your web server directory
   ```bash
   git clone https://github.com/KHTOHIN/Courier-Management-System.git
   ```
2. Install dependencies
   ```bash
   composer install
   ```
3. Create a database and import `couriermanagementsystem.sql`
4. Update the database credentials in `app/db.php`
5. Open the site in your browser; the admin panel is under `/admin`

## Author

**Kawsar Hamid** · [Portfolio](https://kawsarhamid.vercel.app) · [LinkedIn](https://www.linkedin.com/in/kawsar-hamid-tohin/)
