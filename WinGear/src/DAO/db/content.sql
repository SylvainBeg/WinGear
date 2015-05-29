INSERT INTO `t_article` (`art_id`, `art_title`, `art_content`, `art_image`, `art_price`, `categorie`) VALUES
(1, 'First article', 'Hi there! This is the very first article.', 'article1.png', 28.5, 0),
(2, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut hendrerit mauris ac porttitor accumsan. Nunc vitae pulvinar odio, auctor interdum dolor. Aenean sodales dui quis metus iaculis, hendrerit vulputate lorem vestibulum. Suspendisse pulvinar, purus at euismod semper, nulla orci pulvinar massa, ac placerat nisi urna eu tellus. Fusce dapibus rutrum diam et dictum. Sed tellus ipsum, ullamcorper at consectetur vitae, gravida vel sem. Vestibulum pellentesque tortor et elit posuere vulputate. Sed et volutpat nunc. Praesent nec accumsan nisi, in hendrerit nibh. In ipsum mi, fermentum et eleifend eget, eleifend vitae libero. Phasellus in magna tempor diam consequat posuere eu eget urna. Fusce varius nulla dolor, vel semper dui accumsan vitae. Sed eget risus neque.', 'article2.jpg', 18.1, 0),
(3, 'Lorem ipsum in french', 'J’en dis autant de ceux qui, par mollesse d’esprit, c’est-à-dire par la crainte de la peine et de la douleur, manquent aux devoirs de la vie. Et il est très facile de rendre raison de ce que j’avance. Car, lorsque nous sommes tout à fait libres, et que rien ne nous empêche de faire ce qui peut nous donner le plus de plaisir, nous pouvons nous livrer entièrement à la volupté et chasser toute sorte de douleur ; mais, dans les temps destinés aux devoirs de la société ou à la nécessité des affaires, souvent il faut faire divorce avec la volupté, et ne se point refuser à la peine. La règle que suit en cela un homme sage, c’est de renoncer à de légères voluptés pour en avoir de plus grandes, et de savoir supporter des douleurs légères pour en éviter de plus fâcheuses.', 'article3.jpg', 10.35, 0),
(4, 'Ballon Tricolor', 'Le nouveau ballon tricolore : idéal pour soutenir l''équipe national tout ne gagnant vos matchs ! :)', 'article1.png', 30, 1),
(5, 'ballon handball 2', 'Ce ballon est idéal pour les entraînements.', 'article3.jpg', 20.5, 1),
(6, 'Ballon de foot basique', 'Le ballon idéal pour amuser vos enfants.', '4545564.jpg', 7.5, 2);

INSERT INTO `t_categorie` (`cate_id`, `cate_name`) VALUES
(1, 'Handball'),
(2, 'Football'),
(3, 'Tennis');
/* raw password is 'john' */
INSERT INTO `t_user` (`usr_id`, `usr_name`, `usr_password`, `usr_salt`, `usr_role`, `usr_nom`, `usr_prenom`, `usr_email`) VALUES
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER', '', '', ''),
(3, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN', '', '', ''),
(4, 'lalalal', '/UpdrnYIht8rfVnxQEhdNOMwk7/cafQlDTEclldY2HNvkoMSjCPe/fBXCZZHvC7DWQHa/NpqfDhuqaU4EjS4gQ==', '00798e8c1235f89307e26e8', 'ROLE_USER', 'pierre', 'paul', '@');

INSERT INTO `t_comment` (`com_id`, `com_content`, `art_id`, `usr_id`) VALUES
(1, 'J''adoooore ! :)', 6, 3),
(2, 'mm', 5, 3);

INSERT INTO t_panier ( pan_usr, pan_art, pan_quant) Values
(5,2,1);