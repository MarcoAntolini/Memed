INSERT INTO utenti (username, email, password, salt, nomefile, bio)
VALUES (
        'user1',
        'user1@gmail.com',
        'user1',
        '',
        '../public/assets/img/default-pic.jpg',
        'Bio di user1, testo di prova'
    );
INSERT INTO utenti (username, email, password, salt, nomefile, bio)
VALUES (
        'user2',
        'user2@gmail.com',
        'user2',
        '',
        '../public/assets/img/default-pic.jpg',
        'Bio di user2, testo di prova'
    );
INSERT INTO utenti (username, email, password, salt, nomefile, bio)
VALUES (
        'user3',
        'user3@gmail.com',
        'user3',
        '',
        '../public/assets/img/default-pic.jpg',
        'Bio di user3, testo di prova'
    );
INSERT INTO post (idpost, nomefile, testo, data, username)
VALUES (
        '1',
        '../public/assets/img/default-pic.jpg',
        '',
        '2023-12-10 20:00:00',
        'user1'
    );
INSERT INTO post (idpost, nomefile, testo, data, username)
VALUES (
        '2',
        '',
        'Testo di prova del post',
        '2023-12-10 20:00:00',
        'user2'
    );
INSERT INTO segue (Fol_username, username)
VALUES ('user1', 'user2');
INSERT INTO segue (Fol_username, username)
VALUES ('user2', 'user3');
INSERT INTO segue (Fol_username, username)
VALUES ('user3', 'user1');