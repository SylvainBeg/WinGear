INSERT INTO `t_article` (`art_id`, `art_title`, `art_content`, `art_image`, `art_price`, `categorie`) VALUES
(1, 'Sac tennis', 'Sac Pouvant transporter juqu''à 6 raquettes de tennis ! Idéal pour sportif confirmer','bag1.jpg',65,3),
(2, 'Résine blanche PROMO',' 5 pots de résine Blanche avec spray anti colle offert profitez en dès maintenant !','colle.jpg',35,1),
(3, 'Chaussure nike',' Chaussure nike édition 2013/2014, utilisé par Neymar et bien d''autre','foot.jpg',90,2),
(4, 'Ballon Tricolor', 'Le nouveau ballon tricolore : idéal pour soutenir l''équipe national tout ne gagnant vos matchs ! :)', 'article1.png', 30, 1),
(5, 'ballon handball 2', 'Ce ballon est idéal pour les entraînements.', 'article3.jpg', 20.5, 1),
(6, 'Ballon de foot basique', 'Le ballon idéal pour amuser vos enfants.', '4545564.jpg', 7.5, 2),
(7, 'Chaussure Nike','NOUVELLE COLLECTION : fan de ZLATAN ? alors commandez !' ,'foot2.jpg', 110,2),
(8, 'Mizuko 2016','Nouvelle collection Mizuko Handball extra confort','handchauss.jpg',75,1),
(9, 'Balle Kronum', 'Fan de ce nouveau sport ? Achater dès maintenant votre ballon Kronum','kronum.jpg',15,4),
(10, 'Raquette Wilson', 'Federer l''a adopté pourquoi pas vous? ','tennis1.jpg',50,3),
(11, 'Volant à plume', 'Bientôt pro de Badminton ? Adopter pour les volants à plus, beaucoup plus rapide : lot de 10 volants','volant.jpg',25,6);


INSERT INTO `t_categorie` (`cate_id`, `cate_name`) VALUES
(1, 'Handball'),
(2, 'Football'),
(3, 'Tennis'),
(4, 'Kronum'),
(5, 'Badminton');
/* raw password is 'john' */
INSERT INTO `t_user` (`usr_id`, `usr_name`, `usr_password`, `usr_salt`, `usr_role`, `usr_nom`, `usr_prenom`, `usr_email`) VALUES
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER', '', '', ''),
(3, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN', '', '', ''),
(4, 'lalalal', '/UpdrnYIht8rfVnxQEhdNOMwk7/cafQlDTEclldY2HNvkoMSjCPe/fBXCZZHvC7DWQHa/NpqfDhuqaU4EjS4gQ==', '00798e8c1235f89307e26e8', 'ROLE_USER', 'pierre', 'paul', '@');

INSERT INTO `t_comment` (`com_id`, `com_content`, `art_id`, `usr_id`) VALUES
(1, 'J''adoooore ! :)', 6, 3),
(2, 'mm', 5, 3);

