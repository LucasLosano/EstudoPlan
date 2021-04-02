<?php

    session_start();
    if(isset($_SESSION['id_usuario'])){        
        $_SESSION['id_usuario'] = null;
    }
?>

<html>
	<head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Estudo Plan</title>

		<link rel="stylesheet" href="teste.css">
        <script>
            function validar(){
                let email = document.getElementById('email').value;
                let senha = document.getElementById('senha').value;

                if(email && senha){
                    window.location.href = `controller.php?acao=logar&email=${email}&senha=${senha}`; 
                }
                else{
                    erro('E-mail ou senha inválidos');                    
                }
            }

            function erro(erro){
                if(document.getElementById('existe'))
                {
                    remover('existe')
                }
                let span = document.createElement('span');
                span.id = 'existe';
                span.innerHTML = erro;
                span.className = "text-danger d-inline-block"
                document.getElementById('fieldset').appendChild(span);
                
            }

            let cadastrar = function cadastrar()
            {
                let email = document.getElementById('email').value;
                let senha = document.getElementById('senha').value;
                let confirmarSenha = document.getElementById('confirmarSenha').value;
                if(email && senha){
                    if(senha == confirmarSenha)
                    {
                        window.location.href = `controller.php?acao=novoLogin&email=${email}&senha=${senha}`; 
                    }
                    else
                    {
                        erro('As senhas não batem');
                    }
                }
                else{
                    erro('E-mail ou senha vazios');                    
                }
            }

            function montarCadastrar(){
                let div = document.createElement('div');    
                div.id = 'divConfirmarSenha';       
                div.className = 'form-group';     
                document.getElementById('inputs').appendChild(div);

                let input = document.createElement('input');
                input.type = 'password';
                input.id = 'confirmarSenha';
                input.placeholder = 'Confirmar senha';
                input.className = 'form-control';
                document.getElementById('divConfirmarSenha').appendChild(input);

                let btnConfimar = document.createElement('input');
                btnConfimar.value = 'Confirmar';
                btnConfimar.id = 'confirmar';
                btnConfimar.className = 'btn btn-info';
                btnConfimar.type = 'button';
                btnConfimar.onclick = cadastrar;
                document.getElementById('inputs').appendChild(btnConfimar);  

                let btnVoltar = document.createElement('input');
                btnVoltar.value = 'Voltar';
                btnVoltar.className = 'btn btn-info';
                btnVoltar.type = 'button';
                btnVoltar.onclick = () => {window.location.href = 'login.php';};
                btnVoltar.style = "margin-left:5px;";
                document.getElementById('inputs').appendChild(btnVoltar);  

                remover("entrar");
                remover("btnCadastrar");     
                if(document.getElementById('existe')){
                        remover('existe')
                }

            }

            

            function remover(id)
            {
                let elem = document.getElementById(id);
                elem.parentNode.removeChild(elem);
            }

        </script>
	</head>

	<body>
		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-info">
            <a style="font-size: 2.2em;" href="#" class="navbar-brand h1">Estudo Plan</a>
        </nav>
        <div id='body'>
            <div id='container'>   
                 <form class="px-3 py-2 border border-info">
                    <fieldset  id='fieldset'>
                        <legend class="text-info">Login</legend>
                        <div id="inputs">
                            <div class="form-group">
                                <input class="form-control" type='email' id='email' placeholder='E-mail'>
                            </div>
                            <div class="form-group">
                                
                                <input class="form-control" type='password' id='senha' placeholder='Senha'>
                            </div>
                        </div>
                        <input value='Entrar' type='button' onclick='validar()' id='entrar' class='btn mx-auto d-block btn-info'>    
                        <input value='Cadastrar-se' type='button' onclick='montarCadastrar()' id='btnCadastrar' class='btn btn-info btn-sm'>              <br>    
                        
                        <?if(isset($_GET["invalida"]) && $_GET["invalida"]==1){?>
                            <script>erro("E-mail ou senha inválidos")</script>
                        <?}if(isset($_GET["invalida"]) && $_GET["invalida"]==2){?>
                        
                            <script>erro("E-mail já existe")</script>
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