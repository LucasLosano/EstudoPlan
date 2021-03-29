<?php

    session_start();
    if(isset($_SESSION['id_usuario'])){        
        $_SESSION['id_usuario'] = null;
    }
?>

<html>
	<head>
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
                span.style = 'color:red;display:inline-block; margin-top: -30px;';
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
                let label = document.createElement('label');
                label.for = "confirmarSenha";
                label.innerHTML = "Confirmar senha";                
                document.getElementById('inputs').appendChild(label);

                document.getElementById('inputs').appendChild(document.createElement('br'));

                let input = document.createElement('input');
                input.type = 'password';
                input.id = 'confirmarSenha';
                input.placeholder = 'Confirmar senha';
                document.getElementById('inputs').appendChild(input);

                document.getElementById('inputs').appendChild(document.createElement('br'));

                let btnConfimar = document.createElement('input');
                btnConfimar.value = 'Confirmar';
                btnConfimar.id = 'confirmar';
                btnConfimar.className = 'adicionar';
                btnConfimar.type = 'button';
                btnConfimar.onclick = cadastrar;
                document.getElementById('inputs').appendChild(btnConfimar);  

                let btnVoltar = document.createElement('input');
                btnVoltar.value = 'Voltar';
                btnVoltar.className = 'adicionar';
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
		<div id='topo'>
            Estudo Plan            
        </div>
        <div id='body'>
            <div id='container'>   
                 <form>
                    <fieldset id='fieldset'>
                        <legend>Login</legend>
                        <div id="inputs">
                            <label for='email'>E-mail</label><br>
                            <input type='email' id='email' placeholder='exemplo@gmail.com'><br>
                            <label for='senha'>Senha</label><br>
                            <input type='password' id='senha' placeholder='Senha'><br>
                        </div>
                        <input value='Entrar' type='button' onclick='validar()' id='entrar' class='adicionar'><br>     
                        <input value='Cadastrar-se' type='button' onclick='montarCadastrar()' id='btnCadastrar' class='adicionar'><br>                   
                        
                        <?if(isset($_GET["invalida"]) && $_GET["invalida"]==1){?>
                            <script>erro("E-mail ou senha inválidos")</script>
                        <?}if(isset($_GET["invalida"]) && $_GET["invalida"]==2){?>
                        
                            <script>erro("E-mail já existe")</script>
                        <?}?>
                    </fieldset>
                 </form>
            </div>
        </div>
	</body>
</html>