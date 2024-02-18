
# Learn Deutsch


## Introduction
This is a web application. it helps Deutsch new learners to learn the language words with their different levels and types and test themselves providing a nice and simple ui.

### Basic functionalities:
1. Auth:

users can register new account, login with existing one and logout from logged account.

2. Words:

users can view all words and filter them using a bunch of useful filters.

users can add new words, and the application will handle adding the translation to it with the help of Google translate api.

users can submit issues about certain words, and suggest a feedback about it.

3. Quizzes:

users can start a new quiz selecting a language level and desired number of words (users are limited to configured number of quizzes per day).

users can cancel performing a quiz.

users can show a list of their submitted quizzes and results with a filter of language level.

users can delete a submitted quiz.

4. Profile:

users can update certain profile info.

users can delete their account.


## Installation

1. Clone the repository:
```sh
https://github.com/OpadaAlzaiede/learn-deutsch
```

2. Install all dependencies:
```php
composer install
```

```javascript
npm install
```

3. Copy .env.example file to .env file:
```sh
cp .env.example .env
```

4. Generate the application key:
```
php artisan key:genetrate
```

5. Setup database enviroment variables in .env file:

** You should create a new database with the name provided to the DB_DATABASE varaiable in you DBMS server **

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_username_password
```

6. Run migration files and:
```
php artisan migrate:fresh
```

7. Seed the application important data (this will seed language_levels, types, roles, and admin account):
```
php artisan app:seed
```

7. Seed the users & words data (this will seed a number of words foreach level and type):
```
php artisan db:seed
```

7. Run the server:
```
php artisan serve
npm run watch
```

##Future updates

** there will be a bunch of nice features added to the application: **
1. add verbs data.
2. allow performing quizzes for words and verbs.
