<?php
if(isset($_POST["submit"])){
  if (!empty(["Nidentifiacion"])) {
    echo $_POST["Nidentificacion"]."<br/>";
  }
    if(!empty($_POST["Nombres"])&& strlen($_POST["Nombres"]<=20) && !is_numeric($_POST["Nombres"]) && !preg_match("/[0-9]/", $_POST["Nombres"])){
        echo $_POST["Nombres"]."<br/>";
    }
     if(!empty($_POST["Apellidos"])&& !is_numeric($_POST["Apellidos"]) && !preg_match("/[0-9]/", $_POST["Apellidos"])){
        echo $_POST["Apellidos"]."<br/>";
    }
    if(!empty($_POST["Instrumento"])){
       echo ($_POST["Instrumento"])."<br/>";
   }
    if (!empty(["Direccion"])) {
      echo $_POST["Direccion"]."<br/>";
    }
    if(!empty($_POST["Acudiente"])&& !is_numeric($_POST["Acudiente"]) && !preg_match("/[0-9]/", $_POST["Acudiente"])){
       echo $_POST["Acudiente"]."<br/>";
   }
    if (!empty(["TelefonoA"])) {
      echo $_POST["TelefonoA"]."<br/>";
    }
     if(!empty($_POST["Password"]) && strlen($_POST["Password"]>=6)){
        echo sha1($_POST["Password"])."<br/>";
    }
     if(!empty($_POST["Rol"])){
        echo ($_POST["Rol"])."<br/>";
    }
    if(isset($_FILES["Foto"]) && !empty($_FILES["Foto"]["tmp_name"])){
		echo "La imagen esta cargada";
	    }
}
