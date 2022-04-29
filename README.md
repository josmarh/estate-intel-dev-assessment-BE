# Books API

## Build
This application was developed with Laravel 9, PHP 8.x

## Installation
* Clone Repository `git clone https://github.com/Eric-Josh/estate-intel-dev-assessment-BE`
`cd estate-intel-dev-assessment-BE`
* Install all dependencies `composer install or composer update`
* Create DB
* Copy .env.example to .env `cp .env.example .env`
* Copy .env.example to .env `cp .env.example .env`
* Generate APP_KEY `php artisan key:generate`
* Run Migration `php artisan migrate`
* Run app `php artisan serve`

A REST API that calls an external API service to get information about books.

The external API that is being used here is the [Ice And Fire API](https://anapioficeandfire.com/Documentation#books). This API requires no sign up /authentication on your part.

When the endpoint:
`GET /api/external-books?name=:nameOfABook`
is requested, the application queries the Ice And Fire API and use the data received to respond with precisely JSON result

A simple CRUD (Create, Read, Update, Delete) API with a local database

When the <strong>CREATE</strong> endpoint:
`POST /api/v1/books`
is requested with the following data:
* name
* isbn
* authors
* country
* number_of_pages
* publisher
* release_date

a book is created in the local database.

When the <strong>READ</strong> endpoint:
`GET /api/v1/books`
is requested, the application will return a list of books from the local database.
<em>The Books API is searchable by <strong>name</strong> (string), <strong>country</strong> (string), <strong>publisher</strong> (string) and
<strong>release date</strong> (year, integer)</em>.

When the <strong>UPDATE</strong> endpoint:
`PATCH /api/v1/books/:id`
is requested with any of the following form data:
* name
* isbn
* authors
* country
* number_of_pages
* publisher
* release_date

and a specific <strong>:id</strong> in the URL, where <strong>:id</strong> is a placeholder variable for an integer. The specific book would be updated in the database.

When the <strong>DELETE</strong> endpoint:
`DELETE /api/v1/books/:id`
is requested with a specific <strong>:id</strong> in the URL, where <strong>:id</strong> is a placeholder variable for an integer. The specific book would be deleted from the database.

When the <strong>SHOW</strong> endpoint:
`GET /api/v1/books/:id`
is requested with a specific <strong>:id</strong> in the URL, where <strong>:id</strong> is a placeholder variable for an integer. It should show the specific book.