<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Factura</title>
        <style>
            @import url('../assets/fonts/BrixSansRegular.css');
            @import url('../assets/fonts/BrixSansBlack.css');
            p, label, span, table {
                font-family: 'BrixSansRegular';
                font-size: 10pt;
            }
            .h2 {
                font-family: 'BrixSansBlack';
                font-size: 16pt;
            }
            .h3 {
                font-family: 'BrixSansBlack';
                font-size: 12pt;
                display: block;
                background: #0a4661;
                color: #FFF;
                text-align: center;
                padding: 3px;
                margin-bottom: 5px;
            }
            #page_pdf {
                width: 95%;
                margin: 15px auto 10px auto;
            }
            #html_head, #factura_cliente, #detalle_head {
                width: 100%;
                margin-bottom: 10px;
            }
            .info_empresa {
                width: 50%;
                text-align: center;
            }
            .datos_cliente tr td {
                width: 50%;
            }
            .datos_cliente {
                width: 100%;
                padding: 10px 10px 0 10px;
            }
            .datos_cliente label {
                width: 75px;
                display: inline-block;
            }
            .datos_cliente p {
                display: inline-block;
            }
            .round {
                border-radius: 10px;
                border: 1px solid #0a4661;
                overflow: hidden;
                padding-bottom: 15px;
            }
            .round p {
                padding: 0 10px;
            }
            #detalle_head {
                border-collapse: collapse;
            }
            #detalle_head thead th {
                background: #058167;
                color: #FFF;
                padding: 5px;
            }
            #detalle_body tr:nth-child(even) {
                background: #ededed;
            }
            #detalle_totales span {
                font-family: 'BrixSansBlack';
            }
            .label_gracias {
                font-family: verdana;
                font-weight: bold;
                font-style: italic;
                text-align: center;
                margin-top: 20px;
            }
            .logo-block {
                text-align: center;
                min-width: 100px;
                margin: 0 auto;
                border-radius: 5px;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div id="page_pdf">
            <table id="html_head">
                <tr>
                    <td style="width: 25%;">
                    <div class="logo-block">
                        <img src="http://marcsoft.com.co/logo.png" style="width:100px;height:100px;">
                    </div>
                    </td>
                    <td class="info_empresa">
                    <div>
                        <span class="h2"><strong>Ciudadano</strong>Sano</span>
                        <p><strong>Sede:</strong> <?php echo $invoice->seat; ?> </p>
                        <p><strong>Teléfono:</strong> <?php echo $invoice->cell_phone; ?> </p>
                        <p><strong>Dirección:</strong> <?php echo $invoice->address; ?> </p>
                    </div>
                    </td>
                    <td style="width: 25%;">
                    <div class="round">
                        <span class="h3">Factura</span>
                        <p><strong>No. Factura:</strong> <?php echo $invoice->id; ?> </p>
                        <p><strong>Fecha:</strong> <?php echo date_format(date_create($invoice->created_at), 'd/m/Y'); ?> </p>
                        <p><strong>Vendedor:</strong> <?php echo $invoice->employe; ?> </p>
                    </div>
                    </td>
                </tr>
            </table>
        <table id="factura_cliente">
            <tr>
                <td style="width: 100%;">
                    <div class="round">
                        <span class="h3">Cliente</span>
                        <table class="datos_cliente">
                            <tr>
                                <td style="text-align: center;"><strong>Identificación:</strong> <?php echo $invoice->no_document; ?> </td>
                                <td style="text-align: center;"><strong>Nombre:</strong> <?php echo $invoice->client; ?> </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <table id="detalle_head">
        <thead>
            <tr>
            <th width="50px">Cant.</th>
            <th style="text-align: left;">Descripción</th>
            <th style="text-align: right;" width="150px">Precio Unitario</th>
            <th style="text-align: right;" width="150px">Precio Total</th>
            </tr>
        </thead>
            <?php foreach($mov as $key => $v) { ?>
                <tr>
                    <td style="text-align: center;"><?php echo $v['count']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                    <td style="text-align: right;"><?php echo number_format($v['price']); ?></td>
                    <td style="text-align: right;"><?php echo number_format($v['total']); ?></td>
                </tr>
            <?php } ?>       
        </tbody>
        <tfoot id="detalle_totales">
            <tr>
            <td colspan="3" style="text-align: right;"><strong>Subtotal:</strong></td>
            <td style="text-align: right;"><span><?php echo number_format($invoice->total); ?></span></td>
            </tr>
            <tr>
            <td colspan="3" style="text-align: right;"><strong>Iva (19 %):</strong></td>
            <td style="text-align: right;"><span><?php echo number_format($invoice->iva); ?></span></td>
            </tr>
            <tr>
            <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
            <td style="text-align: right;"><span><?php echo number_format($invoice->neto); ?></span></td>
            </tr>
        </tfoot>
        </table>
        <div>
            <h4 class="label_gracias">¡Gracias por su compra!</h4>
        </div>
    </div>
    </body>
</html>