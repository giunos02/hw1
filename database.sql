Create DATABASE iscritti;
USE iscritti;

CREATE TABLE users (
    id integer primary key auto_increment,
	username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
) Engine = InnoDB;

CREATE TABLE songs (
    id integer primary key auto_increment,
    user_id integer not null,
    foreign key (user_id) references users(id),
    song_id varchar(255),
    content json
) Engine = InnoDB;

create table Argomenti(
ID_arg int primary key auto_increment,
Titolo Varchar(100),
Contenuto longtext,
ID_User varchar(50) references users(username),
Data_Pubblicazione varchar(50),
Tag varchar(45)
);

create table Likes(
ID_Like int primary key auto_increment,
ID_argomento int references Argomenti(ID_Arg),
ID_User varchar(50) references users(username)
);

create table Commenti(
ID_Comm int primary key auto_increment,
ID_argomento int references Argomenti(ID_Arg),
ID_User varchar(50) references users(username),
Commento mediumtext,
orario varchar(50)
);

DELIMITER $$
CREATE TRIGGER argomenti_AFTER_DELETE AFTER DELETE ON argomenti FOR EACH ROW
BEGIN
Delete from likes where (ID_argomento=old.ID_arg);
Delete from commenti where (ID_argomento=old.ID_arg);
END
$$
DELIMITER ;

select * from users;
select * from songs;
select * from argomenti;
