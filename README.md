## How To Install

#### First Of All:
- Open your terminal 
``` 
git clone https://github.com/FoxWilliamLucas/test-app.git
cd test-app
composer install
cp .env.example .env
php artisan key:generate
```
- Create an empty database for our application
- Fill the database credentials inside .env file
- Return to the terminal
```
php artisan migrate
php artisan db:seed
php artisan serv
php artisan queue:listen

```
it will help running applications on the PHP development server url http://lcoalhost:8000 by default

- open your browsre and go to http://lcoalhost:8000
##  Enjoy !!

## Assignment Desctiption
Your job is to create an invoicing API.The API needs to have endpoints to:
    - Create a new invoice for a customer and persist the invoice data.
    - Show the details for one invoice. Each Customer pays by number and quality of Users. You need to determine the number and the quality of Users for each invoice and make sure Users are not counted twice across invoice periods.


## ERD Diagram
![ERDDiagram1](https://raw.githubusercontent.com/FoxWilliamLucas/test-app/main/ERDDiagram1.jpg)

## API Documentation
https://documenter.getpostman.com/view/8046650/UzJEUKnM


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).