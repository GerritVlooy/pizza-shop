CREATE TABLE Pizzas (
    pizza_id INT(10) UNSIGNED NOT NULL PRIMARY KEY,
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
    ingredient_id INT(10) UNSIGNED NOT NULL PRIMARY KEY,
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
    klant_id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    naam VARCHAR(255) NOT NULL,
    voornaam VARCHAR(255) NOT NULL,
    email VARCHAR(255),
	adres_id INT(10) UNSIGNED NOT NULL,
    telefoon_gsm VARCHAR(15) NOT NULL,
    wachtwoord VARCHAR(32)
);

CREATE TABLE adressen (
    adres_id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    straat VARCHAR(255) NOT NULL,
    huisnummer VARCHAR(10) NOT NULL,
    woonplaats_id INT(10) UNSIGNED NOT NULL
);

CREATE TABLE woonplaatsen (
    woonplaats_id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
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

CREATE TABLE promotie_pizzas (
    promotie_id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pizza_id INT(10) UNSIGNED NOT NULL,
    promotie_prijs DECIMAL(8, 2) NOT NULL,
    FOREIGN KEY (pizza_id) REFERENCES Pizzas(pizza_id)
);

CREATE TABLE promotie_klanten (
	promotie_klanten_id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    promotie_id INT(10) UNSIGNED NOT NULL,
    klant_id INT(10) UNSIGNED NOT NULL,
    FOREIGN KEY (klant_id) REFERENCES klanten(klant_id),
    FOREIGN KEY (promotie_id) REFERENCES promotie_pizzas(promotie_id)
);

INSERT INTO promotie_pizzas (pizza_id, promotie_prijs)
VALUES
    (1, 8.99),
    (2, 10.49),
    (3, 9.99),
    (4, 11.49),
    (1, 7.99);

CREATE TABLE bestellingen (
bestelling_id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
klant_id INT(10) UNSIGNED NOT NULL,
opmerkingen VARCHAR(400),
bestelling_datum DATETIME,
FOREIGN KEY (klant_id) REFERENCES klanten(klant_id)
);

CREATE TABLE bestelde_pizzas (
bestelde_pizzas_id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
bestelling_id INT(10) UNSIGNED NOT NULL,
pizza_id  INT(10) UNSIGNED NOT NULL,
promotie_klanten_id INT(10) UNSIGNED,
hoeveelheid INT(10) UNSIGNED NOT NULL,
FOREIGN KEY (pizza_id) REFERENCES pizzas(pizza_id),
FOREIGN KEY (bestelling_id) REFERENCES bestellingen (bestelling_id),
FOREIGN KEY (promotie_klanten_id) REFERENCES promotie_klanten(promotie_klanten_id)
);

CREATE TABLE bestelde_ingredienten (
bestelde_ingredienten_id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ingredient_id INT(10) UNSIGNED NOT NULL,
bestelde_pizzas_id INT(10) UNSIGNED NOT NULL,
FOREIGN KEY (ingredient_id) REFERENCES ingredienten(ingredient_id),
FOREIGN KEY (bestelde_pizzas_id) REFERENCES bestelde_pizzas(bestelde_pizzas_id)
);

INSERT INTO adressen (straat, huisnummer, woonplaats_id) VALUES
('Bakkerstraat', '123', 1),
('Sesamstraat', '456', 2),
('Marialaan', '789', 3);

INSERT INTO klanten (naam, voornaam, email, adres_id, telefoon_gsm, wachtwoord) VALUES
('Doe', 'John', 'john.doe@test.com', 1, '123456789', '098f6bcd4621d373cade4e832627b4f6'),
('Smith', 'Jane', 'jane.smith@test.com', 2, '987654321', '098f6bcd4621d373cade4e832627b4f6'),
('Williams', 'Tom', 'tom.williams@test.com', 3, '555111222', '098f6bcd4621d373cade4e832627b4f6');

INSERT INTO promotie_klanten (promotie_id, klant_id) VALUES
(1, 1),
(2, 2),
(3, 3);
