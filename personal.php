
<!DOCTYPE html>
<html lang="es">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@900&display=swap" rel="stylesheet">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Lato', sans-serif;
            background-color: #f0f0f0; /* Color de fondo */
            text-align: center;
        }

        header {
            padding: 20px;
            background-color: #333; /* Color de fondo del encabezado */
            color: white;
        }

        #profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        #profile img {
            width: 750px; /* Ancho de la imagen */
            border-radius: 50%; /* Borde redondeado para la imagen */
            margin-bottom: 20px;
        }

        #profile h2 {
            margin-bottom: 10px;
        }

        #profile p {
            max-width: 800px;
            margin: 0 auto;
            font-size: 20px;
            line-height: 1.6;
        }
    </style>
    <title>Mi Perfil</title>
</head>
<body>

    <header>
        <h1>¿Quién soy?</h1>
        <a href="gene.php">Inicio</a>
  
    </header>

    <div id="profile">
        <img src="imagenes/yo.png" alt="Mi Foto">
        <h2>Reyli Isaí Sánchez Santos</h2>
        <p>
            Hola, soy Reyli, estudiante de tercer semestre de la licenciatura de Ciencias Genómicas en la
            ENES Juriquilla, me apasiona la programación y el diseño gráfico. Mis hobbies son leer, meditar, hacer ejercicio y tocar
            el bajo. Gracias por visitar mi página web.
        </p>
    </div>


</body>
</html>


