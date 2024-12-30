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
                margin-left: 10px;
                margin-right: 10px;
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
            padding: 0;
            line-height: 1.5;
            color: #000;
            background-color: #f5f5f5;
            font-size: 16px;
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
            margin: 0;
        }


        .recipient {
            margin-top: 20px;
        }


        /* Asunto */
        .subject {
            margin-bottom: 10px;
            font-weight: bold;
            display: flex;
            justify-content: end;

            max-width: 300px;
            /* Ajusta el ancho para dividir las líneas */
            white-space: normal;
            word-break: break-word;
            /* Divide palabras si es necesario */

            /* Permite que el ancho respete el contenido */
            margin-left: auto;
            /* Empuja el elemento hacia la derecha */
        }


        /* Contenido del cuerpo */
        .body {
            text-align: justify;
            text-align-last: justify;
            margin-bottom: 30px;
        }

        p {
            margin-bottom: 30px;
        }

        /* Pie de página */
        .footer {
            margin-top: 30px;
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
            <div>{!! $datos['fecha'] ?? '' !!}</div>
            <strong>{!! $datos['nro_nota'] ?? '' !!}</strong>
        </div>

        <div class="recipient">
            {!! $datos['header'] ?? '' !!} desde aquii
        </div>

        <!-- Asunto -->
        <div class="subject">
            {{-- <p><strong>Ref.:</strong> Certificado de Registro de Inicio de Operaciones de Crédito Público</p> --}}

            <p>{!! $datos['referencia'] ?? '' !!}</p>
        </div>

        <!-- Contenido -->
        <p>De mi consideración:</p>
        <div class="body">
            {{-- {{ $datos['body'] ?? '' }} --}}
            {!! $datos['body'] ?? '' !!}
        </div>
        <p>Con este motivo, saludo a usted atentamente.</p>

        <!-- Pie de página -->
        <div class="footer">


            {!! $datos['revisado'] ?? '' !!}
        </div>
    </div>

</body>

</html>
