USE memed;
INSERT INTO users (
        Username,
        Email,
        Password,
        PasswordSalt,
        FileName,
        Bio
    )
VALUES (
        'user1',
        'user1@gmail.com',
        '7f8cca32a45c91f1d25cb92cc4ee7c3c06610e74e12029cc5dd9d5188820e94e672adb6008c480b7f3116bcbd6c4f0e490f4dab39894dbdd257679d49a1b31d2',
        '546222fa0a5e84fa68b8b7a9bdec8547c068e7d87dfc9f8d5ffc45ba7da585481c33a95e766b5869e40afd9792bbb4e49c07e74551b4363e26881b78dddf32d3',
        'default-pic.png',
        'ciao sono user1, seguimi se vuoi pessimi meme, ho una bio molto lunga, bla bla bla. ho degli amici? bho, chissà. devo occupare un po di spazio per vedere come si comporta la pagina di profilo, quindi scrivo ancora un po di roba'
    ),
    (
        'user2',
        'user2@gmail.com',
        'd46caee34f7912e024a86041a6461d7b631a11d4f14b679d9dc2a979e2fc4a628fd5d723a8320b2946e58d3a993fb6fa3290fb386ef4a15e2f0a8c425382870c',
        '3d125da9c9acc2e412603a3850b537e457f6dd403d94090d22fd71342f9f596a5a24f69071d00779320f5d2180ed5f0cc0790f649d3142f8f83e014a57f771eb',
        'default-pic.png',
        'ciao sono user2, sono simpatico :)'
    ),
    (
        'user3',
        'user3@gmail.com',
        '397a4bbfb4f304b1c57a520f950bdcbfc3268bbddd77ca62e2a1f224e960a5ef0e9ae0ea678dc2218824ad220a4892f97425edd82b492bdb3f9d7cd20f74e617',
        '5a178de7206034fd04538f172226d119cc53c23a78af357d8dadd4004a8be66a26875a8661fc28fb37a75b6f1858ca0394002ee40666b94e917cef7f96a368a8',
        'default-pic.png',
        'ciao sono user3'
    ),
    (
        'user4',
        'user4@gmail.com',
        '6e8d73e68cfb50dca59a92304beb463ec8d7efac26cc74548474480f13b2a8f6ab76c4d41d2308c56c283aabb2c1bbd0dd39eec5522592b5a47b0cd4df3ad6bc',
        '911bf0398dc1c43e00f947065d00f280967d28a3fb4b1a9a7cea7c355d5ceb746450039b251b37a3370888a0d51cfbbdc87a73bd7681630e9b6cc8b74b0bef34',
        'default-pic.png',
        'ciao sono user4, non sono bravo in js'
    ),
    (
        'user5',
        'user5@gmail.com',
        '71b830f9fb889d2225e27993116a539e5efddeb544b353e4e0749d65c0e5862e138291607a32a523769b28e4bfc7c4208e15d55b77284ec7263443c94a2d7c86',
        '8fdd5440c0f7fbd4904544c719645003a78989ea28a45a622cd9ade91af844114177455cf094bc2f140d20f1979d60508c1f82e5f361e8630a153b8b15cef66a',
        'default-pic.png',
        'ciao sono user5, <3 <3 <3'
    );
INSERT INTO posts (
        FileName,
        TextContent,
        DateAndTime,
        Username
    )
VALUES (
        '',
        'Che cosa hanno in comune un televisore e una formica? Le antenne!',
        '2023-01-20 17:50:00',
        'user3'
    ),
    (
        '',
        'Qual è la città preferita dai ragni? Mosca!',
        '2023-01-25 20:23:00',
        'user4'
    ),
    (
        '',
        'Qual è la pianta più puzzolente? Quella dei piedi!',
        '2023-01-30 20:00:00',
        'user5'
    ),
    (
        '',
        'La maestra dice a un alunno: “Il tuo tema intitolato "Il mio cane" è uguale a quello di tuo fratello, l’hai copiato?” E lui: “No maestra, è che abbiamo lo stesso cane!”',
        '2023-02-05 20:00:00',
        'user1'
    ),
    (
        '',
        'Come si chiama un cane husky non particolarmente bello? Un husky-fezza...',
        '2023-02-07 22:00:00',
        'user2'
    ),
    (
        'lk8ikiq3yga61.png',
        '',
        '2023-02-09 11:27:37',
        'user5'
    ),
    (
        'browsers.jpg',
        'un meme divertente su internet explorer',
        '2023-02-09 11:56:15',
        'user4'
    ),
    (
        'WikiMeme_Dank.png',
        '',
        '2023-02-09 12:00:01',
        'user4'
    ),
    (
        'panel-1-1.png',
        '',
        '2023-02-10 10:05:01',
        'user3'
    ),
    (
        'fposter.png',
        '',
        '2023-02-11 10:35:01',
        'user1'
    ),
    (
        'when-people-dont-close-html-elements-meme.png',
        '',
        '2023-02-11 07:44:01',
        'user2'
    ),
    (
        'programmerhumor-io-php-memes-backend-memes-fad4153ca589774.png',
        '',
        '2023-02-11 16:05:01',
        'user1'
    ),
    (
        'php-morto.png',
        '',
        '2023-02-11 16:40:01',
        'user2'
    ),
    (
        '',
        'Qual è la pianta più puzzolente? Quella dei piedi!',
        '2023-02-12 07:12:00',
        'user4'
    );
