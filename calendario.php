<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){        
        header('Location: login.php');
    }
    
    $texto = "";
    if(isset($_GET['num'])){        
        $valor = $_GET['num'];
        $texto = $_GET['filtro'];
    }
    $_GET = null;

    
    date_default_timezone_set("America/Sao_Paulo");

    $acao = 'readUpdate';  
    require('controller.php');
    
?>

<html>
	<head>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Estudo Plan</title>

		<link rel="stylesheet" href="estilo.css">

        <script>
            $(document).ready(() => {
                $(".display-4").on("click",e =>{

                    let id = "#" + e.currentTarget.innerHTML.replace('<i style="font-size:35px" class="fas fa-sort-down"></i>',"").replace(" ","");
                    console.log(id)
                    $(id).toggle(200);
                })

                $("legend").on("click",e =>{
                    console.log($("#filtro"));
                    $("#filtro").toggle(200);
                })

                $("#Adicionar").on("click",e =>{
                    window.location.href = "http://losanoteste.rf.gd/calendario.php?num=" + $("#meses").val() + "&filtro=" + $("#text").val()
                })
            })
 
        </script>

        <script>
            function createUpd(id, titulo, tempo)
            {
                let div = document.createElement("div");
                div.className = "card bg-info text-light d-flex flex-column m-1 p-2";
                div.innerHTML = `<strong>${titulo}</strong><span>Tempo:${tempo}</span>`;

                document.getElementById(id).appendChild(div);
            }
        </script>

        <style>
            span:hover,legend:hover{
                cursor: pointer;
            }
        </style>

	</head>

	<body>
		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-info">
            <a style="font-size: 2.2em;" href="#" class="navbar-brand h1">Estudo Plan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li style="font-size: 1.5em;" class="nav-item ">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li style="font-size: 1.5em;" class="nav-item">
                            <a class="nav-link" href="adicionar.php">Adicionar</a>
                        </li>
                        <li style="font-size: 1.5em;" class="nav-item active">
                            <a class="nav-link" href="#">Calendário</a>
                        </li>
                        <li style="font-size: 1.5em;" class="nav-item">
                            <a class="nav-link" href="login.php">Sair<i class="d-inline-block ml-2 fas fa-sign-out-alt"></i></a>
                        </li>
                    </ul>
            </div>
        </nav>
        <form class="mb-5 px-3 border border-info" style="margin-top:-15px">
                <fieldset id='fieldset'>
                    <legend class="text-info " style="font-size:20px"><i style="font-size:35px" class="fas fa-sort-down"></i>Filtro</legend>
                    <div style="display:none" id="filtro">
                        <div  class="d-flex pb-3">
                            <input class="form-control mx-1" type='text' id='text' placeholder='Pesquise por post'>
                            <input class='form-control mx-1' type='number' min='1' placeholder='Número de meses exibidos' id='meses' >
                        
                            <input value='Adicionar' type='button' id='Adicionar' class='btn btn-info mb-0'><br>
                        </div>
                    </div>
                </fieldset>
        </form>
        
        <div class="container">
            

            <?if($updates){?>

                <?
                    $date = new DateTime(date("Y-m-") . '01');    
                    if(!$valor || $valor <=1)  
                        $valor = 1;
                    $valor = $valor - 1;
                    $date->sub(new DateInterval('P'. $valor . 'M' ));
                ?>
                <? for ($j = 1; $j <= ($valor+1); $j++) { ?>
                    <div class="card my-2">
                        <span class="display-4" style="font-size:40px"><i style="font-size:35px" class="fas fa-sort-down"></i><?=$date->format("M Y");?></span>

                        
                        <div style="display:none;" id='<?=$date->format("MY");?>' class="m-auto w-100 row">
                            <? for ($i = 1; $i <= $date->format("t"); $i++) { ?>
                                <div id="<?=$date->format('Y-m-d')?>" class="d-flex flex-column" style="width:20%;min-height:30px;border: 1px solid black">
                                    <span>
                                        <?
                                            echo $i;
                                            if($i != $date->format("t"))
                                            {
                                                $date->add(new DateInterval('P1D'));
                                            }
                                        ?>
                                    </span>
                                </div>
                            <?} 
                                $date->add(new DateInterval('P1D'));
                            ?>


                        </div>
                    </div>
                <?}?>

            <?}else{?>
                <span class="display-5"> Nenhuma atualização foi realizada ainda ... </span>
            <?}?>

        </div>
        <?
            foreach($updates as $upd){
                $change = str_replace($texto,'', $upd->titulo);
                if(mb_strtolower($upd->titulo) != mb_strtolower($change) || $texto == ''){
        ?>
            
            
            <script>
                createUpd('<?=$upd->date_upd?>', '<?=$upd->titulo?>', <?=$upd->tempo_upd?>);
            </script>
            
        <?}}?>
        

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>