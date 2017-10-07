CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ид автора',
  `author_name` varchar(250) COMMENT 'имя автора',
  PRIMARY KEY (`author_id`)
);

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ид книги',
  `book_name` varchar(70) COMMENT 'название книги',
  PRIMARY KEY (`book_id`)
);

CREATE TABLE IF NOT EXISTS `authors_to_books` (
  `ab_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ид записей',
  `author_id` int(11) NOT NULL COMMENT 'ид автора книги',
  `book_id` int(11) NOT NULL  COMMENT 'ид книги',
  PRIMARY KEY (`ab_id`),
  CONSTRAINT ab_to_author FOREIGN KEY(author_id) REFERENCES authors(author_id),
  CONSTRAINT ab_to_books FOREIGN KEY(book_id) REFERENCES books(book_id)
);