<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="HojasDeEstilo/estilos.css">
    
</head>
<body>

<div class="navbar">
    <div class="logo">
      <img src="imagenes/logo2" alt="Logo de tu página">
    </div>
    <div class="search-bar">
      <form method="get" action="regulon.php">
        <label for="gene-id">Nombre del gene u operón:</label>
        <input type="text" id="gene-id" name="name" />
        <input type="submit" name="enviar" value="Buscar" />
      </form>
    </div>
    <div class="nav-links">
    <a href="gene.php">Inicio</a>
    </div>
  </div>


<?php

$mysqli = new mysqli("132.248.248.121:3306", "reguuser", "R3g@LcG3@22", "regulondb");

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    if (isset($_GET['operon_id'])) {
        $gen_id = $_GET['operon_id'];
	

	$query= "SELECT OPERON.operon_id, OPERON.operon_name
		 FROM OPERON
		 WHERE OPERON.operon_id= '" . $gen_id . "'";

        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Muestra los detalles del gen en una tabla
            echo '<h1>Detalles del Operon</h1>';
            echo '<table class="styled-table">';
            echo '<tr><th>Atributo</th><th>Valor</th></tr>';
            echo '<tr><td>Operon ID</td><td>' . $row['operon_id'] . '</td></tr>';
            echo '<tr><td>Nombre del operon</td><td>' . $row['operon_name'] . '</td></tr>';
            echo '</table>';

            echo '<br>';

            $result->close();
        } else {
            echo 'No se encontraron detalles para el operon.';
        }
        $query2 = "SELECT TRANSCRIPTION_UNIT.transcription_unit_name, TRANSCRIPTION_UNIT.transcription_unit_id, GENE.gene_name, OBJECT_SYNONYM.object_synonym_name
        FROM TRANSCRIPTION_UNIT
        LEFT JOIN TU_GENE_LINK ON TRANSCRIPTION_UNIT.transcription_unit_id = TU_GENE_LINK.transcription_unit_id
        LEFT JOIN GENE ON GENE.gene_id = TU_GENE_LINK.gene_id
        LEFT JOIN OBJECT_SYNONYM ON OBJECT_SYNONYM.object_id = TRANSCRIPTION_UNIT.transcription_unit_id
        WHERE TRANSCRIPTION_UNIT.operon_id= '" . $gen_id . "'";

        $result2 = $mysqli->query($query2);
        if (!$result2) {
            die('Error en la consulta: ' . $mysqli->error);
        }
        if ($result2->num_rows > 0) {
            // Muestra los detalles del gen en una tabla
            echo '<h1>Transcription unit</h1>';
            echo '<table class="styled-table">';
            echo '<tr><th>Atributo</th><th>Valor</th></tr>';
        
            $nombresTranscripcion = array();
            $nombresTranscripcionID = array();
            $genesTranscripcion = array();
            $sinonimosTranscripcion = array();
        
            while ($row2 = $result2->fetch_assoc()) {
                $nombresTranscripcion[] = $row2['transcription_unit_name'];
                $nombresTranscripcionID[] = $row2['transcription_unit_id'];
                $genesTranscripcion[] = $row2['gene_name'];
                $sinonimosTranscripcion[] = $row2['object_synonym_name'];
            }
        
            echo '<tr><td>Nombres</td><td>' . implode(', ', array_unique($nombresTranscripcion)) . '</td></tr>';
            echo '<tr><td>Id de Transcription Unit</td><td>' . implode(', ', array_unique($nombresTranscripcionID)) . '</td></tr>';
            echo '<tr><td>Nombre de los genes</td><td>' . implode(', ', array_unique($genesTranscripcion)) . '</td></tr>';
            echo '<tr><td>Sinonimos</td><td>' . implode(', ', array_unique($sinonimosTranscripcion)) . '</td></tr>';
        
            echo '</table>';
            echo '<br>';
        
            $result2->close();
        }
         else {
            echo 'No se encontraron detalles para la unidad de transcripción.';
        }
        
        $query3= "SELECT PROMOTER.promoter_id,PROMOTER.promoter_name
        FROM TRANSCRIPTION_UNIT, OPERON, PROMOTER
        WHERE OPERON.operon_id = TRANSCRIPTION_UNIT.operon_id
        AND TRANSCRIPTION_UNIT.promoter_id = PROMOTER.promoter_id
        AND OPERON.operon_id= '" . $gen_id . "'";

        $result3 = $mysqli->query($query3);
        if ($result3->num_rows > 0) {

            // Muestra los detalles del gen en una tabla
            echo '<h1>Promotor</h1>';
            echo '<table class="styled-table">';
            echo '<tr><th>Atributo</th><th>Valor</th></tr>';
            
            while ($row3 = $result3->fetch_assoc()) {
                $nombresPromotores .= $row3['promoter_name'] . ', ';
            }

            $nombresPromotores = rtrim($nombresPromotores, ', ');
            echo '<tr><td>Nombres</td><td>' . $nombresPromotores . '</td></tr>';
            echo '</table>';

            echo '<br>';

            $result3->close();

        } else {
        echo 'No se encontró información del promotor.';
        }
    }
}

// Cierra la conexión a la base de datos
$mysqli->close();
?>
</body>
</html>
