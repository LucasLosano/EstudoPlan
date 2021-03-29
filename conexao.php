<?php    
    $db = 'epiz_27702723_estudo';
    $host = 'sql202.epizy.com';
    $user = 'epiz_27702723';
    $senha = 'yRUoi5ILiqNZq';
    try{
        $pdo = new PDO("mysql:dbname=$db;host=$host",$user,$senha);
    }
    catch(PDOException $e){
        return 'Conexão falhou: ' . $e->getMessage();
    }    
?>