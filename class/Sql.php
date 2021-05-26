<?php

//vou ter acesso a tds as classes do PDO
class Sql extends PDO {

	private $conn;

	//fazer um construtor para puxar a ligação
	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root" ,"");
	}
	//associar os meu aprametros ao comando //Ficou privado pk assim só esta class tem acesso
	private function setParams($statemet, $parameters = array()){

		foreach ($parameters as $key => $value) {
			// vou chamar o metodo do setParam e assim ja podemos fazer algum tratamento se for preciso
			$this->setParam($statemet, $key, $value);
		}
	}

	//Neste metodo sõ vamos receber um valor por isso é que nem temos um array no 2ºe 3º parametro 
	private function setParam($statemet, $key, $value)
	{
			$statemet->bindParam($key, $value);
	}


		//rawQuery -> uma query bruta só vaiu ser tratada depois //$params = array()-> vai ser um array pk vamos receber muitos dados
	public function execQuery($rawQuery, $params = array()){

		//statmet //So usamos o prepare ok estamos a usar uma heranca da class PDO
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();
		
		return $stmt;
	}
		//diz no final que vai fazer um return do array 
	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->execQuery($rawQuery, $params);

		// vai trazer só os dados associativos sem os "index"
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>