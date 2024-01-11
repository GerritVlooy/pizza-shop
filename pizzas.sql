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

CREATE TABLE klanten (
    klant_id INT PRIMARY KEY AUTO_INCREMENT,
    naam VARCHAR(255) NOT NULL,
    voornaam VARCHAR(255) NOT NULL,
    email VARCHAR(255),
	adres_id INT,
    telefoon_gsm VARCHAR(15) NOT NULL,
    wachtwoord VARCHAR(32),
    opmerkingen VARCHAR(255)
);

CREATE TABLE adressen (
    adres_id INT PRIMARY KEY AUTO_INCREMENT,
    straat VARCHAR(255) NOT NULL,
    huisnummer VARCHAR(10) NOT NULL,
    woonplaats_id INT
);

CREATE TABLE woonplaatsen (
    woonplaats_id INT PRIMARY KEY AUTO_INCREMENT,
    woonplaats_naam VARCHAR(255) NOT NULL,
	postcode VARCHAR(10) NOT NULL
);

INSERT INTO woonplaatsen (woonplaats_naam, postcode) VALUES
    ('Leuven', '3000'),
    ('Heverlee', '3001'),
    ('Kessel-Lo', '3010'),
    ('Wilsele', '3012'),
    ('Herent', '3020'),
    ('Bierbeek', '3360'),
    ('Oud-Heverlee', '3050'),
    ('Lubbeek', '3210'),
    ('Holsbeek', '3220'),
    ('Bertem', '3060');
    
ALTER TABLE klanten
ADD FOREIGN KEY (adres_id)
REFERENCES adressen(adres_id);

ALTER TABLE adressen
ADD FOREIGN KEY (woonplaats_id)
REFERENCES woonplaatsen(woonplaats_id);