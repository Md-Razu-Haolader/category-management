# Category Management

## Create a hierarchical category tree and show all categories with total item and order categories by total Items

### Prepare the project

### Run cli

```bash
composer install
```

```bash
composer dump-autoload
```

OR

```bash
docker-compose up -d
```

### Make sure create a .env file and update the .env file to connect with the database. Examples are given at .env.example file

### To show all categories with total item and order categories by total Items (DESC).

Browse: http://localhost:8080

<img width="1470" alt="image" src="https://user-images.githubusercontent.com/11147698/224759338-a1b69a17-cdf6-4c25-b908-78ca856cdd10.png">


### To show hierarchical categories with total item

Browse: http://localhost:8080/category-tree

<img width="1470" alt="image" src="https://user-images.githubusercontent.com/11147698/224759544-fdea6b7b-8d03-43cd-b66f-8310f9357da3.png">


### To run unit tests

```bash
composer phpunit
```

OR

```bash
./vendor/bin/phpunit --testdox
```

### Project structure

1. index.php is root file of this project
2. All the OOP classes are available in the app directory.
3. "assets" folder is for template design related css and js files.
4. Helpers functions are available in the Helpers directory.
5. All database query functionalities are available in the Repository directory.
6. Service classes are located in the Service directory.
7. Utility classes like database connection manager etc are located at Util directory.
8. All views files are located in the View directory.
9. Config folder is for configuration and app bootstrap related files.
10. All test cases are written in tests folder

Sql file name is ecommerce.sql located at project root