INSERT INTO post_categories (PostID, CategoryID)
VALUES (1, 4),
    (3, 1),
    (3, 3),
    (4, 1),
    (4, 3),
    (5, 1),
    (1, 1),
    (2, 1),
    (7, 4),
    (8, 4),
    (9, 4),
    (10, 4),
    (11, 4),
    (12, 4),
    (13, 4),
    (14, 4),
    (1, 3),
    (2, 3);
INSERT INTO comments (
        PostID,
        Username,
        TextContent,
        DateAndTime
    )
VALUES (2, 'user5', 'wooww bello', '2023-02-09 10:46:54'),
    (
        1,
        'user5',
        'non fa ridere',
        '2023-02-09 11:46:54'
    ),
    (3, 'user5', 'ci sta', '2023-02-09 12:55:54'),
    (5, 'user5', 'spacca', '2023-02-09 14:46:54'),
    (
        6,
        'user5',
        'mi dai il tuo numero?',
        '2023-02-09 15:46:54'
    ),
    (7, 'user5', 'lol', '2023-02-09 16:46:54'),
    (8, 'user5', 'xD', '2023-02-09 17:46:54'),
    (
        4,
        'user5',
        'AHAHAHAHAHAHA',
        '2023-02-09 18:46:00'
    ),
    (9, 'user5', 'wow', '2023-02-10 18:46:54'),
    (
        11,
        'user2',
        'ma ahahahah',
        '2023-02-11 11:12:26'
    ),
    (
        13,
        'user4',
        'mi fai morire',
        '2023-02-11 11:14:26'
    ),
    (14, 'user1', 'pessimo', '2023-02-11 11:15:26'),
    (2, 'user2', 'bho ok', '2023-02-11 11:16:26'),
    (12, 'user3', 'ah.', '2023-02-11 19:13:26'),
    (
        10,
        'user1',
        'ahahhahahaha',
        '2023-02-12 11:11:26'
    ),
    (5, 'user4', 'rotolo', '2023-03-02 11:18:26'),
    (
        3,
        'user3',
        'lo conoscevo già, me lo raccontò un mio amico tanti anni fa',
        '2023-03-11 11:16:26'
    ),
    (
        10,
        'user2',
        'mi hai fatto morire',
        '2023-03-14 11:19:26'
    );
INSERT INTO post_reactions (ReactionID, Username, PostID)
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
    (5, 'user5', 9),
    (1, 'user1', 10),
    (1, 'user2', 10),
    (3, 'user3', 10),
    (4, 'user4', 10),
    (5, 'user5', 10),
    (1, 'user1', 11),
    (1, 'user2', 11),
    (3, 'user3', 11),
    (4, 'user4', 11),
    (5, 'user5', 11),
    (1, 'user1', 12),
    (1, 'user2', 12),
    (3, 'user3', 12),
    (4, 'user4', 12),
    (5, 'user5', 12),
    (1, 'user1', 13),
    (1, 'user2', 13),
    (3, 'user3', 13),
    (4, 'user4', 13),
    (5, 'user5', 13),
    (1, 'user1', 14),
    (1, 'user2', 14),
    (3, 'user3', 14),
    (4, 'user4', 14),
    (5, 'user5', 14),
    (1, 'user5', 9);
INSERT INTO follows (FollowedUsername, FollowerUsername)
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
INSERT INTO notifications (
        Username,
        Message,
        DateAndTime,
        `Read`
    )
