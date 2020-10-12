create database  freelancer;

create table cargos (

    cargo_id int not null primary key AUTO_INCREMENT ,
    cargo_nome varchar (100) not null

);
create table candidatos (

    candidato_id int not null PRIMARY key AUTO_INCREMENT,
    candidato_nome varchar (100) not null,
    candidato_salario float (4,2) not null,
    candidato_cargo int,
    
    FOREIGN key (candidato_cargo) REFERENCES cargos(cargo_id) ON DELETE CASCADE
    
);