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
            }

            .info_empresa {
                width: 50%;
                text-align: center;
                font-family: 'Zen Kurenaido', sans-serif;
                padding-bottom: 10px;
            }

            .info_paci {
                text-align: center;
            }

            .title {
                font-size: 25pt;
            }

            .title_formula {
                font-size: 15pt;
            }

            .title_paci {
                font-size: 13pt;
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
                        <p class="title_formula"> Formula medica </p>
                        <p> <strong>Sede:</strong> $seat </p>
                        <p> <strong>Teléfono:</strong> $cell_phone </p>
                        <p> <strong>Dirección:</strong> $address </p>
                    </td>
                    <td style="width: 25%; padding: 3px; text-align: left;" class="info_paci">
                        <strong class="title_paci">Paciente</strong> <hr>
                        <p class="name_paci">$client</p>
                        <p class="no_docu">$no_document</p>
                        <strong class="title_paci">Medico</strong> <hr>
                        <p class="name_paci">$employe</p>
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
                    <td style="text-align: center; width: 100%; padding-top: 50pt;">
                        $formula
                    </td>
                </tr>
            </table>
        </div>
        <footer>
            
        </footer>
    </body>
</html>