<?php

	require "tarefa.model.php";
	require "tarefa.service.php";
	require "conexao.php";

 
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if($acao == 'inserir'){

		$tarefa = new Tarefa();
		$tarefa->__set('tarefa',$_POST['tarefa']);

		$conexao = new Conexao();

		$tarefa_service = new TarefaService($conexao,$tarefa);

		$tarefa_service->inserir();

		header('Location: nova_tarefa.php?inclusao=1');

	}else if($acao == 'recuperar'){
		
		$conexao = new Conexao();
		$tarefa = new Tarefa();

		$tarefa_service = new TarefaService($conexao,$tarefa);
		$retorno_tarefas = $tarefa_service->recuperar();

	} else if($acao == 'atualizar'){
		
		$tarefa = new Tarefa();
		$tarefa->__set('id',$_POST['id']);
		$tarefa->__set('tarefa',$_POST['tarefa']);


		$conexao = new Conexao();

		$tarefa_service = new TarefaService($conexao,$tarefa);

		if($tarefa_service->atualizar()){

			if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
				header('Location:index.php');
			}else{
				header('Location:todas_tarefas.php');
			}
			
		};

	} else if($acao == 'remover'){

		$tarefa = new Tarefa();
		$tarefa->__set('id',$_GET['id']);

		$conexao = new Conexao();

		$tarefa_service = new TarefaService($conexao,$tarefa);
		$tarefa_service->remover();

		if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
				header('Location:index.php');
			}else{
				header('Location:todas_tarefas.php');
			}

	} else if($acao == 'marcar_realizada'){

		$tarefa = new Tarefa();
		$tarefa->__set('id',$_GET['id']);
		$tarefa->__set('id_status', 2);

		$conexao = new Conexao();

		$tarefa_service = new TarefaService($conexao,$tarefa);

		$tarefa_service->marcarRealizado();

		if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
				header('Location:index.php');
			}else{
				header('Location:todas_tarefas.php');
			}

	}else if($acao == 'recuperar_pendente'){

		$tarefa = new Tarefa();
		$tarefa->__set('id_status',1);

		$conexao = new Conexao();

		$tarefa_service = new TarefaService($conexao,$tarefa);
		$retorno_tarefas_pendentes = $tarefa_service->recuperarPendentes();

	}


?>