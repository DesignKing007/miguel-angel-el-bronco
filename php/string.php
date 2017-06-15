<?php

// string
// Joel Fagundo Sierra

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function str_replace_all($valor){
  $valor=str_replace("á","{a}",$valor);
  $valor=str_replace("é","{e}",$valor);
  $valor=str_replace("í","{i}",$valor);
  $valor=str_replace("ó","{o}",$valor);
  $valor=str_replace("ú","{u}",$valor);
  $valor=str_replace("ñ","{n}",$valor);
  $valor=str_replace("Á","{A}",$valor);
  $valor=str_replace("É","{E}",$valor);
  $valor=str_replace("Í","{I}",$valor);
  $valor=str_replace("Ó","{O}",$valor);
  $valor=str_replace("Ú","{U}",$valor);
  $valor=str_replace("Ñ","{N}",$valor); 
  $valor=str_replace("\n","",$valor); 
  $valor=str_replace("\r","",$valor);
  return $valor;
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function str_replaceinv_all($valor){
  $valor=str_replace("{a}","á",$valor);
  $valor=str_replace("{e}","é",$valor);
  $valor=str_replace("{i}","í",$valor);
  $valor=str_replace("{o}","ó",$valor);
  $valor=str_replace("{u}","ú",$valor);
  $valor=str_replace("{n}","ñ",$valor);
  $valor=str_replace("{A}","Á",$valor);
  $valor=str_replace("{E}","É",$valor);
  $valor=str_replace("{I}","Í",$valor);
  $valor=str_replace("{O}","Ó",$valor);
  $valor=str_replace("{U}","Ú",$valor);
  $valor=str_replace("{N}","Ñ",$valor);
  return $valor;
}

?>