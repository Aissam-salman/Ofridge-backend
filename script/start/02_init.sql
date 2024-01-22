-- Active: 1704994694587@@192.168.208.2@3306@ofridge

USE ofridge -- add content into table

INSERT INTO
    user_app (
        user_app_email, user_app_firstname, user_app_lastname, user_app_birthday, user_app_password, user_app_img
    )
VALUES (
        'example@example.com', 'John', 'Do', '1999-01-01', 'hashpass', "/public/assets/profil/John_Do.jpg"
    );

INSERT INTO nutriscore (nutriscore_grade)
VALUES ('A'),
    ('B'),
    ('C'),
    ('D'),
    ('E'),
    ('F');

INSERT INTO unit (unit_name)
VALUES ('g'),
    ('L'),
    ('ml'),
    ('mg'),
    ('kcal');

INSERT INTO nutriment(nutriment_name, fk_unit_id)
VALUES ('Calories', 5),
    ('Carbohydrates', 1),
    ('Fat', 1);


INSERT INTO recipe (
        recipe_name, recipe_time_cooking, recipe_img, recipe_rate, recipe_level
    )
VALUES (
        'steak_frite', '1', 'public/pictureRecipe/steakFrite.png', '3', 'easy'
    );

INSERT INTO recipe_type (
        recipe_type_name
    )
VALUES (
        'plat'
    );

    INSERT INTO step (
        step_name, step_description
    )
VALUES (
        'cuire le steak', 'faire chauffer la casserole puis mettre le steak'
    );

 INSERT INTO recipe_step (
        recipe_id, step_id
    )
VALUES (
        '1', '1'
    );

INSERT INTO recipe_product (
        product_code, recipe_id
    )
VALUES (
        '1', '1'
    );
