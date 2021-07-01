use master 
go

create database restaurante2021
go


use restaurante2021;


create table cidades (
	cod_cidade int not null identity(1,1) primary key,
	nome varchar (100) not null,
	uf char (2) not null default 'SP'
);

alter table cidades add cep_padrao char(8);

create table clientes (
	cod_cliente int not null identity(1,1),
	nome varchar(100) not null,
	endereco varchar(150),
	bairro varchar(60),
	cod_cidade int foreign key references cidades (cod_cidade),
	cep char(8),
	cpf char(11),
	rg char(16),
	telefone char(11),
	email varchar(100),
	constraint pk_cli primary key (cod_cliente)
);

create table unidades (
	cod_unidade int not null identity(1,1) primary key,
	descricao varchar(100) not null,
	sigla char(5) not null
);

create table ingredientes (
	cod_ingrediente int not null identity(1,1) primary key,
	descricao varchar(100) not null,
	valor_unitario float default 0,
	cod_unidade int not null,
	constraint fk_ing_unid foreign key (cod_unidade) references unidades (cod_unidade)
);

create table pratos (
	cod_prato int not null identity(1,1) primary key,
	descricao varchar(100) not null,
	valor_unitario float default 0
);

create table composicao (
	cod_prato int not null foreign key references pratos (cod_prato),
	cod_ingrediente int not null foreign key references ingredientes (cod_ingrediente),
	quantidade float not null,
	constraint pk_comp primary key (cod_prato, cod_ingrediente)
);

create table encomendas (
	cod_encomenda int not null identity(1,1) primary key,
	cod_cliente int not null foreign key references clientes (cod_cliente),
	data datetime not null default GetDate(),
	valor_total float default 0
);
create table itens_encomenda (
	cod_item_encomenda int not null identity(1,1) primary key,
	cod_encomenda int not null foreign key references encomendas (cod_encomenda),
	cod_prato int not null foreign key references pratos (cod_prato),
	quantidade float not null,
	valor_unitario float not null
);

create table fornecedores (
	cod_fornecedor int not null identity(1,1) primary key,
	nome_fantasia varchar(100) not null,
	razao_social varchar(100) not null,
	endereco varchar(150),
	bairro varchar(60),
	cod_cidade int foreign key references cidades (cod_cidade),
	cep char(8),
	cnpj char(16) not null,
	inscricao_estadual char(20),
	telefone char(11),
	email varchar(100),
	celular char(11)
);

create table compras (
	cod_compra int not null identity(1,1) primary key,
	num_nota_fiscal int not null,
	data datetime not null,
	cod_fornecedor int not null foreign key references fornecedores (cod_fornecedor),
	valor_total float default 0
);

create table itens_compra (
	cod_item_compra int not null identity(1,1) primary key,
	cod_compra int not null foreign key references compras (cod_compra),
	cod_ingrediente int not null foreign key references ingredientes (cod_ingrediente),
	quantidade float not null,
	valor_unitario float not null
);