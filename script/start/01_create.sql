-- Active: 1704994694587@@192.168.208.2@3306@ofridge
-- create all
USE ofridge;

CREATE TABLE IF NOT EXISTS user_type(
        user_type_id INT AUTO_INCREMENT,
        user_type_name VARCHAR(50) UNIQUE NOT NULL,
        user_app_id INT NOT NULL,
        PRIMARY KEY(user_type_id)
);
CREATE TABLE IF NOT EXISTS user_app(
        user_app_id INT AUTO_INCREMENT,
        user_app_email VARCHAR(50) UNIQUE NOT NULL,
        user_app_firstname VARCHAR(50) NOT NULL,
        user_app_lastname VARCHAR(50) NOT NULL,
        user_app_birthday DATE NOT NULL,
        user_app_password VARCHAR(50) NOT NULL,
        user_app_img TEXT,
        user_type_id INT,
        PRIMARY KEY(user_app_id),
        FOREIGN KEY(user_type_id) REFERENCES user_type(user_type_id)
);

CREATE TABLE IF NOT EXISTS recipe_type(
        recipe_type_id INT AUTO_INCREMENT,
        recipe_type_name VARCHAR(50) UNIQUE NOT NULL,
        PRIMARY KEY(recipe_type_id)
);



CREATE TABLE IF NOT EXISTS keyword(
        keyword_id INT AUTO_INCREMENT,
        keyword_name VARCHAR(50) NOT NULL,
        PRIMARY KEY(keyword_id),
        UNIQUE(keyword_name)
);

CREATE TABLE IF NOT EXISTS category(
        category_id INT AUTO_INCREMENT,
        category_name VARCHAR(50) NOT NULL,
        PRIMARY KEY(category_id)
);

CREATE TABLE IF NOT EXISTS country(
        country_id INT AUTO_INCREMENT,
        country_name VARCHAR(50) UNIQUE NOT NULL,
        PRIMARY KEY(country_id)
);

CREATE TABLE IF NOT EXISTS nutriscore(
        nutriscore_id INT AUTO_INCREMENT,
        nutriscore_grade VARCHAR(2),
        PRIMARY KEY(nutriscore_id)
);

CREATE TABLE IF NOT EXISTS unit(
        unit_id INT AUTO_INCREMENT,
        unit_name VARCHAR(5) NOT NULL,
        PRIMARY KEY(unit_id)
);

CREATE TABLE
    IF NOT EXISTS step(
        step_id INT AUTO_INCREMENT,
        step_name VARCHAR(30) NOT NULL,
        step_description TEXT,
        PRIMARY KEY(step_id)
);

CREATE TABLE IF NOT EXISTS product(
        product_code INT NOT NULL UNIQUE,
        product_name VARCHAR(70),
        product_allergens_tags VARCHAR(50),
        product_brand_owner VARCHAR(50),
        product_generic_name VARCHAR(50),
        product_img_front BLOB,
        product_packaging TEXT,
        product_quantity DECIMAL(4,2),
        nutriscore_id INT NOT NULL,
        PRIMARY KEY(product_code),
        FOREIGN KEY(nutriscore_id) REFERENCES nutriscore(nutriscore_id)
);

CREATE TABLE IF NOT EXISTS recipe(
        recipe_id INT AUTO_INCREMENT,
        recipe_name VARCHAR(50) NOT NULL,
        recipe_time_cooking DECIMAL(2, 2),
        recipe_img BLOB,
        recipe_rate INT NOT NULL,
        repice_level VARCHAR(20),
        recipe_type_id INT NOT NULL,
        PRIMARY KEY(recipe_id),
        FOREIGN KEY(recipe_type_id) REFERENCES recipe_type(recipe_type_id)
);

CREATE TABLE IF NOT EXISTS nutriment(
        nutriment_id INT AUTO_INCREMENT,
        nutriment_name VARCHAR(50) UNIQUE NOT NULL,
        unit_id INT NOT NULL,
        PRIMARY KEY(nutriment_id),
        FOREIGN KEY(unit_id) REFERENCES unit(unit_id)
);

CREATE TABLE IF NOT EXISTS location(
        product_code INT,
        country_id INT,
        PRIMARY KEY(product_code, country_id),
        FOREIGN KEY(product_code) REFERENCES product(product_code),
        FOREIGN KEY(country_id) REFERENCES country(country_id)
);

CREATE TABLE IF NOT EXISTS product_keyword(
        product_code INT,
        keyword_id INT,
        PRIMARY KEY(product_code, keyword_id),
        FOREIGN KEY(product_code) REFERENCES product(product_code),
        FOREIGN KEY(keyword_id) REFERENCES keyword(keyword_id)
);

CREATE TABLE IF NOT EXISTS product_category(
        product_code INT,
        category_id INT,
        PRIMARY KEY(product_code, category_id),
        FOREIGN KEY(product_code) REFERENCES product(product_code),
        FOREIGN KEY(category_id) REFERENCES category(category_id)
);

CREATE TABLE IF NOT EXISTS product_nutriment(
        product_code INT,
        nutriment_id INT,
        product_nutriment_quantity DECIMAL(4, 4) NOT NULL,
        PRIMARY KEY(product_code, nutriment_id),
        FOREIGN KEY(product_code) REFERENCES product(product_code),
        FOREIGN KEY(nutriment_id) REFERENCES nutriment(nutriment_id)
);

CREATE TABLE IF NOT EXISTS recipe_product(
        product_code INT,
        recipe_id INT,
        PRIMARY KEY(product_code, recipe_id),
        FOREIGN KEY(product_code) REFERENCES product(product_code),
        FOREIGN KEY(recipe_id) REFERENCES recipe(recipe_id)
);

CREATE TABLE IF NOT EXISTS search_recipe(
        recipe_id INT,
        user_app_id INT,
        PRIMARY KEY(recipe_id, user_app_id),
        FOREIGN KEY(recipe_id) REFERENCES recipe(recipe_id),
        FOREIGN KEY(user_app_id) REFERENCES user_app(user_app_id)
);

CREATE TABLE IF NOT EXISTS product_composition(
        product_code INT,
        product_code_1 INT,
        PRIMARY KEY(product_code, product_code_1),
        FOREIGN KEY(product_code) REFERENCES product(product_code),
        FOREIGN KEY(product_code_1) REFERENCES product(product_code)
);

CREATE TABLE IF NOT EXISTS recipe_step(
        recipe_id INT,
        step_id INT,
        PRIMARY KEY(recipe_id, step_id),
        FOREIGN KEY(recipe_id) REFERENCES recipe(recipe_id),
        FOREIGN KEY(step_id) REFERENCES step(step_id)
);