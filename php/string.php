<?php

// string
// Joel Fagundo Sierra

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function str_replace_all($valor){
  $valor=str_replace("�","{a}",$valor);
  $valor=str_replace("�","{e}",$valor);
  $valor=str_replace("�","{i}",$valor);
  $valor=str_replace("�","{o}",$valor);
  $valor=str_replace("�","{u}",$valor);
  $valor=str_replace("�","{n}",$valor);
  $valor=str_replace("�","{A}",$valor);
  $valor=str_replace("�","{E}",$valor);
  $valor=str_replace("�","{I}",$valor);
  $valor=str_replace("�","{O}",$valor);
  $valor=str_replace("�","{U}",$valor);
  $valor=str_replace("�","{N}",$valor); 
  $valor=str_replace("\n","",$valor); 
  $valor=str_replace("\r","",$valor);
  return $valor;
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function str_replaceinv_all($valor){
  $valor=str_replace("{a}","�",$valor);
  $valor=str_replace("{e}","�",$valor);
  $valor=str_replace("{i}","�",$valor);
  $valor=str_replace("{o}","�",$valor);
  $valor=str_replace("{u}","�",$valor);
  $valor=str_replace("{n}","�",$valor);
  $valor=str_replace("{A}","�",$valor);
  $valor=str_replace("{E}","�",$valor);
  $valor=str_replace("{I}","�",$valor);
  $valor=str_replace("{O}","�",$valor);
  $valor=str_replace("{U}","�",$valor);
  $valor=str_replace("{N}","�",$valor);
  return $valor;
}

?>