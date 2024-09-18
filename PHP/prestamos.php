<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Pago de Prestamo</title>
       <style>
body {
margin: 0;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
background-color: #f0f0f0; /* Color de fondo del body */
}
.container {
width: 80%; /* Ancho de la caja */
max-width: 600px; /* Ancho máximo de la caja */
padding: 20px; /* Espaciado interno */
background-color: #ffffff; /* Color de fondo de la caja */
border: 1px solid #cccccc; /* Borde de la caja */
border-radius: 8px; /* Radio de borde */
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra */

}
header {
margin-bottom: 20px; /* Ajusta el margen según tus necesidades */
text-align: center; /* Centra el texto dentro del encabezado */
}
</style>
      
    </head>
    <div class="container">
    <body>
        <header>
            <h2 id="centrado">CASA DE PRESTAMO</h2>
            <img src="https://media.primicias.ec/2021/03/30032155/dolares-reuters-web.jpg" width="400" height="200" alt="prestamo"/>
            
        </header>
        <section>
        <?php
        error_reporting(0);
        
        $cliente = $_POST['txtCliente'];
        $monto = $_POST['txtMonto'];
        $cuotas = $_POST['selCuotas'];
        
        if ($cuotas==3)$sel3='SELECTED';else $sel3="";
        if ($cuotas==6)$sel6='SELECTED';else $sel6="";
        if ($cuotas==9)$sel9='SELECTED';else $sel9="";
        if ($cuotas==12)$sel12='SELECTED';else $sel12="";
        
        $mCliente='';
        $mMonto='';
        
        if (empty($cliente)){
            $mCliente='Debe ingresar el nombre del cliente';
        }
        if (empty($monto) || !is_numeric($monto)){
            $mMonto='Debe registrar correctamente el monto del prestamo';
        }
            elseif ($monto<=0) {
            $mMonto='El monto del prestamo no debe ser inferior a 0';
            }
            ?>
            <form method="POST" name="frmPrestamo" action="prestamos.php"  >
                <table border="0" width="650" cellspacing="10" cellpadding="0">
                    <tr>
                        <td width="">Cliente</td>
                        <td><input type="text" name="txtCliente" size="50" value="<?php echo $_POST['txtCliente']; ?>"/></td>
                        <td width="200" id="error"><?php echo $mCliente; ?></td>
                    </tr>
                     <tr>
                        <td>Monto Prestado</td>
                        <td><input type="text" name="txtMonto" value="<?php echo $_POST['txtMonto']; ?>"/></td>
                        <td id="error"><?php echo $mMonto; ?></td>
                    </tr>
                    <tr>
                        <td>Nº cuotas</td>
                        <td><select name="selCuotas" onchange="this.form.submit()">
                                <option value="3" <?php echo $sel3;?>>3</option>
                                <option value="6" <?php echo $sel6;?>>6</option>
                                <option value="9" <?php echo $sel9;?>>9</option>
                                <option value="12" <?php echo $sel12;?>>12</option>
                            </select></td>
                          <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Cotizar"/></td>
                    </tr>
                    </table>
                <table border="0" width="650" cellspacing="10" cellpadding="0">
                        <?php if(!empty($cliente)&& !empty($monto)){ ?>
                        <tr id="fila">
                            <td>Nº DE CUOTAS</td>
                            <td>FECHA DE PAGO</td>
                            <td>MONTO MENSUAL</td>
                        </tr>
                        <?php 
                            switch ($cuotas) {
                                case 3: $montoMensual=($monto*1.05)/$cuotas;break;
                                case 6: $montoMensual=($monto*1.07)/$cuotas;break;   
                                case 9: $montoMensual=($monto*1.10)/$cuotas; break; 
                                case 12: $montoMensual=($monto*1.20)/$cuotas; 
                                    }
                                    $fecha = date('d-m-Y');
                                    for($i=1;$i<=$cuotas;$i++){
                                   ?> 
                        <tr>
                            <td><?php echo $i. ' cuota'; ?></td>
                            <td><?php echo date('d/m/Y', strtotime("$fecha+$i month")); ?></td>
                            <td><?php echo '$' .number_format($montoMensual,'2','.',''); ?></td>
                        </tr>
                             <?php } ?>           
                    </table>
                            <?php } ?>   
            </form>
        </section>
        </div>
        <footer>
            <h6 id="centrado"></h6>
        </footer>
    </body>
</html>
