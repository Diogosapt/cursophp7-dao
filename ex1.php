<?php

//fazer a conexao
$conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");

$stmt = $conn->prepare("SELECT * FROM tb_user ORDER BY des_login");

$stmt->execute();

//vai trazer os resultados tds sem ser preciso um while
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {
	foreach ($row as $key => $value) {
		echo "<strong>".$key."</strong>".$value."<br/>";
	}

	echo "»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»";
}

var_dump($results);

?>