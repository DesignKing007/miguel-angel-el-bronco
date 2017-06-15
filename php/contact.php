<?php

//contact
//Joel Fagundo Sierra

include("string.php");

if (is_array($_POST)) foreach ($_POST as $campo => $valor) if(strstr($campo,"dat_") && $campo!="dat_comentarios") {
  list($tbl,$campo)=explode("_",$campo,2);
  $valor=str_replaceinv_all($valor);
  $campo=str_replace("_"," ",$campo);
  $campo=str_replace("nn","ñ",$campo);
  if($campo=="nombre" || $campo=="Nombre") $nombre=$valor;
  if($campo=="mail" || $campo=="Mail") $mail=$valor;
  $texto.="$campo: $valor\n"; 
}
if ($_POST["dat_comentarios"]) $texto.="\nComentarios:\n".str_replaceinv_all($_POST["dat_comentarios"]); 

$extra = "From: $mail\n";

mail("lsagre5@aol.com","Para Miguel Angel de $nombre",$texto,$extra);

?>