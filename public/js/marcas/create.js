/*function cargarOpcion(){
    if (document.getElementById("opcion").value == 'P'){
        document.getElementById("bebidas").style.display = 'none';
        document.getElementById("productos").style.display = 'block';
    }else{
        document.getElementById("productos").style.display = 'none';
        document.getElementById("bebidas").style.display = 'block';
    }
}*/

function verificarNombre(){
	var nombre = document.getElementById('nombre').value
	var id_marca = document.getElementById('id_marca').value

	var route = "http://localhost:8000/consulta/verificar-nombre-marca/"+nombre+"/"+id_marca+"";
                    
    $.ajax({
        url:route,
        type:'GET',
        success:function(ans){
        	if (ans.cant == '0'){
        		document.getElementById('errorNombre').style.display = 'none';
        		document.getElementById("boton").disabled = false;
        	}else{
        		document.getElementById('errorNombre').style.display = 'block';
        		document.getElementById("boton").disabled = true;
        	} 
        }

    });
}
