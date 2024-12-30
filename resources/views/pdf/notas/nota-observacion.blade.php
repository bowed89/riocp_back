<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario PDF</title>
    <!-- Enlace al archivo CSS -->
    <link href="css/formulario1.css" rel="stylesheet" />

    <style>
        @media print {

            body,
            html {
                margin: 0;
                /* Elimina márgenes del body y html */
                padding: 0;
                /* Elimina padding del body y html */
                width: 100%;
                /* Asegúrate de que ocupe todo el ancho */
                height: auto;
                /* Asegúrate de que ocupe toda la altura */
            }

            .section {
                margin: 0;
                /* Ajusta los márgenes internos de la sección si es necesario */
                padding: 0;
                /* Evita padding si no lo deseas */
            }
        }

        /* General */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.5;
            color: #000;
            background-color: #f5f5f5;

        }

        /* Contenedor principal */
        .document-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 40px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Encabezado */
        .header {
            text-align: start;
            margin-bottom: 20px;
        }

        .header {
            margin: 0;
            font-size: 14px;
        }

        /* Destinatario */
        .recipient {
            margin-bottom: 20px;
        }

        .recipient .name {
            font-weight: bold;
        }

        .recipient .entity {
            margin: 5px 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .recipient .location {
            font-style: italic;
        }

        /* Asunto */
        .subject {
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Contenido del cuerpo */
        .body {
            text-align: justify;
            text-align-last: justify;
            margin-bottom: 10px;
        }

        /* Pie de página */
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: left;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario 1</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="document-container">



        <!-- Encabezado -->
        <div class="header">
            <p class="location">{!! $datos['fecha'] ?? '' !!}</p>
            <p class="reference"><strong>{!! $datos['nro_nota'] ?? '' !!}</strong></p>
        </div>

        <!-- Saludo -->
        {{-- <div class="recipient">
            <p>Señor</p>
            <p class="name">Jhonny Fernández Saucedo</p>
            <p>Alcalde</p>
            <p class="entity"><strong>GOBIERNO AUTÓNOMO MUNICIPAL DE SANTA CRUZ DE LA SIERRA</strong></p>
            <p class="location"><em>Santa Cruz</em></p>
        </div> --}}

        <div class="recipient">
            {!! $datos['header'] ?? '' !!}
        </div>

        <!-- Asunto -->
        <div class="subject">
            {{-- <p><strong>Ref.:</strong> Certificado de Registro de Inicio de Operaciones de Crédito Público</p> --}}

            <p>{!! $datos['referencia'] ?? '' !!}</p>
        </div>

        <!-- Contenido -->
        <div class="body">
            {{-- {{ $datos['body'] ?? '' }} --}}
            {!! $datos['body'] ?? '' !!}

        </div>

        <!-- Pie de página -->
        <div class="footer">
            {{--   <p>H.E.: 2024-5578-2</p>
            <p>TAE/JEV/ANAYA</p>
            <p>Adj.: Lo indicado</p> --}}

            {!! $datos['revisado'] ?? '' !!}
        </div>
    </div>


</body>

</html>
