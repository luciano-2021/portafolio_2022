<?php
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

#session_start();
require_once("conexion/conexion_sql.php");
require_once('controller/html2pdf_v4.03/html2pdf.class.php');


if (isset($_GET["comprobanteVentas"])) {

	$stylo = "<style>
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
     
        </style>";

    $pagina = $stylo."<page>
		                <div class='margen'></div>
		                <div class='icono'><img class='img' src='img/logo.png' /></div>
		                <div class='date'>Santiago, ".date('d-m-Y')." </div>
		                <div class='title'><strong>Comprobante de Venta Electrónico </strong></div>                                        
		         
		         		<table>
		         			<tr>
		         				<td>N°</td>
		         				<td>Descripción</td>
		         				<td>Valor Initario</td>
		         				<td>Cantidad</td>
		         				<td>Total</td>
		         			</tr>
		         		</table>


		            </page>";

	$html2pdf = new HTML2PDF('P','latter','es');
    $html2pdf->WriteHTML($pagina);
	$html2pdf->Output('Comprobante.pdf');

}

	?>
