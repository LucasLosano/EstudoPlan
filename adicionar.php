<?php    
    session_start();
    if(!isset($_SESSION['id_usuario'])){        
        header('Location: login.php');
    }
?>

<html>
	<head>
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
                    span.style = 'color:red;display:inline-block; margin-top: -30px;';
                    document.getElementById('fieldset').appendChild(span);
                }
            }

            function sucesso(){                
                    let span = document.createElement('span');
                    span.id = 'sucesso';
                    span.innerHTML = 'Tarefa inserida com sucesso';
                    span.style = 'color:green;display:inline-block; margin-top: -30px;';
                    document.getElementById('fieldset').appendChild(span);
            }
            
            
        </script>
	</head>

	<body>
		<div id='topo'>
            Estudo Plan
            <div id='menu'>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="#">Adicionar</a>
                        </li>
                        <li>
                            <a href="login.php">Sair</a>
                        </li>
                    </ul>
                </div>
        </div>
        <div id='body'>
            <div id='container'>   
                <form>
                    <fieldset id='fieldset'>
                        <legend>Insira uma tarefa</legend>
                        <label for='titulo'>Título </label>
                        <input type='text' id='titulo' placeholder='Título aqui...'><br>
                        <label for='tempo'>Tempo Estimado</label>
                        <input class='small' type='number' min='1'; id='tempo' ><br>
                        <input value='Entrar' type='button' onclick='adicionar()' id='entrar' class='adicionar'><br>
                        <?if(isset($_GET["valido"]) && $_GET["valido"]){?>
                            <script>sucesso()</script>
                        <?}?>
                    </fieldset>
                 </form>
            </div>
        </div>
	</body>
</html>