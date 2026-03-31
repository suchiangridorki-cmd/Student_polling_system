Student Polling and Survey System



A web-based polling and survey system built for college students using PHP, MySQL, and XAMPP. Students can vote on active polls, view results, and admins can manage polls and users.



---



\## 📋 Prerequisites



\- \[XAMPP](https://www.apachefriends.org/) (PHP 8.x + MySQL)

\- Web Browser (Chrome, Firefox)

\- Git



---



\## ⚙️ Installation Steps



1\. \*Clone the repository\*

bash

   git clone https://github.com/YOUR\_USERNAME/student\_polling\_system.git





2\. \*Move to XAMPP folder\*



   Copy the folder to: C:\\xampp\\htdocs\\student\_polling\_system





3\. \*Start XAMPP\*

   - Open XAMPP Control Panel

   - Start \*Apache\* and \*MySQL\*



4\. \*Create the Database\*

   - Open http://localhost/phpmyadmin

   - Create a new database named student\_polling\_system

   - Import the file database.sql from the repository



5\. \*Configure Database Connection\*

   - Copy config.sample.php and rename it to config.php

   - Edit config.php with your database credentials:

php

   $conn = mysqli\_connect("localhost", "root", "", "student\_polling\_system");





6\. \*Run the Project\*

   - Open browser and go to:



   http://localhost/student\_polling\_system/Login.php





---



\## 🎥 Video Demo



▶️ \[Watch the Demo on YouTube](https://www.youtube.com/your\_video\_link\_here)



---



\## 👤 Default Admin Login



After importing the database, register a user then set role to admin via phpMyAdmin:

sql

UPDATE users SET role = 'admin' WHERE email = 'your@email.com';





---



\## 🛠️ Built With



\- PHP 8.x

\- MySQL

\- HTML/CSS

\- XAMPP



---



\## 📁 Project Structure



student\_polling\_system/

├── Login.php

├── Register.php

├── Dashboard.php

├── Voting\_page.php

├── results.php

├── Create\_poll.php

├── manageusers.php

├── admin\_feedback.php

├── Logout.php

├── config.sample.php

├── database.sql

├── assets/

│   └── images/

├── .gitignore

└── README.md





---



\## 📄 License



MCA Project — Don't University



