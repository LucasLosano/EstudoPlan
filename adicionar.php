<?php    
    session_start();
    if(!isset($_SESSION['id_usuario'])){        
        header('Location: login.php');
    }
?>

<html>
	<head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Estudo Plan</title>

		<link rel="stylesheet" href="teste.css">
        <script>
            function adicionar(){
                titulo = document.getElementById('titulo').value;
                tempo = document.getElementById('tempo').value;
                if(titulo && tempo){                    
                    window.location.href = `controller.php?acao=adicionarPost&titulo=${titulo}&tempo=${tempo}`; 
                }
                else{
                    erro();                    
                }
            }            
            

            function erro(){
                if(!document.getElementById('existe')){
                    if(document.getElementById('sucesso')){
                        document.getElementById('sucesso').remove();
                    }
                    let span = document.createElement('span');
                    span.id = 'existe';

                    span.innerHTML = 'Título e tempo não podem ser vazio.';
                    span.className = "text-danger d-inline-block"
                    document.getElementById('fieldset').appendChild(span);
                }
            }

            function sucesso(){                
                    let span = document.createElement('span');
                    span.id = 'sucesso';
                    span.innerHTML = 'Tarefa inserida com sucesso';
                    span.className = "text-success d-inline-block"
                    document.getElementById('fieldset').appendChild(span);
            }
            
            
        </script>
	</head>

	<body>
		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-info">
            <a style="font-size: 2.2em;" href="index.php" class="navbar-brand h1">Estudo Plan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li style="font-size: 1.5em;" class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li style="font-size: 1.5em;" class="nav-item active">
                            <a class="nav-link" href="#">Adicionar</a>
                        </li>
                        <li style="font-size: 1.5em;" class="nav-item">
                            <a class="nav-link" href="login.php">Sair<i class="d-inline-block ml-2 fas fa-sign-out-alt"></i></a>
                        </li>
                    </ul>
            </div>
        </nav>
        <div id='body'>
            <div id='container'>   
                <form class="px-3 py-2 border border-info">
                    <fieldset id='fieldset'>
                        <legend class="text-info">Insira uma tarefa</legend>
                        <div class="form-group">
                            <input class="form-control" type='text' id='titulo' placeholder='Título'>
                        </div>
                        <div class="form-group">
                            <input class='form-control' type='number' min='1' placeholder='Tempo Estimado' id='tempo' >
                        </div>
                        <input value='Adicionar' type='button' onclick='adicionar()' id='Adicionar' class='btn btn-info mb-0'><br>
                        <?if(isset($_GET["valido"]) && $_GET["valido"]){?>
                            <script>sucesso()</script>
                        <?}?>
                    </fieldset>
                 </form>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>