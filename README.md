Задание №1

		SELECT 
			`users`.`id` AS `ID`, TRIM(CONCAT(`first_name`, ' ', `last_name`)) AS `Name`, `books`.`author` AS `Author`, TRIM(GROUP_CONCAT(`books`.`name` SEPARATOR ', ')) AS `Books`
		FROM `users`
		JOIN `user_books` ON `user_books`.`user_id` = `users`.`id`
		JOIN `books` ON `books`.`id`=`user_books`.`book_id`
		WHERE 
		 `users`.`age` >=7 AND `users`.`age`<=14
		GROUP BY `users`.`id`
		having COUNT(DISTINCT `books`.`author`)=1  AND (COUNT(`books`.`id`)=2)
		
------------
------------ 


Задание №2

Выполнено на Yii2. 
1. Настрое модуль urlManager для отображения ссылок как указано в задании
2. Для хранения токена создана модель Token которая имеет статический метод getToken

Токен для авторизации запосов
-------------------

      bHfx4VQsMKKfe7MaNAd9_KnkqJMtaSQi8jgjTeo7g6776-EdYvHMTY8uMh_XV7Dr

