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