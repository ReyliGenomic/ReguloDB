<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="HojasDeEstilo/estilos_index.css">

  <title>ADNai</title>
</head>
<body>

  <div class="navbar">
    <div class="logo">
      <img src="imagenes/logo2" alt="Logo de tu página">
    </div>
    <div class="search-bar">
      <form method="get" action="regulon.php">
        <label for="gene-id">Nombre del gene u operón:</label>
        <input type="text" id="gene-id" name="name" onclick="clearText()" onblur="restoreText()">
        <input type="submit" name="enviar" value="Buscar" />
      </form>
    </div>
  
    <div class="nav-links">
      <a href="gene.php">Inicio</a>
      <a href="personal.php">Información Personal</a>
      <a href="<a href="/Descargas/regulondb.dump" download="regulondb.dump">Descarga 1</a>
      <a href="<a href="/Descargas/ER RegulonDB - ER RegulonDB.pdf" download="ER RegulonDB - ER RegulonDB.pdf">Descarga 2</a>

      <!-- Otros enlaces según tus necesidades -->
    </div>
  </div>

  <div id="large-header" class="large-header">
    <canvas id="demo-canvas"></canvas>
    <h1 class="main-title">ADNAI <span class="thin">El genoma de E.coli.</span></h1>
  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.0/gsap.min.js"></script>
  <script src="Java/dinamismo_index.js"></script>
  <script>
    function clearText() {
      var input = document.getElementById("gene-id");
      if (input.value === "Inserte el nombre del gene u operon") {
        input.value = "";
      }
    }

    function restoreText() {
      var input = document.getElementById("gene-id");
      if (input.value === "") {
        input.value = "Inserte el nombre del gene u operon";
      }
    }
  </script>

</body>
</html>



</body>
</html>

