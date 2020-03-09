Тестовое задание
=====

# 1. Написать функцию на PHP, которая на входе принимает строку из скобок, и
возвращает true если все открытые скобки закрыты, иначе - false. Варианты скобок: ()[]{}  

Примеры:
```php
'(){}[]' => true
'([{}])' => true
'(}' => false
'[({})](]' => false
```

Как запустить скрипт:
```php
cd ./stack
php app.php
```

# 2. Написать функцию на PHP, которая принимает в качестве аргумента количество строк
В итоговом массиве. Нужно вписать в массив ромб из символов *, если позволяет
размерность, иначе - заполнять до конца в виде башни.  

Примеры:
```php
$result1 = build(1);
$result2 = build(2);
$result3 = build(3);
$result4 = build(4);
$result5 = build(5);
$result6 = build(6);
```
Вернут массивы:
```php
$result1 = ['*'];
$result2 = [
' * ',
'***',
];
$result3 = [
' * ',
'***',
' * ',
];
$result4 = [
'   *   ',
'  ***  ',
' ***** ',
'*******',
];
$result5 = [
'  *  ',
' *** ',
'*****',
' *** ',
'  *  ',
];
$result6 = [
'     *     ',
'    ***    ',
'   *****   ',
'  *******  ',
' ********* ',
'***********',
];
```

Как запустить скрипт:
```php
cd ./romb
php app.php
```

# 3. Написать функцию на PHP, которая принимает в качестве аргумента количество строк
Написать SQL запрос. Есть таблицы author, book и book_sale. Последняя содержит
данные по проданным книгам (если книга продана 7 раз, то будет 7 записей в таблице).
Нужно вывести имя автора, количество проданных книг, средний рейтинг проданных
книг. При этом выводить, только если количество проданных книг более 3, и их средний
рейтинг больше 3 (рейтинг может быть в диапазоне от 1 до 5). Результаты нужно
отсортировать по количеству проданных книг от большего к меньшему.  

Схемы:
```sql
CREATE TABLE `author` (
`id` int NOT NULL AUTO_INCREMENT,
`name` varchar(255),
PRIMARY KEY (`id`)
);
CREATE TABLE `book` (
`id` int NOT NULL AUTO_INCREMENT,
`title` varchar(255),
`author_id` int,
`rating` decimal(3, 1),
PRIMARY KEY (`id`)
);
CREATE TABLE `book_sale` (
`id` int NOT NULL AUTO_INCREMENT,
`book_id` int,
PRIMARY KEY (`id`)
);
```

Пример тестовых данных:
```sql
INSERT INTO author (id, name) VALUES
(1, 'Лев Толстой'),
(2, 'Александр Пушкин'),
(3, 'Михаил Лермонтов');
INSERT INTO book (id, title, author_id, rating) VALUES
(1, 'Война и мир', 1, 3),
(2, 'Анна Каренина', 1, 4),
(3, 'Воскресение', 1, 2),
(4, 'Руслан и Людмила', 2, 4),
(5, 'Цыганы', 2, 2),
(6, 'Евгений Онегин', 2, 5),
(7, 'Медный всадник', 2, 4),
(8, 'Кавказский пленник', 2, 4),
(9, 'Бородино', 3, 5),
(10, 'Герой нашего времени', 3, 4),
(11, 'Дума', 3, 4),
(12, 'Парус', 3, 2),
(13, 'Ветка Палестины', 3, 1);

INSERT INTO book_sale (id, book_id) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 10),
(17, 10),
(18, 10),
(19, 10),
(20, 10);
```

SQL: [в файле](./sql/app.sql)
```sql
SELECT author.name, salledCount,
	(SELECT AVG(book.rating) FROM book WHERE book.author_id = author.id) AS avg_rating
	FROM `book`
	INNER JOIN (SELECT book_sale.book_id, COUNT(book_sale.book_id) as salledCount FROM book_sale GROUP BY book_sale.book_id) book_sale
    	ON book.id = book_sale.book_id
    INNER JOIN author
        ON author.id = book.author_id
    WHERE salledCount > 3 AND (SELECT AVG(book.rating) FROM book WHERE book.author_id = author.id) > 3
    GROUP BY book_sale.book_id
    ORDER BY salledCount DESC
```