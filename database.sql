CREATE TABLE IF NOT EXISTS contact
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL, 
	cpf VARCHAR(11) NOT NULL UNIQUE,
	birth DATE NOT NULL, 
	phone VARCHAR(10) NOT NULL, 
	cel VARCHAR(11) NOT NULL, 
	mail VARCHAR(255) NOT NULL,
	img VARCHAR(15),
	highlight boolean DEFAULT 0,
	PRIMARY KEY(id)
);

INSERT INTO contact (name, cpf, birth, phone, cel, mail, img, highlight) VALUES ("Marcelo Henrique", "40812132831", "1992-01-30", "6732267054", "67981267054", "marcelo@mail.com", "40812132831.jpg", "1");
INSERT INTO contact (name, cpf, birth, phone, cel, mail, img, highlight) VALUES ("João Vitor", "12312312312", "2006-12-26", "1834266033", "1899266033", "joao@gmail.com", "12312312312.jpg", "0");
INSERT INTO contact (name, cpf, birth, phone, cel, mail, img, highlight) VALUES ("Ricardo", "34175376412", "1950-01-01", "1144556633", "1194556639", "ricardo@hotmail.com.br", NULL, "1");