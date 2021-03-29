<?php
    require('conexao.php');
    require('servico.php');
    require('post.model.php');

    
    $acao = $_GET!=null? $_GET['acao'] : $acao;

    if($acao == 'read'){
        $service = new Servico($pdo,null);
        $posts = $service->read($_SESSION['id_usuario']);
    }
    else if($acao == 'deletar'){
        $service = new Servico($pdo,null);
        $posts = $service->deletar($_GET['id']);
        header('Location: http://losanoteste.rf.gd/');
    }
    else if($acao == 'logar'){
        $service = new Servico($pdo,null);
        $id = $service->readUsuarios($_GET['email'],$_GET['senha']);
        if($id==-1){
            header('Location: login.php?invalida=1');
        }
        else{
            session_start();
            $_SESSION['id_usuario'] = $id;
            header('Location: http://losanoteste.rf.gd/');
        }
    }
    else if($acao == 'novoLogin'){
        $service = new Servico($pdo,null);
        $id = $service->readUsuarios($_GET['email'],$_GET['senha']);
        if($id!=-1){
            header('Location: login.php?invalida=2');
        }
        else{
            $service->inserirEmail($email,$senha);
            header('Location: login.php');
        }
    }
    else if($acao == 'adicionarPost'){
        session_start();
        $post = new Post($_GET['titulo'],$_GET['tempo'],$_SESSION['id_usuario']);
        $service = new Servico($pdo,$post);
        $service->inserirPost();
        header('Location: adicionar.php?valido=1');
    }
    else if($acao == 'update'){
        $service = new Servico($pdo,null);
        $service->update($_GET['tempoPlanejado'],$_GET['tempoEstudado'],$_GET['id']);
        header('Location: http://losanoteste.rf.gd/');
    }
    else if($acao == 'adicionarTempo'){
        $service = new Servico($pdo,null);
        $service->adicionarTempo($_GET['id'],$_GET['tempo']);
        header('Location: http://losanoteste.rf.gd/');
    }
?>
