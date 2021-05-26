<?php
class User {
	private $id_user;
	private $des_login;
	private $des_senha;
	private $dt_registo;


public function getIduser(){
	return $this->id_user;
}

public function setIduser($value){
	$this->id_user=$value;
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

	$results = $sql->select("SELECT * FROM tb_user WHERE id_user = :ID",array(":ID"=>$id));//array(":ID"=>$id)); - Sao os parametros;

	if(count($results[0]) > 0) //isset($results[0]) -> o isset ve se existe  
	{

		$this->setData($results[0]);

	}
}

//vai trazer uma lista de user
//Não usamos a palavra this por isso este metodo pode ser estatico
// A vantagem é que n é preciso instanciar logo
//N é preciso criar um objeto
public static function getList(){

	$sql = new Sql();

	return $sql->select("SELECT * FROM tb_user ORDER BY des_login");
}

public static function search($login){

	$sql = new Sql();


	//Estou a criar a variavel Search  para depois lhe atribuir o valor do parametro
	return $sql->select("SELECT * FROM tb_user WHERE des_login LIKE :SEARCH ORDER BY des_login", array(':SEARCH'=>"%".$login."%"));
}


public function login($login, $password)
{

	$sql = new Sql(); //vai buscar a class SQL

	$results = $sql->select("SELECT * FROM tb_user WHERE des_login = :LOGIN AND des_senha = :PASSWORD ",array(":LOGIN"=>$login, ":PASSWORD"=>$password));//array(":ID"=>$id)); - Sao os parametros;

	if(count($results[0]) > 0) //isset($results[0]) -> o isset ve se existe  
	{
		//vai guardar primeira linha (Em pricnipio vai ser só um pois estamos a ir buscar pelo o ID)

		$this->setData($results[0]);

	} else {
		
		throw new Exception("Login e/ou senha errados");
		
	}

}
public function setData($data){
	//Depois vai buscar os dados tds e mandar para os "setters"
		$this->setIduser($data['id_user']);
		$this->setDeslogin($data['des_login']);
		$this->setDessenha($data['des_senha']);
		//Estamos a meter a data bem formada
		$this->setDtregisto(new DateTime($data['dt_registo']));
}
public function insert(){

	$sql = new Sql();

	$results = $sql->select("CALL sp_user_insert(:LOGIN, :PASSWORD )", array(':LOGIN'=>$this->getDeslogin(),':PASSWORD'=>$this->getDessenha()));

		if(count($results[0]) > 0) //isset($results[0]) -> o isset ve se existe  
	    {
		$this->setData($results[0]);
	    }
}

public function update($login, $password){

	$this->setDeslogin($login);
	$this->setDessenha($password);

	$sql = new Sql();

	$sql->query("UPDATE tb_user SET des_login = :LOGIN, des_senha = :PASSWORD WHERE id_user = :ID", array(
		':LOGIN'=>$this->getDeslogin(),
		':PASSWORD'=>$this->getDessenha(),
		':ID'=>$this->getIduser()
));
}

public function delete(){
	$sql = new Sql();

	$sql->query("DELETE FROM tb_user WHERE id_user = :ID", array(':ID'=>$this->getIduser()));

	$this->setIduser(0);
	$this->setDeslogin("");
	$this->setDessenha("");
	$this->setDtregisto(new DateTime());
}



//metoddo construtor para facilitar td
//eu meti as aspas pois asssim n se torna obrigatorio preencher
//pois ele vai ter sempre o parametro vazio
public function __construct($login = "", $password = ""){
	$this->setDeslogin($login);
	$this->setDessenha($password);
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
}
?>