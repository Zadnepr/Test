Задание №1
--------------------------

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
--------------------------

Выполнено на Yii2. 
1. Настроен модуль urlManager для отображения ссылок как указано в задании
2. Для хранения токена создана модель Token которая имеет статический метод getToken

Токен для авторизации запосов
---------

      bHfx4VQsMKKfe7MaNAd9_KnkqJMtaSQi8jgjTeo7g6776-EdYvHMTY8uMh_XV7Dr

токен сгенерирован методом Yii::$app->getSecurity()->generateRandomString(64)
3. Создан контроллер api.
4. Создан контроллер v1, который наследует от родительского контроллера api.
5. В контроллере api (для всех будующих версий и всех запросов к нему) настроена проверка на авторизаию с помощью метода behaviors и объекта HttpBearerAuth
6. Каждый метод объявленный в api реализован в виде объектов расположение которых должно быть в каталоге app\controllers\api\<версия api>. Каждый из объектов должен иметь метод doMethod, который возвращает данные необходимые для задания.
7. Для доступа к данными курсов биткоина создана модель Btc у которой есть статический метод getData. Возвращает ассоциативный масив курсов валют.