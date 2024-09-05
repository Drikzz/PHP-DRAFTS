//SQL query

INSERT INTO book_content (
    book_barcode, 
    book_title, 
    book_author, 
    book_genre, 
    book_publisher, 
    book_pub_date, 
    book_edition, 
    book_copies, 
    book_format, 
    book_age_group, 
    book_rating, 
    book_desc
) 
VALUES 
    (101, 'The Future of Us', 'John Green', 'Sci-Fi', 'Penguin Books', '2022-01-15', 1, 5, 'Hardbound', 'Teens,Adult', 4, 'A thrilling journey through time.'),
    (102, 'Tales of Wonder', 'JK Rowling', 'Fantasy', 'Scholastic', '2019-06-20', 2, 10, 'Softbound', 'Kids,Teens', 5, 'Magical tales that captivate all ages.'),
    (103, 'Love in Paris', 'Nora Roberts', 'Romance', 'Harlequin', '2021-08-11', 3, 8, 'Softbound', 'Adult', 3, 'A heartwarming love story set in Paris.'),
    (104, 'Into the Shadows', 'Stephen King', 'Thriller', 'Scribner', '2018-10-05', 1, 7, 'Hardbound', 'Adult', 5, 'A chilling thriller that keeps you on edge.'),
    (105, 'The Haunted Woods', 'H.P. Lovecraft', 'Horror', 'Arkham House', '2020-09-13', 4, 6, 'Hardbound', 'Teens,Adult', 4, 'A spine-tingling horror that haunts the reader.'),
    (106, 'Philosophy of Life', 'Friedrich Nietzsche', 'Philosophy', 'Dover Publications', '2015-05-25', 6, 3, 'Softbound', 'Adult', 4, 'An exploration of existential philosophy.'),
    (107, 'Galaxies Beyond', 'Isaac Asimov', 'Sci-Fi', 'Random House', '2017-02-14', 1, 12, 'Hardbound', 'Teens,Adult', 5, 'An epic science fiction saga across the stars.'),
    (108, 'The Broken Kingdom', 'Brandon Sanderson', 'Fantasy', 'Tor Books', '2023-07-22', 2, 9, 'Softbound', 'Teens,Adult', 5, 'An epic fantasy tale of betrayal and power.')
;