CREATE TABLE pizzas (
    pizza_id INT AUTO_INCREMENT PRIMARY KEY,
    pizza_type VARCHAR(255) NOT NULL,
    base_price_usd DECIMAL(10, 2) NOT NULL
);

CREATE TABLE pizza_sizes (
    size_id INT AUTO_INCREMENT PRIMARY KEY,
    size_cm INT NOT NULL,
    price_multiplier DECIMAL(4, 2) NOT NULL
);

CREATE TABLE sauces (
    sauce_id INT AUTO_INCREMENT PRIMARY KEY,
    sauce_name VARCHAR(255) NOT NULL,
    price_usd DECIMAL(10, 2) NOT NULL
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    pizza_id INT NOT NULL,
    size_id INT NOT NULL,
    sauce_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price_byn DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pizza_id) REFERENCES pizzas(pizza_id),
    FOREIGN KEY (size_id) REFERENCES pizza_sizes(size_id),
    FOREIGN KEY (sauce_id) REFERENCES sauces(sauce_id)
);

-- Заполните таблицы данными
INSERT INTO pizzas (pizza_type, base_price_usd) VALUES
    ('Пепперони', 8.00),
    ('Деревенская', 7.50),
    ('Гавайская', 9.00),
    ('Грибная', 8.50);

INSERT INTO pizza_sizes (size_cm, price_multiplier) VALUES
    (21, 1.0),
    (26, 1.2),
    (31, 1.4),
    (45, 1.8);

INSERT INTO sauces (sauce_name, price_usd) VALUES
    ('Сырный', 1.00),
    ('Кисло-сладкий', 0.80),
    ('Чесночный', 0.90),
    ('Барбекю', 1.10);
