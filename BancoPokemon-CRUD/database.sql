drop database if exists pokemon;

create database pokemon
    default character set utf8
    collate utf8_unicode_ci;

use pokemon;

create table pokemon (
    id bigint(20) not null auto_increment primary key,
    name varchar(100) not null unique,
    type varchar(50) not null,
    weight decimal(5,2) not null,
    height decimal(5,2) not null,
    evolution int not null default 0
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

drop user if exists 'newuser'@'localhost';
create user 'newuser'@'localhost'
    identified by 'root';

grant all
    on pokemon.*
    to 'pokemonuser'@'localhost';

flush privileges;