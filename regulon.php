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
error_reporting(E_ALL);
ini_set('display_errors', '1');
$name = isset($_GET['name']) ? $_GET['name'] : '';

?>

<?php
// Abre una conexión hacia MySQL
$mysqli = new mysqli("132.248.248.121:3306", "reguuser", "R3g@LcG3@22", "regulondb");

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    $res = $mysqli->query("SELECT * FROM OPERON  WHERE operon_name LIKE '%" . $name . "%' or  operon_id= '" . $name . "'");

    $num_rows = $res->num_rows;

    if ($num_rows > 0) {
        echo '<h1>Operones</h1>';
        echo '<table class="styled-table">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre del operon</th>';
        echo '</tr>';

        for ($i = 1; $i <= $num_rows; $i++) {
            $fila = $res->fetch_assoc();
            echo '<tr>';
            echo '<td>' .$fila ['operon_id'] . '</td>';
            echo '<td><a href="/ReyliIsaiSanchezSantos/operon_details.php?operon_id=' . $fila['operon_id'] . '">' . $fila['operon_name'] . '</a></td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No se encontraron resultados';
    }
    echo '<br>';
    $res = $mysqli->query("SELECT * FROM GENE  WHERE gene_name LIKE '%" . $name . "%' or  gene_id= '" . $name . "'");

    $num_rows = $res->num_rows;
    
    if ($num_rows > 0) {
        echo '<h1>Genes</h1>';
        echo '<table class="styled-table">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre del gene</th>';
        echo '<th>Posición Derecha</th>';
        echo '<th>Posición Izquierda</th>';
        echo '<th>Strand</th>';
        echo '</tr>';
    
        while ($fila = $res->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $fila['gene_id'] . '</td>';
            echo '<td><a href="/ReyliIsaiSanchezSantos/gene_details3.php?gene_id=' . $fila['gene_id'] . '">' . $fila['gene_name'] . '</a></td>';
            echo '<td>' . $fila['gene_posright'] . '</td>';
            echo '<td>' . $fila['gene_posleft'] . '</td>';
            echo '<td>' . $fila['gene_strand'] . '</td>';
            echo '</tr>';
        }
    
        echo '</table>';
    } else {
        echo 'No se encontraron resultados de Genes';
    }
    

    $res->close();
}
$mysqli->close();
?>
</body>
</html>

