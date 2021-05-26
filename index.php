<?php
require_once("conf.php");

//$sql = new Sql();
//$user = $sql->select("SELECT * FROM tb_user");
//echo json_encode($user);

//carrega 1 user
//$root = new user();
//$root->loadById(3);
//echo $root;

//Carrega uma lista
//Metodo estatico
//$lista = User::getList();
//echo json_encode($lista);


//Carrega uma lista buscanbdo pelo o login
//Metodo estatico
//$search = User::search("user");
//echo json_encode($search);


//carregar um usuario usando o login e  a senha
//$user = new User();
//$user->login("user","1234");
//echo $user;

//Adicionar um novo user 
//$aluno = new User();
//estou a mter no setteres os valores
//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("@lun0");

//Agora com o construtor
//$aluno = new User("Maria","Pass");
// vou buscar o metodo insert
//$aluno->insert();
//echo $aluno;


//Update
//$user = new User();
//$user->loadById(3);
//$user->update("professor","fgdsdasd");
//echo $user;


//Delete

$user = new User();
$user->loadById(3);
$user->delete();
echo $user;
?>
