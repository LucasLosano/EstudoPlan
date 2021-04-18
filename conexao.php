<?php    
    $db = 'epiz_27702723_estudo';
    $host = 'localhost';
    $user = 'root';
    $senha = '';
    try{
        $pdo = new PDO("mysql:dbname=$db;host=$host",$user,$senha);
    }
    catch(PDOException $e){
        return 'Conexão falhou: ' . $e->getMessage();
    }    
?>