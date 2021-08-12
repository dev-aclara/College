use master 
go

create database cc_subqueries 
go

use cc_subqueries 
go

create table cidades (
	cod_cidade int not null identity(1,1),
	nome varchar(100) not null,
	uf char(2) not null,
	primary key (cod_cidade)
);

create table cargos (
	cod_cargo int not null identity(1,1),
	descricao varchar(100) not null,
	salario float default 0,
	primary key (cod_cargo)
);



create table FUNCIONARIOS (
	Cod_func  int not null identity(1,1) primary key ,
	Nome  varchar(100) not null,
	Endereco varchar(100),
	Cod_cidade int foreign key references cidades (cod_cidade),
	Cep char(9),
	Rg char(20),
	Cpf char(11),
	Data_admissao datetime,
	Data_nasc datetime,
	Cod_cargo int foreign key references cargos (cod_cargo)
);	
	
create table PAGAMENTOS (
	Ano smallint not null ,
	mes smallint not null ,
	Cod_func int not null foreign key references funcionarios (cod_func),
	Valor_liquido float default 0,
	primary key (ano, mes, cod_func)
);

-------------------------------------------------------------------------------
insert into cargos (descricao) values 
('Gerente'),
('Analista de Sistemas'),
('Analista de Suporte'),
('Programador'),
('Administrador de Banco de Dados');

insert into cidades (nome, uf) values 
('Adamantina','SP'),
('Luc�lia','SP'),
('Londrina','PR'),
('Uberl�ndia','MG'),
('Vit�ria','SE'),
('Bauru','SP');

insert into funcionarios (nome, cod_cidade, cod_cargo) values
('Caio',2,4),
('Andr� Mendes',1,1),
('Bruno',null,2),
('Junin',6,4),
('Cl�udio',6,null);

--------------------------------
--Exerc�cios Subquery --


-- Listar todas as cidades que n�o possuem funcion�rios relacionados utilizando subquery junto com o perador IN
select * from cidades as ci WHERE cod_cidade not in (select distinct isnull(cod_cidade,0) from funcionarios)

-- Listar todas as cidades que possuem funcion�rios relacionados utilizando subquery junto com o perador IN
select * from cidades as ci WHERE cod_cidade in (select distinct cod_cidade from funcionarios)

-- Listar todas as cidades que n�o possuem funcion�rios relacionados utilizando subquery junto com o perador EXISTS
select * from cidades as ci where not exists (select cod_cidade from funcionarios as fun where fun.cod_cidade = ci.cod_cidade)

-- Listar todas as cidades que possuem funcion�rios relacionados utilizando subquery junto com o perador EXISTS
select * from cidades as ci where exists (select cod_cidade from funcionarios as fun where fun.cod_cidade = ci.cod_cidade)

-- Listar todos os cargos que est�o relacionados com funcion�rios utilizando uma subquery que retorne o resultado de um count(*)
select	ci.*,
		(select count(*) from funcionarios as fun where fun.cod_cidade = ci.cod_cidade) as total_funcionarios
from cidades as ci
where (select count(*) from funcionarios as fun where fun.cod_cidade = ci.cod_cidade) = 0

-- Listar o nome do funcion�rio, cargo e sal�rio utilizando a cl�usula where
select	f.nome, 
		f. cod_cargo, 
		c.salario
from funcionarios as f, cargos as c
where f.cod_func = c.cod_cargo
order by f.nome

-- Listar o nome do funcion�rio, cargo e sal�rio utilizando a cl�usula inner join
select	f.nome, 
		f. cod_cargo, 
		c.salario

from funcionarios as f 
		inner join cargos as c on (f.cod_func = c.cod_cargo)
order by f.nome

-- Listar o nome do funcion�rio, cargo e sal�rio utilizando subquery
select	cod_cargo, 
		salario,
		-- subquery para "buscar" o nome do funcion�rio dos respectivas cargos
		(select nome from funcionarios f where f.cod_func = c.cod_cargo) as nome_funcionario
from	cargos c

-- Apagar as cidades que n�o est�o relacionadas com funcion�rios
delete
from cidades 
where not exists (select cod_func from funcionarios where cod_cidade = cidades.cod_cidade)

--Testando 
select * from cidades




