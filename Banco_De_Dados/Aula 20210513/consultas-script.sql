use  restaurante2021;

-- inserindo dados
select * from cidades 

-- forma padr�o
insert into cidades (nome, uf, cep_padrao) values ('Adamantina','SP', '17800000')

-- forma padr�o II - a miss�o
insert into cidades (uf, nome, cep_padrao) values ('SP', 'Bastos', '17690000')

-- forma padr�o III - a vingan�a
insert into cidades (uf, nome) values ('SP', 'Dracena')

select * from cidades

-- inserindo sem informar alguns campos
insert into cidades (nome) values ('Hercul�ndia')


-- n�o pode inserir registros com campos n�o nulos sem inform�-los
insert into cidades (uf) values ('SP')

-- incluindo sem informar os campos
insert into cidades  values ('Tup�','SP','17600000')

insert into cidades values ('Maring�','PR','11222333')

insert into cidades values ('Londrina','PR','17600000')

insert into cidades values ('Uberl�ndia','MG','13200000')

select * from cidades order by nome
-- incluindo v�rios registros ao mesmo tempo

insert into cidades (nome, uf, cep_padrao) values
('Fl�rida Paulista','SP','1111'),
('Pacaembu','SP','2222'),
('Uberaba','MG','33333'),
('Sorocaba','SP','44444');

-- select * from cidades
-- inserindo a partir de um select 

-- Exemplo
create table cidades_de_sao_paulo (
	cod_cidade int,
	nome varchar(100),
	uf char(2)
)

-- select * from cidades_de_sao_paulo

-- Incluir na tabela cidades_de_sao_paulo, as cidades de SP da tab. cidades

insert into cidades_de_sao_paulo (cod_cidade, nome, uf) 	
	select cod_cidade, nome, uf
	from cidades
	where uf = 'sp'

-- select * from cidades_de_sao_paulo

select *
from cidades 
where uf ='sp'


-- visualizando os dados
select *
from cidades
order by nome 

-- ou
select *
from cidades
order by nome asc

-- ordem decrescente
select *
from cidades
order by nome desc

-- alterar o nome da cidade de c�digo 9
update cidades set 
		nome = 'BERL�ndia'
where cod_cidade = 9


-- ordenando por v�rios campos
select *
from cidades
order by uf, nome

-- ou
select *
from cidades
order by uf, nome desc

-- ou
select *
from cidades
order by uf desc, nome desc

-- ou
select *
from cidades
order by uf desc, nome 

-- alterando dados

update nome_da_tabela set
	campo1 = valor1,
	campo2 = valor2
where condi��o

-- select * from cidades

update cidades set
	cep_padrao = '17900000'
where cod_cidade = 3

-- select * from cidades where cep_padrao like '20%'

-- exemplo: Alterar todos os ceps das cidades que come�am com 17, 
-- vai passar a ser 20
update cidades set
	cep_padrao = '20' + SUBSTRING(cep_padrao,3,len(cep_padrao))
where cep_padrao like '17%'


-- alterando mais de um campo
update cidades set
	nome = 'Belo Horizonte',
	uf = 'MG',
	cep_padrao = '77777777'
where cod_cidade = 4
	
-- select * from cidades

-- excluindo registros
delete 
from nome_da_tabela 
where condi��es...

delete from cidades where cod_cidade = 2


-- exemplo: excluir todas as cidades do estado do Par�
delete from cidades where uf = 'PA'