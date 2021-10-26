<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Formula medica</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kurenaido&display=swap" rel="stylesheet">
        <style>
            @page {
                size: 21cm 29.7cm;
                margin: 0;
            }

            body {
                padding: .5in;
            }

            #page_pdf {
                width: 95%;
                margin: 15px auto 10px auto;
            }

            #html_head, #body-formula {
                width: 100%;
                margin-bottom: 10px;
            }

            .logo-block {
                text-align: center;
                min-width: 100px;
                background-color: #92a8d1;
            }

            .info_empresa {
                width: 50%;
                text-align: center;
                background-color: #92a8d1;
                font-family: 'Zen Kurenaido', sans-serif;
                padding-bottom: 10px;
            }

            .info_paci {
                background-color: #92a8d1;
                text-align: center;
            }

            .title {
                font-size: 25pt;
            }

            .title_formula {
                font-size: 15pt;
            }

            .title_paci {
                font-size: 15pt;
                font-weight: 'bold';
            }

            .name_paci {
                font-size: 9pt;
                margin: 0px !important;
            }

            .no_docu {
                font-size: 9pt;
                margin: 0px !important;
            }

            p {
                margin: -5px !important;
            }

            footer {
                position: fixed; 
                bottom: 0px; 
                left: 0px; 
                right: 0px;
                height: 50px;
                background-color: #92a8d1;
                color: #000;
                line-height: 35px;
            }

        </style>
    </head>
    <body>
        <div id="page_pdf">
            <table id="html_head">
                <tr>
                    <td style="width: 25%;" class="logo-block">
                        <img src="http://marcsoft.com.co/logo.png" style="width:100px; height:100px;">
                    </td>
                    <td class="info_empresa">
                        <p class="title"><strong>Ciudadano</strong>Sano </p>
                        <p class="title_formula"> <strong>Formula medica</strong> </p>
                        <p> <strong>NIT:</strong> 2510202127-1 </p>
                        <p> <strong>Teléfono:</strong> 322 8647766 </p>
                        <p> <strong>Email:</strong> info@ciudadanosano.com </p>
                    </td>
                    <td style="width: 25%; padding: 3px;" class="info_paci">
                        <span class="title_paci">Paciente</span>
                        <p class="name_paci"><strong>Nombre</strong> <br> $client</p>
                        <p class="no_docu"><strong>No documento</strong> <br> $no_document</p>
                    </td>
                </tr>
            </table>
            <table id="body-formula">
                <tr>
                    <td style="text-align: center; width: 100%;">
                        <h3 style="padding-top: 10pt;">Medicamentos</h3>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 100%; padding-top: 150pt;">
                        $formula
                    </td>
                </tr>
            </table>
        </div>
        <footer>
            <div style="float: left; margin-left: 10pt;">
                <strong>Sede:</strong> $seat
            </div>
            <div style="float: right; margin-right: 10pt;">
                <strong>Medico:</strong> $employe
            </div>
        </footer>
    </body>
</html>