
<?php
//创建sqlite表格
class Mydb extends SQLite3{
	function __construct(){
		$this->open('userdb.db');
	}
}

$db = new Mydb();

//创建表
function createdb($db){
	$sql = "DROP TABLE IF EXISTS CUS;CREATE TABLE CUS (id INTEGER PRIMARY KEY AUTOINCREMENT  NOT NULL ,name CHAR(25) NOT NULL ,key CHAR(16) NOT NULL )";
	$table = $db->exec($sql);
}

createdb($db);
