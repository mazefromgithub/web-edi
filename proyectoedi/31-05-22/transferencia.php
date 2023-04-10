<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferencia de archivos </title>
        
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
<h2>Transferencia de inputArchivos</h2>

</header>

    <div class="container">
        <div class="row" id="prin">
            <div class="col-12">
                <h1>Transferir archivos</h1>
                <br>
                <input type="file"  id="inputArchivos" accept=".edi" >
                <div class="form-group">
                 
                    <br>
                       
                       <br><br>
                    <button id="btnEnviar" class="btn btn-success">Enviar</button>
                </div><br><br>
                <div class="alert alert-info" id="estado"></div>
            </div>  
        </div>
    </div>

    <script src="scriptt.js"></script>

</body>
<footer>copyright</footer>
</html>