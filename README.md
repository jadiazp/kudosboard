## KudosBoard

This application let users inside an organization to send kudos to another member of the company. To do this, they will need to login. A JWT authorization method was developed en order to authorize users to use the different endpoints of the API. Once the user is logged in, it will possible to select one of the available boards. Each board consists of one card that shows the title and description of the board, also is possible to see how many kudos have been registered on each board.

When the user selects one board, a list of kudos are going to be displayed. If the user remains in this view, it will be possible to see, in real time, the addition of new kudos by another user. To achieve this, Laravel echo and pusher were used.

The backend was built as an API developed with Laravel and the UI using Vuejs and Nuxtjs.

This application has been coded in a Windows environment and some details are added in this README file in order to achieve the correct installation.

#### Getting Started
- Install the last version of Docker desktop.
- Install Ubuntu 20.04 WSL 2.
- In Docker desktop setting, follow these options: Resource > WSL INTEGRATION > "Enable integration with my default WSL Distro" and enable the Ububtu option.

Those 3 steps are only necessary if you are going to set up the environment in a Windows computer. If it's not the case, the procedure is the standard one.

##### Standard Steps
When the docker container will be built, the following steps should be followed:
1. 
```php
php artisan migrate
```
2. 
```php
php artisan db:seed
```
3. Use any email from the Users table to login into the application, the default password is "password" for all users.

The .env file is going to be sent to the person who will install the application. 
The Postman collection has been added to the repo.

