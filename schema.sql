CREATE DATABASE yeticave;

USE yeticave;

CREATE TABLE categories (
	category_id	int AUTO_INCREMENT PRIMARY KEY,
	catname		varchar(128) NOT NULL,
	catimage	varchar(32)
);

CREATE TABLE users (
	user_id		int AUTO_INCREMENT PRIMARY KEY,
	created_at	int(11) NOT NULL,
	email		varchar(128) UNIQUE NOT NULL,
	name		varchar(64) NOT NULL,
	password	varchar(64) NOT NULL,
	avatar		varchar(32),
	contacts 	varchar (240) NOT NULL
);

CREATE TABLE lots (
	lot_id		int AUTO_INCREMENT PRIMARY KEY,
	created_at  int(11) NOT NULL,
	lotname		varchar(128) NOT NULL,
	description	text NOT NULL,
	image		varchar(128) NOT NULL,
	initprice	int UNSIGNED NOT NULL,
	completed_at int(11) NOT NULL,
	steprate 	int UNSIGNED NOT NULL,
	user_id		int NOT NULL,
	winner_id	int,
	category_id int NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	FOREIGN KEY (winner_id) REFERENCES users(user_id),
	FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE INDEX c_lot ON lots(lot_id);

CREATE FULLTEXT INDEX lotsearch ON lots(lotname, description);

CREATE TABLE rates (
	rate_id		int AUTO_INCREMENT PRIMARY KEY,
	created_at	int(11) NOT NULL,
	rate 		int UNSIGNED NOT NULL,
	user_id		int NOT NULL,
	lot_id		int NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users (user_id),
	FOREIGN KEY (lot_id) REFERENCES lots (lot_id)
);

CREATE INDEX c_rate ON rates(rate);

