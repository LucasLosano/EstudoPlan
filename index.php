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
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
        <link rel="stylesheet" href="estilo.css">

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Estudo Plan</title>

        <script>
            $(document).ready(() => {
                $("input").on("keyup",e =>{
                    if(e.key == "Enter"){
                        let id = "#btn" + $(e.target).attr("id").replace('tempo','');
                        $(id).trigger("click");
                        console.log($(id))
                    }
                })
            })
 
        </script>
		
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
                window.location.href = `controller.php?acao=update&id=${id}&tempoPlanejado=${tempoPlanejado}&tempoEstudado=${tempoEstudado}`;
            }

            function modelarUpdate(id){
                let planejado = document.getElementById("tempoPlanejado" + id);    
                let novoInput = document.createElement("input");
                novoInput.id = "tempoPlanejadoValue" + id
                novoInput.type = 'number';
                novoInput.min = 1;
                novoInput.value = parseInt(planejado.innerHTML);
                novoInput.className = "d-inline w-25 p-0 m-0 form-control"              
                planejado.innerHTML = "";
                planejado.appendChild(novoInput);

                let estudado = document.getElementById("tempoEstudado" + id); 
                let novoInput2 = document.createElement("input");
                novoInput2.type = 'number';
                novoInput2.id = "tempoEstudadoValue" + id;
                novoInput2.min = 0;
                novoInput2.value = parseInt(estudado.innerHTML);
                novoInput2.className = "d-inline w-25 p-0 m-0 form-control"
                estudado.innerHTML = "";
                estudado.appendChild(novoInput2);

                let divRemover = document.getElementById("divRemover" + id);
                divRemover.innerHTML = "";

                let btnConfimar = document.createElement('input');
                btnConfimar.value = 'Confirmar';
                btnConfimar.id = 'confirmar' + id;
                btnConfimar.className = 'btn btn-secondary d-block mx-auto mt-5';
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
                        span.className = "text-danger d-inline-block mx-auto"
                        document.getElementById(id_post).appendChild(span);
                    }
            }
        </script>
	</head>

	<body>
		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-info">
            <a style="font-size: 2.2em;" href="#" class="navbar-brand h1">Estudo Plan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li style="font-size: 1.5em;" class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li style="font-size: 1.5em;" class="nav-item">
                            <a class="nav-link" href="adicionar.php">Adicionar</a>
                        </li>
                        <li style="font-size: 1.5em;" class="nav-item">
                            <a class="nav-link" href="calendario.php">Calendário</a>
                        </li>
                        <li style="font-size: 1.5em;" class="nav-item">
                            <a class="nav-link" href="login.php">Sair<i class="d-inline-block ml-2 fas fa-sign-out-alt"></i></a>
                        </li>
                    </ul>
            </div>
        </nav>
        <div id='body'>
            <div class="d-flex justify-content-center flex-wrap">   
                <?if($posts){?>
                    <? foreach ($posts as $post){ ?>
                        <div style="width:350px" class='card bg-info text-light m-2'>
                            <div class='card-body'>
                                <div class="d-flex mb-2">
                                    <h5 class = "d-inline card-title text-truncate"><?=$post->titulo?></h5>

                                    <button class="ml-auto d-inline-block btn btn-danger" value=<?=$post->id_post?> onclick="deletar(value)"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            
                            
                                <div class="p-2" id=<?=$post->id_post?>>
                                    <span>Tempo Planejado: </span><span value=<?=$post->tempo_planejado?> id=<?="'tempoPlanejado" .$post->id_post ."'" ?>><?=' ' . $post->tempo_planejado?> </span> min<br>
                                    <span>Tempo Estudado: </span><span value=<?=$post->tempo_estudado?> id=<?="'tempoEstudado" .$post->id_post ."'" ?>><?=' ' . $post->tempo_estudado?> </span> min<br>
                                    <div id=<?="'divRemover" .$post->id_post ."'" ?>>
                                        <?if(($post->tempo_planejado-$post->tempo_estudado)<=0){?>
                                                <span class="text-center font-weight-bold d-block mt-5 text-dark"'>Concluído</span><br> 
                                        <?}else{?>
                                            <span class='final d-block mb-3'>Tempo Faltando: <?=' ' . ($post->tempo_planejado-$post->tempo_estudado)?> min</span><br>  
                                            <div class="form-group  text-center mb-0">
                                                <input class='d-inline w-25 p-0 m-0 form-control' id=<?='tempo'.$post->id_post?> value=1 type='number' min=1>
                                                <button id=<?='btn'.$post->id_post?> onclick='validar(value)' value=<?=$post->id_post?> class='btn btn-secondary'>Adicionar Tempo</button>
                                                <button onclick='modelarUpdate(value)' value=<?=$post->id_post?> class='btn btn-secondary btn-sm'><i class="fas fa-cogs"></i></button>
                                            </div>
                                        <?}?>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?}?>
                <?}else{?>
                    <button onclick='window.location.href = "adicionar.php"' class='btn btn-info btn-lg btn-block'>Adicione uma tarefa aqui!</button>
                <?}?>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>