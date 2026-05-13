<?php
require '../../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET,'jsn');
$data = json_decode($json,true);
$nome = strtoupper($data['nome']);
$sql = "insert into categorias (catnome) values (?);";
$prp = $pdo->prepare($sql);
$prp->execute([$nome]);
Conexao::desconectar();
//http://localhost/Projetos_ETEC_PWEB-III_Div2/api/iusuario.php?jsn={"nome":"ENZO APARECIDO","login":"ENZO","senha":"pythonando"}
