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

### Details about tables and relations:

category and `category_relations` table details:

Table: `category` contains the `Category` of Items.
Table: `catetory_relations` contains the parent-child relationship between `category`. (Many to Many from `category table).

### Example:

One category has another category id as a parent.

### Relation:

`category_id` – Foreign key(`id` from `category` table)
`parent_category_id` – Foreign key(`id` from `category` table)

### item/product table details:

Table: `item` has no parent column of category.

Table: `item_category_relations` contains the relation between
`category` and `item` tables. (Many to Many from `category` and `item` tables)

### Relation:

`item_number` – Foreign key (`number` column from `item` table)
`category_id` – Foreign key(`id` from `category` table)

### Example:

One item has multiple categories and one category has multiple items.

### Requirements:

Show all categories with total item and order categories by total Items (DESC).

Example output:
| Category Name | Total Items |
|---------------|-------------|
| Woman | 30 |
| Men | 29 |
| Junior | 0 |

Note: Don’t need to show nested childs. We need a flat table of pare.

We’ve uncountable child in each parent category and a child might be a parent of another category.

### Example:

<img width="646" alt="image" src="https://user-images.githubusercontent.com/11147698/227709498-e4d4b5d3-b7e7-498b-9b9d-36c2ebe06800.png">


We need to create a categories tree with number of items contain in each category. If a category has 5 child categories and each category has 50 items, then the parent category’s total count will be 250 and for each child will be 50.


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
