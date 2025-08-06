

function nuevaPlaca(){

    const http=new XMLHttpRequest();

	const url = '../vehiculos/vehiculos.php';

	http.onreadystatechange = function(){

		if(this.readyState == 4 && this.status ==200){

			console.log(this.responseText);

			document.getElementById("divResultadosVehiculos").innerHTML = this.responseText;

		}

	};

	http.open("POST",url);

	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.send("opcion=nuevo");

}

function  convertMayusculas(){

    var placa =  document.getElementById("placaPeritaje");

    var mayusculas =  placa.value.toUpperCase();

    document.getElementById("placaPeritaje").value = mayusculas;

}



function mostrarVehiculos(){
    const http=new XMLHttpRequest();
	const url = '../vehiculos/vehiculos.php';
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status ==200){
			console.log(this.responseText);
			document.getElementById("divResultadosVehiculos").innerHTML = this.responseText;
		}
	};
	http.open("POST",url);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("opcion=muestreVehiculos");
}
function buscarVehiculoPorPlaca(){
    var placa = document.getElementById("txtBuscarPlaca").value;
    const http=new XMLHttpRequest();
	const url = '../vehiculos/vehiculos.php';
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status ==200){
			console.log(this.responseText);
			document.getElementById("divResultadosVehiculos").innerHTML = this.responseText;
		}
	};
	http.open("POST",url);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("opcion=muestreVehiculosPlaca"
    + "&placa="+placa
    );
}



function buscarPlacaPeritaje(){

    var placa = document.getElementById("placaPeritaje").value;

    if(placa=="" || placa.length <6){

        alert('Digite una placa')

    }else{

        const http=new XMLHttpRequest();

        const url = '../vehiculos/vehiculos.php';

        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){

                console.log(this.responseText);

                document.getElementById("divResultadobusqueda").innerHTML = this.responseText;

            }

        };

        http.open("POST",url);

        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        http.send("opcion=buscarPlaca"+ "&placa="+placa);

    }

}





function grabarVehiculo()

{

     

     valida = validacionesCarro();

     if(valida != 0)

     { 

         // alert('pora aqui va ');

         var placa =  document.getElementById("placaPeritaje").value;

         var propietario =  document.getElementById("selectPropietario").value;

         var marca =  document.getElementById("marca").value;

         var linea =  document.getElementById("linea").value;

         var modelo =  document.getElementById("modelo").value;

         var color =  document.getElementById("color").value;

         var vencisoat =  document.getElementById("vencisoat").value;

         var revision =  document.getElementById("revision").value;

         var chasis =  document.getElementById("chasis").value;

         var motor =  document.getElementById("motor").value;



         const http=new XMLHttpRequest();

         const url = '../vehiculos/vehiculos.php';

         http.onreadystatechange = function(){

             if(this.readyState == 4 && this.status ==200){

                 console.log(this.responseText);

                 document.getElementById("divResultadosVehiculos").innerHTML = this.responseText;

             }

         };



         http.open("POST",url);

         http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

         http.send("opcion=grabarVehiculo1"

                 + "&placa="+placa

                 + "&propietario="+propietario

                 + "&marca="+marca

                 + "&linea="+linea

                 + "&modelo="+modelo

                 + "&vencisoat="+vencisoat

                 + "&revision="+revision

                 + "&chasis="+chasis

                 + "&motor="+motor

                 + "&color="+color

             );

             

     }

 }



 

function validacionesCarro()

{

    if(document.getElementById("placa").value == '')

    {

       alert("Digite placa") ;  

       document.getElementById("placa").focus();

       return 0;

    }

    if(document.getElementById("selectPropietario").value == 0)

    {

       alert("Escoja o cree propietario ") ;  

       document.getElementById("selectPropietario").focus();

       return false

    }

    if(document.getElementById("marca").value == 0)

    {

       alert("Digite marca ") ;  

       document.getElementById("marca").focus();

       return false

    }

    if(document.getElementById("linea").value == 0)

    {

       alert("Digite linea ") ;  

       document.getElementById("linea").focus();

       return false

    }

    if(document.getElementById("modelo").value == 0)

    {

       alert("Digite modelo ") ;  

       document.getElementById("modelo").focus();

       return false

    }

    if(document.getElementById("color").value == 0)

    {

       alert("Digite color ") ;  

       document.getElementById("color").focus();

       return false

    }

    return 1;

}

function verHistorialVehiculo(placa)
{
    //  alert('historial vehiculo'+placa);
    const http=new XMLHttpRequest();
    const url = '../vehiculos/vehiculos.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalHistoriales").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=mostrarHistorialVehiculo"
    + "&placa="+placa
    );
}
function muestreInfoVehiculo(placa)
{
    const http=new XMLHttpRequest();
    const url = '../vehiculos/vehiculos.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalInfoVehiculo").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=muestreInfoVehiculo"
    + "&placa="+placa
    );
}




function prueba(e)
{
    alert('prueba'+e)
}
function muestreItemsOrden123(id)
{
    
    // var placa = document.getElementById("histoPlaca").value 
    // alert('orden'+id);
    const http=new XMLHttpRequest();
    const url = '../orden/itemsOrden.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divMostrarItemsOrden").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=verItemsOrden"
    + "&id="+id
    );
}

function filtrarPropietariosNombre()
{
    // alert('filtro de propietarios');
    var nombreCliente =  document.getElementById("nombrePropietarioAFiltrar").value;
    const http=new XMLHttpRequest();
    const url = '../clientes/clientesResponsivo.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("selectPropietario").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=filtrarPropietariosNombre"
    + "&nombreCliente="+nombreCliente
    );
}

function actualizarVehiculoNew()
{
    var idcarro =  document.getElementById("idcarro").value;
    var placaAnterior =  document.getElementById("placaoripan").value;
    var placaNueva =  document.getElementById("placapan").value;
    var marca =  document.getElementById("marcapan").value;
    var tipo =  document.getElementById("tipopan").value;
    var modelo =  document.getElementById("modelopan").value;
    const http=new XMLHttpRequest();
    const url = '../vehiculos/vehiculos.php';
    // alert('Anterior'+ placaAnterior + '  nueva '+ placaNueva )
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalInfoVehiculo").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=actualizarDatosVehiculoNew"
    + "&idcarro="+idcarro
    + "&placaAnterior="+placaAnterior
    + "&placaNueva="+placaNueva
    + "&marca="+marca
    + "&tipo="+tipo
    + "&modelo="+modelo
    );


}