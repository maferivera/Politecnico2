<?php include 'includes/redirect.php';?>
<?php require_once 'includes/header.php';?>
<?php
function mostrarError($error, $field){
  if(isset($error[$field]) && !empty($field)){
    $alerta='<div class="alert alert-danger">'.$error[$field].'</div>';
  }else{
    $alerta='';
  }
  return $alerta;
}
function setValueField($error,$field, $textarea=false){
  if(isset($error) && count($error)>=1 && isset($_POST[$field])){
    if($textarea != false){
      echo $_POST[$field];
    }else{
      echo "value='{$_POST[$field]}'";
    }
  }
}
$error=array();
if(isset($_POST["submit"])){
  if (!empty($_POST["Nidentificacion"])) {
    $identificacion_validator=true;
  }else {
    $identificacion_validator=false;
    $error["Nidentificacion"]="La identificacion no puede estar vacia";
  }
 if(!empty($_POST["Nombres"]) && strlen($_POST["Nombres"]<=20) && !is_numeric($_POST["Nombres"]) && !preg_match("/[0-9]/", $_POST["Nombres"])){
$nombre_validador=true;
}else{
$nombre_validador=false;
$error["Nombres"]="El nombre no es válido";
}
  if(!empty($_POST["Apellidos"])&& !is_numeric($_POST["Apellidos"]) && !preg_match("/[0-9]/", $_POST["Apellidos"])){
      $apellidos_validador=true;
     }else{
     $apellidos_validador=false;
       $error["Apellidos"]="Los apellidos no son válidos";
        }
        if(isset($_POST["Instrumento"]) && is_numeric($_POST["Instrumento"])){
          $instrumento_validador=true;
         }else{
         $instrumento_validador=false;
          $error["Instrumento"]="Seleccione un INSTRUMENTO";
           }
     if(!empty($_POST["Direccion"])){
       $direccion_validador=true;
      }else{
      $direccion_validador=false;
       $error["Direccion"]="La direccion no puede estar vacía";
        }
     if(!empty($_POST["Acudiente"])&& !is_numeric($_POST["Acudiente"]) && !preg_match("/[0-9]/", $_POST["Acudiente"])){
          $acudiente_validador=true;

     }else {
       $acudiente_validador=false;
       $error["Acudiente"]="El acudiente no puede estar vacio";
     }
     if (!empty($_POST["TelefonoA"])) {
       $telefono_validador=true;
     }else {
       $telefono_validador=false;
       $error["TelefonoA"]="El telefono no puede estar vacio";
     }
     if(!empty($_POST["Password"]) && strlen($_POST["Password"]>=6)){
       $email_validador=true;
      }else{
      $email_validador=false;
       $error["Password"]="Introduzca una contraseña de más de seis caracteres";
        }
     if(isset($_POST["Rol"]) && is_numeric($_POST["Rol"])){
       $rol_validador=true;
      }else{
      $rol_validador=false;
       $error["Rol"]="Seleccione un ROL de usuario";
        }
      //Crear una carpeta nuevo código
      $image=null;
      if(isset($_FILES["Foto"]) && !empty($_FILES["Foto"]["tmp_name"])){
        if(!is_dir("uploads")){
          $dir = mkdir("uploads", 0777, true);
        }else{
          $dir=true;
        }
        if($dir){
          $filename= time()."-".$_FILES["Foto"]["name"]; //concatenar función tiempo con el nombre de imagen
          $muf=move_uploaded_file($_FILES["Foto"]["tmp_name"], "uploads/".$filename); //mover el fichero utilizando esta función
          $image=$filename;
          if($muf){
            $image_upload=true;
          }else{
            $image_upload=false;
            $error["Foto"]= "La imagen no se ha subido";
          }
        }
        //var_dump($_FILES["image"]);
        //die();
	 	}
    //Insertar Usuarios en la base de Datos
    if(count($error)==0){
      $sql= "INSERT INTO estudiante VALUES(NULL, '{$_POST["Nidentificacion"]}', '{$_POST["Nombres"]}', '{$_POST["Apellidos"]}', '{$_POST["Instrumento"]}', '{$_POST["Direccion"]}', '{$_POST["Acudiente"]}', '{$_POST["TelefonoA"]}', '".sha1($_POST["Password"])."', '{$_POST["Rol"]}', '{$image}');";
      $insert_user=mysqli_query($db, $sql);
    }else{
      $insert_user=false;
    }
}
?>
<h1>Crear Usuarios</h1>
<?php if(isset($_POST["submit"]) && count($error)==0 && $insert_user !=false){?>
  <div class="alert alert-success">
    El Usuario del sistema se ha creado correctamente !!
  </div>
<?php } ?>
<form action="crear.php" method="POST" enctype="multipart/form-data">
    <label for="Nidentificacion">N° Identifiacion:
    <input type="number" name="Nidentificacion" class="form-control" <?php setValueField($error, "Nidentificacion");?>/>
    <?php echo mostrarError($error, "Nidentificacion");?>
    </label>
    </br></br>
    <label for="Nombres">Nombres:
        <input type="text" name="Nombres" class="form-control" <?php setValueField($error, "Nombres");?>/>
        <?php echo mostrarError($error, "Nombres");?>
    </label>
    </br></br>
    <label for="Apellidos">Apellidos:
        <input type="text" name="Apellidos" class="form-control" <?php setValueField($error, "Apellidos");?>/>
        <?php echo mostrarError($error, "Apellidos");?>
    </label>
    </br></br>
    <label for="Instrumento" class="form-control">Instrumento:
        <select name="Instrumento">
        <option value="0">Trompeta</option>
            <option value="1">Clarinete</option>
            <option value="2">Saxofon</option>
            <option value="3">Oboe</option>
            <option value="4">Violin</option>
            <option value="5">Bombo</option>
            <option value="6">Corno frances</option>
        </select>
        <?php echo mostrarError($error, "Instrumento");?>
    </label>
  </br></br>
    <label for="Direccion">Direccion:
        <input type="text" name="Direccion" class="form-control" <?php setValueField($error, "Direccion");?>/>
        <?php echo mostrarError($error, "Direccion");?>
    </label>
    </br></br>
    <label for="Acudiente">Acudiente:
        <input type="text" name="Acudiente" class="form-control" <?php setValueField($error, "Acudiente");?>/>
        <?php echo mostrarError($error, "Acudiente");?>
    </label>
    </br></br>
    <label for="TelefonoA">Telefono:
        <input type="tel" name="TelefonoA" class="form-control" <?php setValueField($error, "TelefonoA");?>/>
        <?php echo mostrarError($error, "TelefonoA");?>
    </label>
    </br></br>
    <label for="Foto">Imagen:
        <input type="file" name="Foto" class="form-control"/>
    </label>
    </br></br>
    <label for="Password">Contraseña:
        <input type="Password" name="Password" class="form-control"/>
        <?php echo mostrarError($error, "Password");?>
    </label>
    </br></br>
    <label for="Rol" class="form-control">Rol:
        <select name="Rol">
        <option value="0">Estudiante</option>
            <option value="1">Administrador</option>
        </select>
        <?php echo mostrarError($error, "Rol");?>
    </label>
    </br></br>
    <input type="submit" value="Enviar" name="submit" class="btn btn-success"/>
</form>
<?php require_once 'includes/footer.php'; ?>
