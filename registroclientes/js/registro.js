//por algun motivo no me toma la info de este archivo me toco meterlo enla vista

function registrarCliente()
{
    var valida = validarCampos();
    if(valida)
    {
        var identi = document.getElementById("identi").value;
        var nombre = document.getElementById("nombre").value;
        var direccion = document.getElementById("direccion").value;
        var celular = document.getElementById("celular").value;
        var email = document.getElementById("email").value;
        // var clave = document.getElementById("clave").value;
        const http=new XMLHttpRequest();
        const url = '../registroclientes/registroclientes.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_principal_registro").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=registrarCliente'
        + "&identi="+identi
        + "&nombre="+nombre
        + "&direccion="+direccion
        + "&celular="+celular
        + "&email="+email
        // + "&clave="+clave
        );
    }
}

function validarCampos()
{
    if( document.getElementById("identi").value == '')
    {
        document.getElementById("identi").focus();
        alert('Por favor digitar identidad');
        return 0;
    }

    if( document.getElementById("nombre").value == '')
    {
        document.getElementById("nombre").focus();
        alert('Por favor digitar nombre');
        return 0;
    }
    if( document.getElementById("celular").value == '')
    {
        document.getElementById("celular").focus();
        alert('Por favor digitar celular');
        return 0;
    }
    if( document.getElementById("email").value == '')
    {
        document.getElementById("email").focus();
        alert('Por favor digitar email');
        return 0;
    }
  
    return 1;

}

function reviseIdenti()
{
    // alert('cambio de foco '); 
        const btnRegistrar = document.getElementById('btnRegistrar');
        var identi = document.getElementById("identi").value;
        const http=new XMLHttpRequest();
        const url = '../registroclientes/registroclientes.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                var  resp = JSON.parse(this.responseText); 
                if(resp.filas == 1)
                {   
                    document.getElementById("nombre").value = resp.data.nombre;
                    document.getElementById("spanmensaje").innerHTML  = 'Esta identidad ya existe';
                    btnRegistrar.disabled = true; 
                }
                else{
                    document.getElementById("nombre").value = '';
                    document.getElementById("spanmensaje").innerHTML  = '';
                    btnRegistrar.disabled = false; 
                }
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=reviseIdenti'
        + "&identi="+identi
        );
}
function revisePlaca()
{
    // alert('cambio de foco '); 
        const btnRegistrarPlaca = document.getElementById('btnRegistrarPlaca');
        var placa = document.getElementById("placa").value;
        const http=new XMLHttpRequest();
        const url = '../registroclientes/registroclientes.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                var  resp = JSON.parse(this.responseText); 
                if(resp.filas == 1)
                {   
                    document.getElementById("marca").value = resp.data.marca;
                    document.getElementById("linea").value = resp.data.tipo;
                    document.getElementById("modelo").value = resp.data.modelo;
                    document.getElementById("color").value = resp.data.color;
                    document.getElementById("spanmensajeplaca").innerHTML  = 'Esta placa ya existe';
                    btnRegistrarPlaca.disabled = true; 
                }
                else{
                    document.getElementById("marca").value = '';
                    document.getElementById("linea").value = '';
                    document.getElementById("modelo").value = '';
                    document.getElementById("color").value = '';
                    document.getElementById("spanmensajeplaca").innerHTML  = '';
                    btnRegistrarPlaca.disabled = false; 
                }
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=revisePlaca'
        + "&placa="+placa
        );
}


function registrarMoto()
{
    var valida = validarCamposMoto();
    if(valida)
    {
        var idcliente = document.getElementById("idcliente").value;
        var placa = document.getElementById("placa").value;
        var marca = document.getElementById("marca").value;
        var linea = document.getElementById("linea").value;
        var modelo = document.getElementById("modelo").value;
        var color = document.getElementById("color").value;
        // var clave = document.getElementById("clave").value;
        const http=new XMLHttpRequest();
        const url = '../registroclientes/registroclientes.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_mostrar_moto").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=registrarMoto'
        + "&idcliente="+idcliente
        + "&placa="+placa
        + "&marca="+marca
        + "&linea="+linea
        + "&modelo="+modelo
        + "&color="+color
        );
    }
}

function validarCamposMoto()
{
    if( document.getElementById("placa").value == '')
    {
        document.getElementById("placa").focus();
        alert('Por favor digitar placa');
        return 0;
    }

    if( document.getElementById("marca").value == '')
    {
        document.getElementById("marca").focus();
        alert('Por favor digitar marca');
        return 0;
    }
    if( document.getElementById("linea").value == '')
    {
        document.getElementById("linea").focus();
        alert('Por favor digitar linea');
        return 0;
    }
    if( document.getElementById("modelo").value == '')
    {
        document.getElementById("modelo").focus();
        alert('Por favor digitar modelo');
        return 0;
    }
  
    return 1;

}
