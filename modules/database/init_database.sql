USE `memed`;
INSERT INTO `utenti` (
        `username`,
        `email`,
        `password`,
        `salt`,
        `nomefile`,
        `bio`
    )
VALUES (
        'user1',
        'user1@gmail.com',
        '99e16d687137a7dc86e5cd47e421d49b9d1299469281656fd96c754eae8f592b14996723944213ca4f0c73ef0907ee44e61d0045942baf48ab7d749dd93fb132',
        '162716358baf657f8e3d6891d9177d946c2a4561a39a6366d9cf488b179729c7c29f427b0776503184d89afdec838f814bb3f8d0da595d6b4515d6fb68265b59',
        'default-pic.png',
        'Bio di user1, testo di prova'
    ),
    (
        'user2',
        'user2@gmail.com',
        '2a468f7ad9b66f97ac7c79126e446494791b3031f2db5d37c67d3c2c9f5c782f27905b0c97087279e559b8bd58a2cc259a46a5580ef9d7b54f91b1a03a28b86e',
        '2313594e53f175b8a409de325cfd96a23f6ec4a246c7189e32db16f6bb2a9453a412ea8003e0823d29ec856c72fe982ec673221dddcdd2a572340741e784f691',
        'default-pic.png',
        'Bio di user2, testo di prova'
    ),
    (
        'user3',
        'user3@gmail.com',
        '7797e22cd2c28da9e19bfae5c341019fe246e0a9010f6027b0a81e3b7d25052462c0669d0d513e4b4c02eebfec52d5d847b8c4873e33f796193672020edc88ac',
        '9d0d455a9210d5117b646083ce6efbd6d1e739da65164f22608bdc635b652063cece95f3466cba79c9195c253898c8cd72fec481ea49049a400a8641da68c3d2',
        'default-pic.png',
        'Bio di user3, testo di prova'
    ),
    (
        'user4',
        'user4@gmail.com',
        '3e0e7fbd85491d422601747de903e2f9f2895ac0b8f543fb7f5faddf614c47bf64a1bde32305c707ee7935c74a71051d073f0e3a130068b8461eee49564cc088',
        'c4451f2682bbdb7804ede8129f4fa4f328e7050b0860d94e51bc91f7930bc4711af6846a6e0f3195bfc1ce1ddac84be2775d1a09f2dcca70ac936a251f165a19',
        'default-pic.png',
        ''
    ),
    (
        'user5',
        'user5@gmail.com',
        '46885100f776e476732d1ec28eaf9d2d0543e3c2a4ea69eb21b6d7e3bf889a3e045294d4c57a3a247fd4b9fe4f9226da6cd5a952bbeca1c04273993cc3726646',
        '81e5b6a9b12de8c7057c77e229a2a0923b83adeb6c982bbe293237a1d43584d208de4b9dd24f6550dfea2b4e36fc807df6559a8a5f5576d3b405b0b9a995b72a',
        'default-pic.png',
        ''
    );
INSERT INTO `post` (
        `idpost`,
        `nomefile`,
        `testo`,
        `data`,
        `username`
    )
VALUES (
        1,
        'default-pic.png',
        '',
        '2023-12-10 20:00:00',
        'user1'
    ),
    (
        2,
        '',
        'Testo di prova del post',
        '2023-12-10 20:00:00',
        'user2'
    ),
    (
        3,
        '',
        'Che cosa hanno in comune un televisore e una formica? Le antenne!',
        '2023-01-20 20:00:00',
        'user3'
    ),
    (
        4,
        '',
        'Qual è la città preferita dai ragni? Mosca!',
        '2023-01-25 20:00:00',
        'user4'
    ),
    (
        5,
        '',
        'Qual è la pianta più puzzolente? Quella dei piedi!',
        '2023-01-25 20:00:00',
        'user4'
    ),
    (
        6,
        '',
        'Qual è la pianta più puzzolente? Quella dei piedi!',
        '2023-01-30 20:00:00',
        'user5'
    ),
    (
        7,
        'lk8ikiq3yga61.png',
        '',
        '2023-02-09 11:27:37',
        'user5'
    ),
    (
        8,
        'browsers.jpg',
        '',
        '2023-02-09 11:56:15',
        'user4'
    ),
    (
        9,
        'browsers_2.jpg',
        '',
        '2023-02-09 12:00:01',
        'user4'
    );
INSERT INTO `categoria_post` (`idpost`, `idcategoria`)
VALUES (1, 4),
    (3, 1),
    (3, 3),
    (4, 1),
    (4, 3),
    (5, 1),
    (6, 1),
    (6, 3);
INSERT INTO `commento` (
        `idpost`,
        `username`,
        `idcommento`,
        `testo`,
        `data`
    )
VALUES (2, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (1, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (3, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (4, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (5, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (6, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (7, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (8, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (9, 'user5', 1, 'wow', '2023-02-09 10:46:54'),
    (2, 'user5', 2, 'ggg', '2023-02-09 11:19:26');
INSERT INTO `reazione_pu` (`idreazione`, `username`, `idpost`)
VALUES (5, 'user1', 1),
    (5, 'user2', 1),
    (3, 'user3', 1),
    (4, 'user4', 1),
    (5, 'user5', 1),
    (4, 'user1', 2),
    (2, 'user2', 2),
    (3, 'user3', 2),
    (4, 'user4', 2),
    (5, 'user5', 2),
    (3, 'user1', 3),
    (3, 'user2', 3),
    (3, 'user3', 3),
    (4, 'user4', 3),
    (5, 'user5', 3),
    (5, 'user1', 4),
    (5, 'user2', 4),
    (5, 'user3', 4),
    (4, 'user4', 4),
    (5, 'user5', 4),
    (1, 'user1', 5),
    (1, 'user2', 5),
    (1, 'user3', 5),
    (4, 'user4', 5),
    (5, 'user5', 5),
    (2, 'user1', 6),
    (2, 'user2', 6),
    (2, 'user3', 6),
    (4, 'user4', 6),
    (5, 'user5', 6),
    (5, 'user1', 7),
    (5, 'user2', 7),
    (5, 'user3', 7),
    (5, 'user4', 7),
    (5, 'user5', 7),
    (1, 'user1', 8),
    (3, 'user2', 8),
    (3, 'user3', 8),
    (2, 'user4', 8),
    (5, 'user5', 8),
    (1, 'user1', 9),
    (1, 'user2', 9),
    (3, 'user3', 9),
    (4, 'user4', 9),
    (1, 'user5', 9);
INSERT INTO `segue` (`Fol_username`, `username`)
VALUES ('user3', 'user1'),
    ('user5', 'user1'),
    ('user1', 'user2'),
    ('user1', 'user3'),
    ('user2', 'user3'),
    ('user4', 'user3'),
    ('user5', 'user3'),
    ('user1', 'user4'),
    ('user2', 'user4'),
    ('user5', 'user4'),
    ('user1', 'user5'),
    ('user2', 'user5');
INSERT INTO `notifica` (
        `username`,
        `idnotifica`,
        `mesaggio`,
        `data`,
        `letto`
    )
VALUES (
        'user2',
        1,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user1',
        2,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user3',
        3,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user4',
        4,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user4',
        5,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user1',
        6,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user4',
        7,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user1',
        8,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user3',
        9,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user2',
        10,
        '<a  href=\"user.php?username=\'user5\'\">\'user5\'</a> ha commentato un tuo post',
        '2023-02-09 11:19:26',
        0
    );