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

    if (isset($_GET['gene_id'])) {
        $gen_id = $_GET['gene_id'];

        // Realiza el primer query para obtener los detalles del gen
        $query = "SELECT GENE.gene_id, GENE.gene_name, GENE.gene_strand, GENE.gene_posright, GENE.gene_posleft, GENE.gene_sequence, OBJECT_SYNONYM.object_synonym_name
                  FROM GENE, OBJECT_SYNONYM
                  WHERE GENE.gene_id='" . $gen_id . "' 
                  AND OBJECT_SYNONYM.object_id = '" . $gen_id . "'";

        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Muestra los detalles del gen en una tabla
            echo '<h1>Detalles del Gen</h1>';
            echo '<table class="styled-table">';
            echo '<tr><th>Atributo</th><th>Valor</th></tr>';
            echo '<tr><td>Gene ID</td><td>' . $row['gene_id'] . '</td></tr>';
            echo '<tr><td>Nombre del Gen</td><td>' . $row['gene_name'] . '</td></tr>';
            echo '<tr><td>Strand</td><td>' . $row['gene_strand'] . '</td></tr>';
            echo '<tr><td>Posición Derecha</td><td>' . $row['gene_posright'] . '</td></tr>';
            echo '<tr><td>Posición Izquierda</td><td>' . $row['gene_posleft'] . '</td></tr>';
            echo '<tr><td>Secuencia del Gen</td><td>' . $row['gene_sequence'] . '</td></tr>';

            $sinonimos = "";

            while ($row = $result->fetch_assoc()) {
                $sinonimos .= $row['object_synonym_name'] . ', '; // Agrega cada sinónimo a la variable
            }
        
            // Elimina la coma extra al final y muestra los sinónimos en un solo renglón
            $sinonimos = rtrim($sinonimos, ', ');

            echo '<tr><td>Sinonimos</td><td>' . $sinonimos . '</td></tr>';


            echo '</table>';

            echo '<br>';

            $result->close();
        } else {
            echo 'No se encontraron detalles para el gen.';
        }

        // Realiza el segundo query para obtener los detalles del producto
        $query2 = "SELECT PRODUCT.product_name, PRODUCT.molecular_weigth, PRODUCT.isoelectric_point 
                   FROM GENE, GENE_PRODUCT_LINK, PRODUCT 
                   WHERE GENE.gene_id = GENE_PRODUCT_LINK.gene_id 
                   AND GENE_PRODUCT_LINK.product_id = PRODUCT.product_id 
                   AND GENE.gene_id = '" . $gen_id . "'";

        $result2 = $mysqli->query($query2);

        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            
            // Muestra los detalles del producto en una tabla
            echo '<h1>Detalles del Producto</h1>';
            echo '<table class="styled-table">';
            echo '<tr><th>Atributo</th><th>Valor</th></tr>';
            echo '<tr><td>Nombre del producto</td><td>' . $row2['product_name'] . '</td></tr>';
            echo '<tr><td>Peso molecular</td><td>' . $row2['molecular_weigth'] . '</td></tr>';
            echo '<tr><td>Punto isoelectrico</td><td>' . $row2['isoelectric_point'] . '</td></tr>';
            echo '</table>';

            echo '<br>';


            $result2->close();
        } else {
            echo 'No se encontraron detalles para el producto.';
        }
	
	//Realiza el tercer query para obtener los detalles del operon
	$query3 = "SELECT OPERON.operon_name, OPERON.operon_id
		   FROM GENE, TU_GENE_LINK, TRANSCRIPTION_UNIT, OPERON
		   WHERE GENE.gene_id = TU_GENE_LINK.gene_id
		   AND TRANSCRIPTION_UNIT.transcription_unit_id =TU_GENE_LINK.transcription_unit_id
		   AND OPERON.operon_id = TRANSCRIPTION_UNIT.operon_id
		   AND GENE.gene_id = '" . $gen_id . "'";

       $result3 = $mysqli->query($query3);

        if ($result3->num_rows > 0) {
            $row3 = $result3->fetch_assoc();

	            // Muestra los detalles del producto en una tabla
            echo '<h1>Detalles del operon</h1>';
            echo '<table class="styled-table">';
            echo '<tr><th>Atributo</th><th>Valor</th></tr>';
            echo '<tr><td>Nombre del operon</td><td><a href="/ReyliIsaiSanchezSantos/operon_details.php?operon_id=' . $row3['operon_id'] . '">' . $row3['operon_name'] . '</a></td></tr>';
            echo '<tr><td>id del operon</td><td>' . $row3['operon_id'] . '</td></tr>';
            
            echo '</table>';

            $result3->close();
        } else {
            echo 'No se encontraron detalles para el operon.';
        }

    } else {
        echo 'No se proporcionó un gene_id válido.';
    }
}

// Cierra la conexión a la base de datos
$mysqli->close();
?>
</body>
</html>
