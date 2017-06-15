<?php
/************************************************************************************************************/
/* This is the email where the contact message will be sent to. Replace your@email.com with your own email. */
/*																										    */		
/* Example: $_RECIPIENT_EMAIL="lsagre5@aol.com";										    */	
/************************************************************************************************************/
$_RECIPIENT_EMAIL="lsagre5@aol.com";
/************************************************************************************************************/
/* This is the email that will be shown in the from field of the sent email. Do not change it if you        */
/* want the sender to be the email in the contact form, or replace it with your custom email.               */
/*																										    */		
/* Example: $_RECIPIENT_EMAIL="contactos@miguelangelelbronco.com";										    */	
/************************************************************************************************************/
$_FROM_EMAIL="";
/************************************************************************************************************/
/* This will be the subject of the message sent. Replace it with your custom subject.                       */
/*																										    */		
/* Example: $_EMAIL_SUBJECT="Has recibido un mensaje";										    */	
/************************************************************************************************************/
$_EMAIL_SUBJECT="Mensaje enviado desde miguelangelelbronco.com";

if(!isset($_POST["dat_nombre"],$_POST["dat_mail"],$_POST["dat_comentarios"]))
	exit;
else
{
	$email_body="";
	$email_body.="Nombre: ".stripslashes($_POST["dat_nombre"])."\n\n";
	$email_body.="Email: ".stripslashes($_POST["dat_mail"])."\n\n";
	$email_body.="Mensaje: \n";
	$email_body.=$_POST["dat_comentarios"];
	$email_body.="\n\nEnviado el ".date("d/m/Y H:i:s");
	
	$_FROM_EMAIL=($_FROM_EMAIL=="")?$_FROM_EMAIL=$_POST["dat_mail"]:$_FROM_EMAIL;
	
	@mail($_RECIPIENT_EMAIL,$_EMAIL_SUBJECT,$email_body,"From: ".$_FROM_EMAIL);
}
?>