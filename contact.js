// JavaScript Document

function CheckContactData()
{
	if(document.forms['contact_form'].elements['dat_nombre'].value=="")
	{
		alert("Por favor escriba su nombre");	
	}
	else if(!CheckMail(document.forms['contact_form'].elements['dat_mail'].value))
	{
		alert("Por favor escriba su email");	
	}
	else if(document.forms['contact_form'].elements['dat_comentarios'].value=="")
	{
		alert("Por favor escriba un mensaje");	
	}
	else
	{
		document.getElementById('contact_form_div').style.display='none';	
		document.getElementById('contact_sent').style.display='block';
		document.forms['contact_form'].submit();
	}
}

function CheckMail(email)
{
	if(email=="")
		return false;
	var pieces=email.split('@');
	if(!pieces[0]||!(pieces[0].length>=1))
	{
		return false;
	}
	else if(!pieces[1]||!(pieces[1].length>=1))
	{
		return false;
	}
	else if(!pieces[1].indexOf('.')||pieces[1].indexOf('.')>pieces[1].length-3)
	{
		return false;
	}
	return true;
			
}