function prueba2(opcion){
	v = document.getElementById('n1').value;
	v1 = document.getElementById('n2').value;
	v2 = document.getElementById('n3').value;
	v3 = document.getElementById('n4').value;
	var x = document.getElementById(opcion).innerText;
	var xmlhttp = new XMLHttpRequest();
    if( x =='Enviar'){
    	xmlhttp.open("POST",config['url']+"Index/r", true); 
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
	    xmlhttp.send('v='+v+'&v1='+v1+'&v2='+v2+'&v3='+v3);
		xmlhttp.onreadystatechange = function() 
		{
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
	        {
	            console.log(xmlhttp.responseText);
	            document.getElementById('Mensaje').innerHTML = "Se guardo correctamente";

	    	}
		}
    }
    if(x=='Eliminar'){
    	xmlhttp.open("POST",config['url']+"Index/eliminar", true); 
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
	    xmlhttp.send('v='+v+'&v1='+v1+'&v2='+v2+'&v3='+v3);
		xmlhttp.onreadystatechange = function() 
		{
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
	        {
	        	var b = xmlhttp.responseText;
	        	var g = b.trim();
	        	if(v == '' && v1=='' || v2=='' || v3==''){
	        		document.getElementById('Mensaje').innerHTML = "No se rellenaron los campos! o" + b;
	        	}
	        	else if(g == b.trim()){
	        		document.getElementById('Mensaje').innerHTML = "No se encontraron registros";
	        	}
	        	else{
	        		document.getElementById('Mensaje').innerHTML = "Se elimino correctamente!";
	        	}

	    	}
		} 

    }
}