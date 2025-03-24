## To setup project locally


- Download/clone the source code from github
- Create database "ealsuiteinv"
- Change the database configurations in the ".env" file if required
- Run the command "php artisan migrate"
- Run the command "php artisan db:seed"
- Run the project using "php artisan serve" or by settingup localhost virtualhost


## Workflow


The base url (eg: http://localhost/invoicemngmnt-intrvw-ealsuite/public/admin) will load the login page. 
The command "php artisan db:seed" will create a default admin user with username : admin@ealsuite.com and password : ealSuite2#
Use the above username and password to login to the admin portal.
Once logged in it will redirect to the admin dashboard
In the menu bar there are 4 menus provided.
1. Home - Dashboard.
2. Customer - To add customer, List customers, Edit customers.
3. Invoice - To view all invoices, Add new invoices, Edit invoices.
4. Logout


##
This project has been done in Laravel. There are 2 route files in this which are admin.php and api.php to handle requests for admin UI and api's respectively. New modules can be added to the project without affecting the existing ones. Used the repository pattern to ensure query reusability.
The Laravel Sanctum library has been used for API authentications. We are authenticating the api's using the user token. 






