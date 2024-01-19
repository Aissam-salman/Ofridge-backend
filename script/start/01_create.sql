-- Active: 1704994694587@@192.168.208.2@3306@ofridge
USE ofridge;
CREATE TABLE IF NOT EXISTS user_app(
        user_app_id INT AUTO_INCREMENT,
        user_app_email VARCHAR(50) UNIQUE NOT NULL,
        user_app_firstname VARCHAR(50) NOT NULL,
        user_app_lastname VARCHAR(50) NOT NULL,
        user_app_birthday DATE NOT NULL,
        user_app_password VARCHAR(50) NOT NULL,
        user_app_img TEXT,
        user_app_created_at DATETIME DEFAULT NOW(),
        user_app_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(user_app_id)
);
CREATE TABLE IF NOT EXISTS recipe_type(
        recipe_type_id INT AUTO_INCREMENT,
        recipe_type_name VARCHAR(50) UNIQUE NOT NULL,
        recipe_type_created_at DATETIME DEFAULT NOW(),
        recipe_type_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(recipe_type_id)
);
CREATE TABLE IF NOT EXISTS keyword(
        keyword_id INT AUTO_INCREMENT,
        keyword_name VARCHAR(50) NOT NULL,
        keyword_created_at DATETIME DEFAULT NOW(),
        keyword_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(keyword_id),
        UNIQUE(keyword_name)
);
CREATE TABLE IF NOT EXISTS category(
        category_id INT AUTO_INCREMENT,
        category_name VARCHAR(50) NOT NULL,
        category_created_at DATETIME DEFAULT NOW(),
        category_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(category_id)
);
CREATE TABLE IF NOT EXISTS country(
        country_id INT AUTO_INCREMENT,
        country_name VARCHAR(50) UNIQUE NOT NULL,
        country_created_at DATETIME DEFAULT NOW(),
        country_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(country_id)
);
CREATE TABLE IF NOT EXISTS nutriscore(
        nutriscore_id INT AUTO_INCREMENT,
        nutriscore_grade VARCHAR(2),
        nutriscore_created_at DATETIME DEFAULT NOW(),
        nutriscore_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(nutriscore_id)
);
CREATE TABLE IF NOT EXISTS unit(
        unit_id INT AUTO_INCREMENT,
        unit_name VARCHAR(5) NOT NULL,
        unit_created_at DATETIME DEFAULT NOW(),
        unit_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(unit_id)
);
CREATE TABLE IF NOT EXISTS step(
        step_id INT AUTO_INCREMENT,
        step_name VARCHAR(30) NOT NULL,
        step_description TEXT,
        step_created_at DATETIME DEFAULT NOW(),
        step_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(step_id)
);
CREATE TABLE IF NOT EXISTS product(
        product_code INT NOT NULL UNIQUE,
        product_name VARCHAR(70),
        product_allergens_tags VARCHAR(50),
        product_brand_owner VARCHAR(50),
        product_generic_name VARCHAR(50),
        product_img_front TEXT,
        product_packaging TEXT,
        product_quantity DECIMAL(4,2),
        fk_nutriscore_id INT NOT NULL,
        product_created_at DATETIME DEFAULT NOW(),
        product_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(product_code)
);
CREATE TABLE IF NOT EXISTS recipe(
        recipe_id INT AUTO_INCREMENT,
        recipe_name VARCHAR(50) NOT NULL,
        recipe_time_cooking DECIMAL(2, 2),
        recipe_img TEXT,
        recipe_rate INT NOT NULL,
        repice_level VARCHAR(20),
        fk_recipe_type_id INT NOT NULL,
        recipe_created_at DATETIME DEFAULT NOW(),
        recipe_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(recipe_id)
);
CREATE TABLE IF NOT EXISTS nutriment(
        nutriment_id INT AUTO_INCREMENT,
        nutriment_name VARCHAR(50) UNIQUE NOT NULL,
        fk_unit_id INT NOT NULL,
        nutriment_created_at DATETIME DEFAULT NOW(),
        nutriment_updated_at DATETIME DEFAULT NOW() ON UPDATE NOW(),
        PRIMARY KEY(nutriment_id)
);
CREATE TABLE IF NOT EXISTS location(
        product_code INT,
        country_id INT,
        PRIMARY KEY(product_code, country_id)
);
CREATE TABLE IF NOT EXISTS product_keyword(
        product_code INT,
        keyword_id INT,
        PRIMARY KEY(product_code, keyword_id)
);
CREATE TABLE IF NOT EXISTS product_category(
        product_code INT,
        category_id INT,
        PRIMARY KEY(product_code, category_id)
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
CREATE TABLE IF NOT EXISTS search_product(
        product_code INT,
        user_app_id INT,
        PRIMARY KEY(product_code, user_app_id)
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

ALTER TABLE product
ADD CONTRAINT fk_nutriscore
FOREIGN KEY(fk_nutriscore_id) REFERENCES nutriscore(nutriscore_id);
ALTER TABLE recipe
ADD CONTRAINT fk_recipe_type
FOREIGN KEY(fk_recipe_type_id) REFERENCES recipe_type(recipe_type_id);
ALTER TABLE location
ADD CONSTRAINT fk_product
FOREIGN KEY(product_code) REFERENCES product(product_code),
ADD CONSTRAINT fk_country
FOREIGN KEY(country_id) REFERENCES country(country_id);
ALTER TABLE location
ADD CONSTRAINT fk_product
FOREIGN KEY(product_code) REFERENCES product(product_code),
ADD CONSTRAINT fk_country
FOREIGN KEY(country_id) REFERENCES country(country_id);
ALTER TABLE product_keyword
ADD CONSTRAINT fk_product
FOREIGN KEY(product_code) REFERENCES product(product_code),
ADD CONTRAINT fk_keyword
FOREIGN KEY(keyword_id) REFERENCES keyword(keyword_id);
ALTER TABLE product_category
ADD CONSTRAINT fk_product
FOREIGN KEY(product_code) REFERENCES product(product_code),
ADD CONSTRAINT fk_category
FOREIGN KEY(category_id) REFERENCES category(category_id);
ALTER TABLE product_nutriment
ADD CONSTRAINT fk_product
FOREIGN KEY(product_code) REFERENCES product(product_code),
ADD CONSTRAINT fk_nutriment
FOREIGN KEY(nutriment_id) REFERENCES nutriment(nutriment_id);
ALTER TABLE recipe_product
ADD CONSTRAINT fk_product
FOREIGN KEY(product_code) REFERENCES product(product_code),
ADD CONSTRAINT fk_recipe
FOREIGN KEY(recipe_id) REFERENCES recipe(recipe_id);
ALTER TABLE search_product
ADD CONSTRAINT fk_product
FOREIGN KEY(product_code) REFERENCES product(product_code),
ADD CONSTRAINT fk_user_app
FOREIGN KEY(user_app_id) REFERENCES user_app(user_app_id);
ALTER TABLE product_composition
ADD CONSTRAINT fk_product
FOREIGN KEY(product_code) REFERENCES product(product_code),
ADD CONSTRAINT fk_product_1
FOREIGN KEY(product_code_1) REFERENCES product(product_code);
ALTER TABLE recipe_step
ADD CONSTRAINT fk_recipe
FOREIGN KEY(recipe_id) REFERENCES recipe(recipe_id),
ADD CONSTRAINT fk_step
FOREIGN KEY(step_id) REFERENCES step(step_id);