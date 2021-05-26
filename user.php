<?php
class User {
	private $id_user;
	private $des_login;
	private $des_senha;
	private $dt_registo;
}

public function getIduser(){
	return $this->id_user;
}

public function setIduser($value){
	$this->id_user = $value;
}


public function getDeslogin(){
	return $this->des_login;
}

public function setDeslogin($value){
	$this->des_login=$value;
}


public function getDessenha(){
	return $this->des_senha;
}

public function setDessenha($value){
	$this->des_senha=$value;
}


public function getDtregisto(){
	return $this->dt_registo;
}

public function setDtregisto($value){
	$this->dt_registo=$value;
}
//Basta passar o Id pra este metodo e os dados vão aparacer
public function loadById($id){

	$sql = new Sql(); //vai buscar a class SQL

	$result = $sql->select("SELECT * FROM tb_user WHERE id_user = :ID",array(":ID"=>$id));//array(":ID"=>$id)); - Sao os parametros;

	if(count($results[0]) > 0) //isset($results[0]) -> o isset ve se existe  
	{
		//vai guardar primeira linha (Em pricnipio vai ser só um pois estamos a ir buscar pelo o ID)
		$row = $results[0];

		//Depois vai buscar os dados tds e mandar para os "setters"
		$this->setIduser($row['id_user']);
		$this->setDeslogin($row['des_login']);
		$this->setDessenha($row['des_senha']);
		//Estamos a meter a data bem formada
		$this->setDtregisto(new DateTime($row['dt_registo']));
		

	}
}

//este metodo serve só para imprimir
public function __toString(){

	return json_encode(array(
	"id_user"=>$this->getIduser(),
	"des_login"=>$this->getDeslogin(),
	"des_senha"=>$this->getDessenha(),
	"det_registo"=>$this->getDtregisto()->format("d/m/Y H:i:s")
	));
}

?>