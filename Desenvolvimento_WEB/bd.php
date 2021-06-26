<?php

class BD
{
	public $pdo;

	function __construct()
	{
		try 
		{	
			$this->pdo = new PDO("mysql:host=localhost;dbname=restauranteprova","root",""); 
		
		} catch(PDOException $e)
		{
			die('Nao foi possivel realizar a conexao com o Banco de Dados!!!');
		}		
	} // construct

} // class Bd

