INSERT INTO utenti (username, email, password, salt, nomefile, bio)
VALUES (
        'user1',
        'user1@gmail.com', --passworld user1
        '99e16d687137a7dc86e5cd47e421d49b9d1299469281656fd96c754eae8f592b14996723944213ca4f0c73ef0907ee44e61d0045942baf48ab7d749dd93fb132',
        '162716358baf657f8e3d6891d9177d946c2a4561a39a6366d9cf488b179729c7c29f427b0776503184d89afdec838f814bb3f8d0da595d6b4515d6fb68265b59',
        '../public/assets/img/default-pic.jpg',
        'Bio di user1, testo di prova'
    ),
    (
        'user2',
        'user2@gmail.com', --passworld user2
        '2a468f7ad9b66f97ac7c79126e446494791b3031f2db5d37c67d3c2c9f5c782f27905b0c97087279e559b8bd58a2cc259a46a5580ef9d7b54f91b1a03a28b86e',
        '2313594e53f175b8a409de325cfd96a23f6ec4a246c7189e32db16f6bb2a9453a412ea8003e0823d29ec856c72fe982ec673221dddcdd2a572340741e784f691',
        '../public/assets/img/default-pic.jpg',
        'Bio di user2, testo di prova'
    ),
    (
        'user3',
        'user3@gmail.com', --passworld user3
        '7797e22cd2c28da9e19bfae5c341019fe246e0a9010f6027b0a81e3b7d25052462c0669d0d513e4b4c02eebfec52d5d847b8c4873e33f796193672020edc88ac',
        '9d0d455a9210d5117b646083ce6efbd6d1e739da65164f22608bdc635b652063cece95f3466cba79c9195c253898c8cd72fec481ea49049a400a8641da68c3d2',
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
    ),
    (
        '2',
        '',
        'Testo di prova del post',
        '2023-12-10 20:00:00',
        'user2'
    );

INSERT INTO categoria (idcategoria, nome)
VALUES ('1', 'categoria1'),
         ('2', 'categoria2'),
         ('3', 'categoria3');

INSERT INTO segue (Fol_username, username)
VALUES ('user1', 'user2'),
('user2', 'user3')
('user3', 'user1');

INSERT INTO reazione (idreazione, nomefile) --TODO: mettere a posto i nomi delle immagini
VALUES ('1', '../public/assets/img/default-pic.jpg'),
('2', '../public/assets/img/default-pic.jpg'),
('3', '../public/assets/img/default-pic.jpg');