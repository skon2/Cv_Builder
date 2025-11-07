🧾 CV Builder App – Symfony Project

A simple web application built with Symfony that allows users to create, save, and generate CVs dynamically.
This project is designed for students, job seekers, and developers who want to easily build and export professional CVs.

🚀 Features

Create and manage CVs (name, email, phone, city, summary, etc.)

Store data in a MySQL database using Doctrine ORM

Generate PDF versions of CVs (coming soon)

Preview CV templates (modern, classic)

Built with clean MVC architecture


🧰 Tech Stack
| Layer               | Technology                |
| ------------------- | ------------------------- |
| **Framework**       | Symfony 6/7               |
| **Template Engine** | Twig                      |
| **Database**        | MySQL + Doctrine ORM      |
| **Frontend**        | Bootstrap / TailwindCSS   |
| **PDF Generation**  | KnpSnappyBundle or DomPDF |
| **Language**        | PHP 8+                    |

⚙️ Installation
1️⃣ Clone the repository
git clone https://github.com/your-username/cv_builder.git
cd cv_builder

2️⃣ Install dependencies
composer install

3️⃣ Configure your .env file

Edit your database URL:

DATABASE_URL="mysql://root:password@127.0.0.1:3306/cv_builder"

4️⃣ Create the database and run migrations
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

5️⃣ Run the local server
symfony serve


Visit: 👉 http://localhost:8000/cv/new

🏗️ Project Structure
src/
 ├── Controller/
 │    └── CvController.php
 ├── Entity/
 │    └── Cv.php
 ├── Form/
 │    └── CvType.php
templates/
 ├── base.html.twig
 └── cv/
      └── new.html.twig

🔮 Upcoming Features

Add user authentication

Multiple CV templates (modern, creative, minimal)

Export to PDF

Dark/light theme support

👨‍💻 Author

Skander Bardaoui
📍 Bizerte, Tunisia
💌 skonbardaoui@gmail.com

🌐 GitHub: https://github.com/skander-bardaoui