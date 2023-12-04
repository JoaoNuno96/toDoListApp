<?php

//CRIAR TAREFAS -- MESMAS COLUNAS QUE A TABELA DA BASE DE DADOS
class Tarefa{
	private $id;
	private $id_status; 
	private $tarefa;
	private $data_cadastro;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($a,$v){
		$this->$a = $v;
	}
}



?>