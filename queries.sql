USE yeticave;

INSERT INTO categories (catname, catimage)
VALUES 
	('Доски и лыжи', 'boards'),
	('Крепления', 'attachment'),
	('Ботинки', 'boots'),
	('Одежда', 'clothing'),
	('Инструменты', 'tools'),
	('Разное', 'other');

INSERT INTO users (created_at, email, name, password, avatar, contacts)
VALUES 
	(1432501200, 'ignat.v@gmail.com', 'Игнат', 
	'$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 
	'img/user.jpg', 'Телефон для связи 846352673'),
	(1473541200, 'kitty_93@li.ru', 'Леночка', 
	'$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 
	'', '8(912)3402995'),
	(1503694800, 'warrior07@mail.ru', 'Руслан', 
	'$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 
	'', 'Мобильный 934998843, адрес ул.Кирова, 18');

INSERT INTO lots (created_at, lotname, description, image, initprice, completed_at, 
				  steprate, user_id, category_id)
VALUES 
	(1494774015, '2014 Rossignol District Snowboard', 'Прекрасный сноудборд', 'img/lot-1.jpg', 
	10999, 1509742800, 1000, 1, 1),
	(1509523992, 'DC Ply Mens 2016/2017 Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                        снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                        снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                        кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                        просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                    	равнодушным.', 'img/lot-2.jpg', 159999, 1514667600, 12000, 2, 1),
	(1509821096, 'Крепления Union Contact Pro 2015 года размер L/XL', 'Крепления в идеальном состоянии', 
	'img/lot-3.jpg', 8000, 1513198800, 750, 3, 2),
	(1509134504, 'Ботинки для сноуборда DC Mutiny Charocal', 'Состояние удоволетворительное, присутствуют небольшие царапины',
	'img/lot-4.jpg', 10999, 1514581200, 1500, 1, 3),
	(1503314081, 'Куртка для сноуборда DC Mutiny Charocal', 'Отличный выбор!', 'img/lot-5.jpg', 7500, 
	1512766800, 100, 1, 4),
	(1504584694, 'Маска Oakley Canopy', 'Маска в хорошем состоянии', 'img/lot-6.jpg', 5400, 1516050000, 250, 3, 6);

INSERT INTO rates (created_at, rate, user_id, lot_id)
VALUES 
	(1510675815, 8750, 1, 3),
	(1511246269, 10000, 2, 3),
	(1511870661, 9000, 3, 5),
	(1512507600, 13000, 2, 1);

#Список всех категорий

SELECT catname FROM categories;

#Самые новые открытые лоты

SELECT  lotname, 
		initprice,
		image,
        rate,
		qty,
		catname
FROM 	lots 
LEFT JOIN categories 
ON lots.category_id = categories.category_id
LEFT JOIN (SELECT rates.rate_id, 
				  rates.created_at, 
				  rates.rate, 
				  rates.user_id, 
				  rates.lot_id,
           		  qty
			FROM rates 
			JOIN (SELECT rates.lot_id, 
						 MAX(rates.rate) AS maxrate, 
						 COUNT(rates.rate) AS qty
				  FROM rates 
				  GROUP BY rates.lot_id) AS maxrates 
			ON rates.lot_id = maxrates.lot_id AND rates.rate = maxrates.maxrate) AS groupedrates 
ON lots.lot_id = groupedrates.lot_id
WHERE  	lots.completed_at > UNIX_TIMESTAMP(NOW()) ORDER BY lots.created_at DESC;

#Поиск лота по названию или описанию

SELECT * FROM `lots` WHERE (lotname LIKE '%куртка%' OR description LIKE '%куртка%');

#Обновление названия лота по его идентификатору

UPDATE lots SET lotname = 'Куртка для сноуборда' WHERE lot_id = 5;

#Самые свежие ставки для лота по его идентификатору

SELECT 	lotname,
		rate,
		FROM_UNIXTIME(rates.created_at) 
FROM rates
JOIN lots 
ON rates.lot_id = lots.lot_id
WHERE rates.lot_id = 3
ORDER BY rates.created_at DESC;