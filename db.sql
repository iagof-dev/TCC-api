create database if not exists SGDB;
use SGDB;

create table if not exists alunos(
rm int(6) primary key auto_increment,
nome mediumtext not null,
ano int(2) not null,
curso tinytext not null,
telefone char(11) not null unique
);

create table if not exists bibliotecarias(
id int auto_increment primary key,
nome tinytext
);

create table if not exists livros(
id int primary key auto_increment,
codigo int(32) not null unique,
titulo mediumtext not null,
autor mediumtext not null,
capa varchar(1),
volumes int not null,
sinopse text not null
);

create table if not exists generos(
id int primary key auto_increment,
tipo tinytext not null
);

create table if not exists livro_generos(
id_livro int not null,
id_genero int not null,
foreign key (id_livro) REFERENCES livros(id),
foreign key (id_genero) REFERENCES generos(id)
);

create table if not exists emprestimos(
id int auto_increment primary key,
id_aluno int not null,
id_livro int not null,
data_aluguel date not null,
data_devolucao date not null,
status_livro varchar(20) not null,
foreign key (id_aluno) references alunos(rm),
foreign key (id_livro) references livros(id)
);

create table if not exists c_logs(
id int auto_increment primary key,
autor text not null,
acao tinytext not null,
sujeito tinytext,
data datetime not null
);