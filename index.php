<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){        
        header('Location: login.php');
    }
    $_GET = null;
    $acao = 'read';    
    require('controller.php');

?>

<html>
	<head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Estudo Plan</title>

		<link rel="stylesheet" href="teste.css">
        <script>
            function deletar(id_post){
                window.location.href = 'controller.php?acao=deletar&id=' + id_post;
            }

            function validar(id_post){
                
                let tempo = document.getElementById('tempo' + id_post).value;
                if(tempo){
                    window.location.href = `controller.php?acao=adicionarTempo&id=${id_post}&tempo=${tempo}`; 
                }
                else{
                    erro(id_post);                    
                }
            }

            let update = (id) =>{
                let tempoPlanejado = document.getElementById("tempoPlanejadoValue" + id).value;
                let tempoEstudado = document.getElementById("tempoEstudadoValue" + id).value;
                console.log(id,tempoPlanejado,tempoEstudado);
                window.location.href = `controller.php?acao=update&id=${id}&tempoPlanejado=${tempoPlanejado}&tempoEstudado=${tempoEstudado}`;
            }

            function modelarUpdate(id){
                let planejado = document.getElementById("tempoPlanejado" + id);    
                let novoInput = document.createElement("input");
                novoInput.id = "tempoPlanejadoValue" + id
                novoInput.type = 'number';
                novoInput.min = 1;
                novoInput.value = parseInt(planejado.innerHTML);
                novoInput.style = "width: 95px; margin:0; padding:0;";                
                planejado.innerHTML = "";
                planejado.appendChild(novoInput);

                let estudado = document.getElementById("tempoEstudado" + id); 
                let novoInput2 = document.createElement("input");
                novoInput2.type = 'number';
                novoInput2.id = "tempoEstudadoValue" + id;
                novoInput2.min = 0;
                novoInput2.value = parseInt(estudado.innerHTML);
                novoInput2.style = "width: 95px; margin:0; padding:0;";  
                estudado.innerHTML = "";
                estudado.appendChild(novoInput2);

                let divRemover = document.getElementById("divRemover" + id);
                divRemover.innerHTML = "";

                let btnConfimar = document.createElement('input');
                btnConfimar.value = 'Confirmar';
                btnConfimar.id = 'confirmar' + id;
                btnConfimar.className = 'adicionar';
                btnConfimar.type = 'button';
                btnConfimar.onclick = ()=>{
                    update(id)
                };
                document.getElementById("divRemover" + id).appendChild(btnConfimar); 
            }

            function erro(id_post){
                if(!document.getElementById('existe')){
                        let span = document.createElement('span');
                        span.id = 'existe';
                        span.innerHTML = 'Tempo não pode ser vazio';
                        span.style = 'color:red;display:inline-block; margin-top: -30px;';
                        document.getElementById(id_post).appendChild(span);
                    }
            }
        </script>
	</head>

	<body>
		<div class=" sticky-top bg-info justify-content-center" id='topo'>
            <span class="d-block pl-2">Estudo Plan</span>
            <div class="btn-group" id='menu'>
                    <ul>
                        <li>
                            <a class="h-100 btn btn-lg bt-outline-info" href="#">Home</a>
                        </li>
                        <li>
                            <a class="h-100 btn btn-lg bt-outline-info" href="adicionar.php">Adicionar</a>
                        </li>
                        <li>
                            <a class="h-100 btn btn-lg bt-outline-info" href="login.php">Sair</a>
                        </li>
                    </ul>
                </div>
        </div>
        <div id='body'>
            <div id='container'>   
                <?if($posts){?>
                    <? foreach ($posts as $post){ ?>
                        <div class='conteudo'>
                            <div class='topo-conteudo'>
                                <span class = "text-truncate"><?=$post->titulo?></span>

                                <button value=<?=$post->id_post?> onclick="deletar(value)"></button>
                            </div>
                            <div class='corpo-conteudo'>
                                <div id=<?=$post->id_post?> style="text-align:center;">
                                    <span>Tempo Planejado : </span><span value=<?=$post->tempo_planejado?> id=<?="'tempoPlanejado" .$post->id_post ."'" ?>><?=' ' . $post->tempo_planejado?> </span> min<br>
                                    <span>Tempo Estudado  : </span><span value=<?=$post->tempo_estudado?> id=<?="'tempoEstudado" .$post->id_post ."'" ?>><?=' ' . $post->tempo_estudado?> </span> min<br>
                                    <div id=<?="'divRemover" .$post->id_post ."'" ?>>
                                        <?if(($post->tempo_planejado-$post->tempo_estudado)<=0){?>
                                                <span style='color:green; font-size=1.2em;'>Concluído</span><br> 
                                        <?}else{?>
                                            <span class='final'>Tempo Faltando  : </span><?=' ' . ($post->tempo_planejado-$post->tempo_estudado)?> min<br>  
                                            <input class='small' id=<?='tempo'.$post->id_post?> type='number' min=1>
                                            <button onclick='validar(value)' value=<?=$post->id_post?> class='adicionar'>Adicionar Tempo</button>
                                            <button onclick='modelarUpdate(value)' value=<?=$post->id_post?> class='adicionar'>CF</button>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?}?>
                <?}else{?>
                    <button onclick='window.location.href = "adicionar.php"' class='adicionar bt-grande'>Adicione uma tarefa aqui!</button>
                <?}?>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>