<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET, 'jsn'); 
$data = json_decode($json, true);
$usuario = $data['usuario'];
$senha = $data['senha'];
$sql = "SELECT * FROM usuarios WHERE usulogin = ? AND ususenha = MD5(?)";
$prp = $pdo->prepare($sql);
$prp->execute();
$data = $prp->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
//http://localhost/Projetos_ETEC_PWEB-III_Div2/api/login.php?jsn={"usuario":"XANDAO","senha":"123456"}

//Comando sql inject pra achar vulnerabilidade para inserir
//http://localhost/Projetos_ETEC_PWEB-III_Div2/api/login.php?jsn={"usuario":"' or '1' = '1'; insert into usuarios (usunome, usulogin, ususenha, usulogado) values ('TUCAO', 'TUCA', '123456', TRUE); --","senha":"123"}

//Comando sql inject pra achar vulnerabilidade para update
//http://localhost/Projetos_ETEC_PWEB-III_Div2/api/login.php?jsn={"usuario":"' or '1' = '1'; UPDATE usuarios set ususenha = MD5('1234') WHERE usuid = 2 ; --","senha":"123"}