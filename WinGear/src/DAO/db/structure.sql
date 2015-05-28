drop table if exists t_comment;
drop table if exists t_user;
drop table if exists t_article;
drop table if exists t_categorie;
drop table if exists t_panier;

create table t_article (
art_id integer not null primary key auto_increment,
art_title varchar(100) not null,
art_content varchar(2000) not null,
art_image varchar(100) not null,
art_price float not null,
categorie int(11) NOT NULL
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_user (
usr_id integer not null primary key auto_increment,
usr_name varchar(50) not null,
usr_password varchar(88) not null,
usr_salt varchar(23) not null,
usr_role varchar(50) not null,
usr_nom varchar(25)  NOT NULL,
usr_prenom varchar(25)  NOT NULL,
usr_email varchar(75)  NOT NULL,
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_comment (
com_id integer not null primary key auto_increment,
com_content varchar(500) not null,
art_id integer not null,
usr_id integer not null,
constraint fk_com_art foreign key(art_id) references t_article(art_id),
constraint fk_com_usr foreign key(usr_id) references t_user(usr_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_categorie(
cate_id integer not null primary key auto_increment,
cate_name varchar(100) not null
)engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_panier(
pan_usr integer not null,
pan_art integer not null,
pan_quant integer,
constraint fk_usr_id foreign key(pan_usr) references t_user( usr_id),
constraint fk_art_id foreign key(pan_art) references t_article(art_id)
)


