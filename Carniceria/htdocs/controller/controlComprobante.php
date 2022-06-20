<?php
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

#session_start();
require_once("conexion/conexion_sql.php");
require_once('controller/html2pdf_v4.03/html2pdf.class.php');


if (isset($_GET["comprobanteVentas"])) {

    $id = $_GET["comprobanteVentas"];
    $pdo = connect();

	$stylo =   "<style>
                    .margen{
                        margin-top: 40px;
                    }
                    .icono{
                        margin-right: 30px;
                        
                    }
                    .img{
                    	width: 200;
                    }
                    .head{
                        border-bottom: 1px solid black;
                    }
                    .title  {
                        margin-top: 40px;
                        text-align: center;
                        margin-top: 40px;
                    }
                     .title2  {
                        margin-top: 20px;
                        text-align: left;
                    }
                    .date{
                        text-align: right;
                        margin-right: 30px;
                    }
                    
                    .Detalletable {
                      width: 100%;
                      background-color: #FFFFFF;
                      border-collapse: collapse;
                      border-width: 1.5px;
                      border-color: #616161;
                      border-style: solid;
                      color: #000000;
                      empty-cells: hide;
                    }

                    .Detalletable td, .Detalletable th {
                      border-width: 1.5px;
                      border-color: #616161;
                      border-style: solid;
                      padding: 5px;

                    }
                    .tdUno{
                        width:30px;

                    }
                    .tdDos{
                        width:290px;

                    }
                    .tdTres{
                        width:100;

                    }
                    .tdCuatro{
                        width:50px;
                        text-align: center;
                    }
                    .tdCinco{
                        width:100px;
                        text-align: right;
                    }
                    .sinBorde {
                        border: 0
                        border-color: transparent;
                    }
                    .bor{
                        border-right-color: #616161;
                    }
                    .tdCli{
                        width: 120px;
                    }
                    .tdNomb{
                        width: 200px;
                    }
                    .pie{
                        font-size = 8px;
                        color: gray;
                        text-align: center;
                    }

                </style>";

    $pagina = $stylo."<page>
		                <div class='margen'></div>
		                <div class='icono'><img class='img' src='img/logo.png' /></div>
		                <div class='date'>Fecha Impresión, ".date('d-m-Y')." </div>
		                <div class='title'><strong>Comprobante de Venta Electrónico N° ".$id."</strong></div>                                        
		                <br>
                        <br>
		         		<table class='Detalletable'>
		         			<tr>
		         				<td>N°</td>
		         				<td>Descripción</td>
		         				<td>Valor Unitario</td>
		         				<td class='tdCuatro'>Cantidad</td>
		         				<td class='tdCinco'>Subtotal</td>
		         			</tr>";

		         		


    $sqlGen = "SELECT DATE_FORMAT(v.fecha_venta, '%d-%m-%Y'), v.monto_tota_neto, v.iva, concat(c.nombre, ' ',c.apellidos_paterno), v.fecha_despacho 
               FROM ventas v JOIN clientes c ON (v.clientes_id_cliente=c.id_cliente) 
               WHERE v.id_venta = ".$id;

    $sqlDet = " SELECT p.descripcion, p.precio, pv.cantidad
                FROM prod_venta pv JOIN productos p ON(pv.productos_id_prod = p.id_prod) 
                WHERE pv.ventas_id_venta = ".$id;

    $i = 1;
    foreach ($pdo->query($sqlDet) as $key) {
        
        $pagina .= "<tr>
                        <td class='tdUno'>".$i."</td>
                        <td class='tdDos'>".strtoupper($key[0])."</td>
                        <td class='tdTres'>".number_format($key[1], 0, ',', '.')."</td>
                        <td class='tdCuatro'>".number_format($key[2], 0, ',', '.')."</td>
                        <td class='tdCinco'>".number_format($key[1] * $key[2], 0, ',', '.') ."</td>
                    </tr>";
        $i++;
    }

    $neto   = "";  
    $iva    = "";   
    $total  = ""; 
    $nombre = "";
    $fecha  = ""; 
    $despacho  = ""; 

    foreach ($pdo->query($sqlGen) as $key) {
        
        $neto   = $key[1];
        $iva    = $key[2];
        $total  = $key[1] + $key[2];
        $nombre = $key[3];
        $fecha  = $key[0];
        $despacho  = $key[4];
    }

    $pagina .= "<tr>
                    <td class='sinBorde'></td>
                    <td class='sinBorde'></td>
                    <td class='sinBorde bor'></td>
                    <td class='tdCuatro'>Neto</td>
                    <td class='tdCinco'>".number_format($neto, 0, ',', '.')."</td>
                </tr>
                <tr>
                    <td class='sinBorde'></td>
                    <td class='sinBorde'></td>
                    <td class='sinBorde bor'></td>
                    <td class='tdCuatro'>IVA</td>
                    <td class='tdCinco'>".number_format($iva, 0, ',', '.')."</td>
                </tr>
                <tr>
                    <td class='sinBorde'></td>
                    <td class='sinBorde'></td>
                    <td class='sinBorde bor'></td>
                    <td class='tdCuatro'>Total</td>
                    <td class='tdCinco'>".number_format($total, 0, ',', '.')."</td>
                </tr>
                </table>
                <br>
                <br>";
                
    $pagina .= "<table class='Detalletable'>
                    <tr>
                        <td class='tdCli'>Cliente</td>
                        <td class='tdNomb'>".strtoupper($nombre)."</td>
                    </tr>
                    <tr>
                        <td class='tdCli'>Fecha Compra</td>
                        <td class='tdNomb'>".$fecha."</td>
                    </tr>
                    <tr>
                        <td class='tdCli'>Despacho</td>
                        <td class='tdNomb'>".$despacho."</td>
                    </tr>
                </table>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class='pie'>
                    Carnes Toño &reg; - Dirección: Avenida Gran Vía n° 1990, San Bernardo, Chile.<br>
                    Fono atención a clientes desde móviles +56 9 8766 4555, o desde red fija al 2 2220 2678. <br>
                    Comprobante de Venta Valido Como Boleta.


                </div>
                </page>";

	$html2pdf = new HTML2PDF('P','latter','es');
    $html2pdf->WriteHTML($pagina);
	$html2pdf->Output('Comprobante.pdf');

}

	?>