VALUES (
        'user3',
        '<a href=\"user.php?username=user1\" class=\"fw-bold\">@user1</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user5',
        '<a href=\"user.php?username=user1\" class=\"fw-bold\">@user1</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user1',
        '<a href=\"user.php?username=user2\" class=\"fw-bold\">@user2</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user1',
        '<a href=\"user.php?username=user3\" class=\"fw-bold\">@user3</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user2',
        '<a href=\"user.php?username=user3\" class=\"fw-bold\">@user3</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user4',
        '<a href=\"user.php?username=user3\" class=\"fw-bold\">@user3</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user5',
        '<a href=\"user.php?username=user3\" class=\"fw-bold\">@user3</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user1',
        '<a href=\"user.php?username=user4\" class=\"fw-bold\">@user4</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user2',
        '<a href=\"user.php?username=user4\" class=\"fw-bold\">@user4</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user5',
        '<a href=\"user.php?username=user4\" class=\"fw-bold\">@user4</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user1',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user2',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha iniziato a seguirti.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user4',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user4#post-2\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-09 10:46:54',
        0
    ),
    (
        'user3',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user3#post-1\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-09 11:46:54',
        0
    ),
    (
        'user5',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user5#post-3\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-09 12:55:54',
        0
    ),
    (
        'user2',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user2#post-5\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-09 14:46:54',
        0
    ),
    (
        'user5',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user5#post-6\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-09 15:46:54',
        0
    ),
    (
        'user4',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user4#post-7\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-09 16:46:54',
        0
    ),
    (
        'user4',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user4#post-8\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-09 17:46:54',
        0
    ),
    (
        'user1',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user1#post-4\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-09 18:46:00',
        0
    ),
    (
        'user3',
        '<a href=\"user.php?username=user5\" class=\"fw-bold\">@user5</a> ha commentato un tuo <a href=\"user.php?username=user3#post-9\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-10 18:46:54',
        0
    ),
    (
        'user2',
        '<a href=\"user.php?username=user2\" class=\"fw-bold\">@user2</a> ha commentato un tuo <a href=\"user.php?username=user2#post-11\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-11 11:12:26',
        0
    ),
    (
        'user2',
        '<a href=\"user.php?username=user4\" class=\"fw-bold\">@user4</a> ha commentato un tuo <a href=\"user.php?username=user2#post-13\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-11 11:14:26',
        0
    ),
    (
        'user4',
        '<a href=\"user.php?username=user1\" class=\"fw-bold\">@user1</a> ha commentato un tuo <a href=\"user.php?username=user4#post-14\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-11 11:15:26',
        0
    ),
    (
        'user4',
        '<a href=\"user.php?username=user2\" class=\"fw-bold\">@user2</a> ha commentato un tuo <a href=\"user.php?username=user4#post-2\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-11 11:16:26',
        0
    ),
    (
        'user1',
        '<a href=\"user.php?username=user3\" class=\"fw-bold\">@user3</a> ha commentato un tuo <a href=\"user.php?username=user1#post-12\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-11 19:13:26',
        0
    ),
    (
        'user1',
        '<a href=\"user.php?username=user1\" class=\"fw-bold\">@user1</a> ha commentato un tuo <a href=\"user.php?username=user1#post-10\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-02-12 11:11:26',
        0
    ),
    (
        'user2',
        '<a href=\"user.php?username=user4\" class=\"fw-bold\">@user4</a> ha commentato un tuo <a href=\"user.php?username=user2#post-5\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-03-02 11:18:26',
        0
    ),
    (
        'user5',
        '<a href=\"user.php?username=user3\" class=\"fw-bold\">@user3</a> ha commentato un tuo <a href=\"user.php?username=user5#post-3\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-03-11 11:16:26',
        0
    ),
    (
        'user1',
        '<a href=\"user.php?username=user2\" class=\"fw-bold\">@user2</a> ha commentato un tuo <a href=\"user.php?username=user1#post-10\" class=\"fw-bold fst-italic\">post</a>.',
        '2023-03-14 11:19:26',
        0
    );
INSERT INTO saved_posts(PostID, Username)
VALUES(1, 'user2'),
    (7, 'user1'),
    (7, 'user3'),
    (8, 'user5'),
    (8, 'user1'),
    (9, 'user3'),
    (9, 'user2'),
    (10, 'user4'),
    (10, 'user5'),
    (11, 'user4'),
    (12, 'user1'),
    (13, 'user5'),
    (14, 'user3'),
    (14, 'user4');