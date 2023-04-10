

async function generarTabla(){  
    const contenedorTabla = document.getElementById('contenedorTabla');
    contenedorTabla.innerHTML = '';
    
    const response = await fetch("http://localhost:8080/proyectoedi/31-05-22/getarchivos.php");
    const responseJson = await response.json();
    console.log(responseJson);

    const grupos = responseJson.reduce(function (acumulador, objeto) {
       
        let clave = objeto.idArchivo;
        if (!acumulador[clave]) {
          acumulador[clave] = [];
        }
        acumulador[clave].push(objeto);
        console.log(responseJson);
        return acumulador;
      }, {});

    console.log(grupos);

    let table = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    table.appendChild(thead);
    table.appendChild(tbody);

    contenedorTabla.appendChild(table);

    if(responseJson.length>0){
        var idH=0;
        let row_1 = document.createElement('tr');
        for (const key in responseJson[0]) {
            idH++; 
            let heading_1 = document.createElement('th');
            var elementidH = document.getElementsByTagName("th").length
            heading_1.setAttribute('id',idH);
            if(idH==1){
                heading_1.setAttribute("style", "margin-right: 20px;");
            }
            if(idH==3){
                heading_1.setAttribute("style", "min-width: 500px !important;");
            }
            if(idH==4){
                heading_1.setAttribute("style", "margin-left: 60px;");
            }
            heading_1.innerHTML = key;
            row_1.appendChild(heading_1);
        }
        thead.appendChild(row_1);
    
        
        
        
        for (const archivo of responseJson) {
            let rowBody = document.createElement('tr');
            
                      
            var id=0;
            for (const keyArchivo in archivo) {
                id++;  
                let fieldData = document.createElement('td');
                var elementid = document.getElementsByTagName("td").length
                fieldData.setAttribute('class',id);
                if(id==3){
                    fieldData.setAttribute("style", "width: 500px;");
                }
                fieldData.innerHTML = archivo[keyArchivo];
                rowBody.appendChild(fieldData);
            }

            
            tbody.appendChild(rowBody);
        }
        
    }else{
        contenedorTabla.innerHTML = 'NO HAY RESULTADOS';
    }
       



// Creating and adding data to second row of the table
   
}
const descargarArchivo = function(archivo){
 
    //Solo para probar...
    console.log(archivo);

}

//Al hacer clic: generar el archivo
document.querySelector('#boton-descargar').addEventListener('click', (e) =>{

    //Primero generamos el Blob
    const archivo = generarBlobTexto();

    //Y luego lo descargamos
    descargarArchivo(archivo, 'datosPersonales.txt');

});


