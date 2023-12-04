<?php


//TAREFA COM METODOS CRUD
class TarefaService{

	private $conexao;
	private $tarefa;

	public function __construct(Conexao $conexao, Tarefa $tarefa){
		$this->conexao = $conexao->conectar();
		$this->tarefa = $tarefa;
	}

	public function inserir(){ //CREATE

		$query = 'insert into tb_tarefas(tarefa)values(:tarefa)';

		$statement = $this->conexao->prepare($query);
		$statement->bindValue(':tarefa',$this->tarefa->__get('tarefa'));
		$statement->execute();

	}

	public function recuperar(){ //READ
		$query = '
			select 
				t.id, s.status, t.tarefa
			from 
				tb_tarefas as t
				left join tb_status as s on(t.id_status = s.id)
			';
		$statement = $this->conexao->prepare($query);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar(){ //UPDATE
		
		$query = '
			Update
				tb_tarefas
			Set
				tarefa = ?
			Where
				id = ?;
		';

		$statement = $this->conexao->prepare($query);
		$statement->bindValue(1,$this->tarefa->__get('tarefa'));
		$statement->bindValue(2,$this->tarefa->__get('id'));
		return $statement->execute();


	}

	public function remover(){ //DELETE

		$query = 'delete from tb_tarefas where id = :id';

		$smt = $this->conexao->prepare($query);
		$smt->bindValue(':id',$this->tarefa->__get('id'));
		$smt->execute();
		
	}

	public function marcarRealizado(){ //UPDATE
		
		$query = '
			Update
				tb_tarefas
			Set
				id_status = ?
			Where
				id = ?;
		';

		$statement = $this->conexao->prepare($query);
		$statement->bindValue(1,$this->tarefa->__get('id_status'));
		$statement->bindValue(2,$this->tarefa->__get('id'));
		return $statement->execute();


	}

	public function recuperarPendentes(){ //READ
		$query = '
			select 
				t.id, s.status, t.tarefa
			from 
				tb_tarefas as t
				left join tb_status as s on(t.id_status = s.id)
			where
				t.id_status = :id_status
			';
		$statement = $this->conexao->prepare($query);
		$statement->bindValue('id_status',$this->tarefa->__get('id_status'));

		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_OBJ);
	}


}

?>