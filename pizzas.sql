CREATE TABLE Pizzas (
    pizza_id INT PRIMARY KEY,
    pizza_naam VARCHAR(255) NOT NULL,
    pizza_beschrijving VARCHAR(255) NOT NULL,
    prijs DECIMAL(8, 2) NOT NULL
);

INSERT INTO Pizzas (pizza_id, pizza_naam, pizza_beschrijving, prijs)
VALUES
    (1, 'Margherita', 'tomaten - Mozarella', 10.99),
    (2, 'Pepperoni', 'tomaten - Mozarella - Pepperoni', 12.99),
    (3, 'Vegetarisch', 'tomaten - Mozarella - champignon', 11.99),
    (4, 'Fontanella', 'tomaten - Mozarella - ajuin - artisjokken - garnalen - ansjovis - olijven - hesp - champignon' , 13.99);
    
CREATE TABLE Ingredienten (
    ingredient_id INT PRIMARY KEY,
    ingredient_naam VARCHAR(100) NOT NULL, 
    prijs DECIMAL(8, 2) NOT NULL
);

INSERT INTO Ingredienten (ingredient_id, ingredient_naam, prijs)
VALUES
	(1, 'Mozzarella', 0.5),
    (2, 'Tomaat' , 0.5),
    (3, 'Pepperoni', 1.0),
    (4, 'champignon', 0.5),
    (5, 'Pesto', 2.5);
