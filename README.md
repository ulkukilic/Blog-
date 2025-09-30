# Blog Management System

The Blog Management System is a modern web-based blog platform built with PHP, MySQL, and Tailwind CSS. It provides comprehensive tools for managing blog content, including adding posts, bulk content import, database backups, and user email verification.
This project was created specifically to learn how to import data from Excel files and transfer it into the database. This allows multiple blog posts to be added quickly and securely at once. 
Designed with both administrators and content creators in mind, its user-friendly interface ensures a smooth experience on both desktop and mobile devices.

---

## 🌟 Features

- **Dynamic Blog Management**: View and manage blog posts by topic title, author information, and date.  
- **Bulk Content Transfer with Excel**: Add multiple blog posts at once by uploading `.xlsx` files from the admin panel. Invalid or missing fields are checked.  
- **Database Backup**: Create automatic SQL backups and view/download them from the admin panel.  
- **Email Verification System**: Secure login with token-based email verification for user registrations.  
- **Admin Panel**: A central management interface for blog, user, and backup management.  
- **Responsive Design**: An interface designed with Tailwind CSS that is compatible with mobile and desktop devices.  
- **Security Measures**: Use of prepared statements for all database operations and session-based authentication.  

---

## 🛠️ Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript, Tailwind CSS  
- **Backend**: PHP 7.4+  
- **Database**: MySQL  
- **Libraries**:  
  - **PhpSpreadsheet**: To import blog content from Excel files  
  - **PHPMailer**: For user email verification and notifications  
