# Assignement
## Installation
- Clone or download project.
- I made my own MVC framework for this project.
- Do composer install.
- Create a database.
- Import database from performances.sql file.
- Set the config/app.php file
- Set the access data for the database in the config/database.php file.
- Create a virtual host. Your virtualhost file should look like this: <br />

          <VirtualHost *:80>
                  ServerName domenName 

                  ServerAdmin webmaster@localhost
                  DocumentRoot /var/www/html/nameOfFolder

                  <Directory /var/www/html/nameOfFolder/>
                          Options Indexes FollowSymLinks MultiViews
                          AllowOverride All
                          Order allow,deny
                          allow from all
                  </Directory>

                  ErrorLog ${APACHE_LOG_DIR}/error.log
                  CustomLog ${APACHE_LOG_DIR}/access.log combined
          </VirtualHost>

- Run the application from the browser.

