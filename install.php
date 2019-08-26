<?php
require_once 'includes/connect.php';

$sql = "CREATE TABLE IF NOT EXISTS estudiante(
			user_id  int(255) auto_increment not null,
			Nidentificacion int(255),
			Nombres	 varchar(50),
			Apellidos  varchar(255),
			Instrumento varchar(255),
			Direccion		varchar(255),
			Acudiente	   varchar(255),
			TelefonoA    varchar(50),
			Password   varchar(255),
			Rol        varchar(255),
			Foto   varchar(255),
			CONSTRAINT pk_estudiante PRIMARY KEY(user_id)
		);";

$create_estudiante_table = mysqli_query($db, $sql);

if($create_estudiante_table){
	echo "La tabla estudiante se ha creado correctamente !!";
}
?>
