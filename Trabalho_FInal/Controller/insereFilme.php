<?php
include_once('../Model/banco.php');
include_once('../Model/filme.php');

/*
$titulo = $_POST["titulo"];
$produtora = $_POST["produtora"];
$duracao = $_POST["duracao"];
$sinopse = $_POST["sinopse"];
*/

/*
if (isset($_POST['fileToUpload'])) {
    //$extensao = strtolower(substr($_FILES['fileToUpload']['name'], -4)); //extensão do fileToUpload
    $nome_fileToUpload = md5(time()) . $extensao; //nome do fileToUpload
    $diretorio = "img_db/";

    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $diretorio . $nome_fileToUpload); //upload do fileToUpload
    $filme = new Filme($titulo, $produtora, $duracao, $sinopse, $fileToUpload);
    $filme->insereFilme();

    if ($mysqli->query($sql_code))
        $msg = "fileToUpload enviado com sucesso!";
    else
        $msg = "Falha ao enviar fileToUpload.";
}
*/

$nome_imagem = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "../img_db/";
$target_file = $target_dir . $nome_imagem;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
echo("$target_file");

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

//$filme = new Filme($titulo, $produtora, $duracao, $sinopse, $nome_imagem);
//$filme->insereFilme();