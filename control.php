<?php

//error_reporting(0);

// Incluimos el archivo de la comunicación serial en PHP
include 'PhpSerial.php';

// Iniciamos la clase PhpSerial para usar sus metodos.
$serial = new PhpSerial;

// Primero especificamos el puerto del arduino
$serial->deviceSet("/dev/ttyACM0");

// Ajustamos parametros de conexion. Los valores actuales son para el Arduino UNO R3
$serial->confBaudRate(9600);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->confFlowControl("none");

// Abrimos el puerto serial para conexiones
$serial->deviceOpen();

// Esperamos 2 segundos para que el arduino pueda mandar datos. Sin esto, no se recibe ningun dato del arduino.
sleep(2);

// Leemos los datos de temperatura, humedad y distancia del puerto serial.
$datos = $serial->readPort();
$sensores = explode(":", $datos);

if(isset( $_POST['estadoBomba'] )) {
    $serial->sendMessage(1);
} elseif (!isset($_POST['estadoBomba'])) {
    $serial->sendMessage(0);
}

// Cuando ya se haya realizado todo, cerramos el puerto.
$serial->deviceClose();

?>

<!DOCTYPE html> 
<html lang="en">

    <?php include("header.html"); ?>

        <div id="page-content-wrapper">
            <div id="page-content">
                <div class="container" style="width: 100%;">
                    <div id="page-title">
                        <h2>Dashboard</h2>
                        <p>Datos en tiempo real de los sensores</p>
                        <?php include("layout-switcher.html"); ?>
                    </div>

                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-success">
                                        <div class="tile-header">
                                            Humedad
                                        </div>
                                        <div class="tile-content-wrapper">
                                            <div class="chart-alt-10" data-percent="<?=$sensores['0'];?>"><span><?=$sensores['0'];?></span>%</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-info">
                                        <div class="tile-header">
                                            Temperatura
                                        </div>
                                        <div class="tile-content-wrapper">
                                            <div class="chart-alt-10" data-percent="<?=$sensores['1'];?>"><span><?=$sensores['1'];?></span> ° </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" title="Example tile shortcut" class="tile-box tile-box-alt btn-warning">
                                        <div class="tile-header">
                                            Distancia
                                        </div>
                                        <div class="tile-content-wrapper">
                                            <div class="chart-alt-10" data-percent="<?=$sensores['2'];?>"><span><?=$sensores['2'];?></span>CM</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                <h3 class="title-hero">
                                    Control del Riego
                                </h3>
                                    <div class="example-box-wrapper">
                                        <form id="bomba" method="post" action="" class="form-horizontal bordered-row">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Bomba</label>
                                                <div class="col-sm-6">
                                                    <input onchange="$('#bomba').submit();" <?php if(isset($_POST['estadoBomba'])) echo 'checked'; ?> type="checkbox" data-on-color="primary" name="estadoBomba" class="input-switch" data-size="medium" data-on-text="Encendida" data-off-text="Apagada">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .sb-site -->


<!-- WIDGETS -->

<script type="text/javascript" src="../../assets/bootstrap/js/bootstrap.js"></script>

<!-- Bootstrap Dropdown -->

<!-- <script type="text/javascript" src="../../assets/widgets/dropdown/dropdown.js"></script> -->

<!-- Bootstrap Tooltip -->

<!-- <script type="text/javascript" src="../../assets/widgets/tooltip/tooltip.js"></script> -->

<!-- Bootstrap Popover -->

<!-- <script type="text/javascript" src="../../assets/widgets/popover/popover.js"></script> -->

<!-- Bootstrap Progress Bar -->

<script type="text/javascript" src="../../assets/widgets/progressbar/progressbar.js"></script>

<!-- Bootstrap Buttons -->

<!-- <script type="text/javascript" src="../../assets/widgets/button/button.js"></script> -->

<!-- Bootstrap Collapse -->

<!-- <script type="text/javascript" src="../../assets/widgets/collapse/collapse.js"></script> -->

<!-- Superclick -->

<script type="text/javascript" src="../../assets/widgets/superclick/superclick.js"></script>

<!-- Input switch alternate -->

<script type="text/javascript" src="../../assets/widgets/input-switch/inputswitch-alt.js"></script>

<!-- Slim scroll -->

<script type="text/javascript" src="../../assets/widgets/slimscroll/slimscroll.js"></script>

<!-- Slidebars -->

<script type="text/javascript" src="../../assets/widgets/slidebars/slidebars.js"></script>
<script type="text/javascript" src="../../assets/widgets/slidebars/slidebars-demo.js"></script>

<!-- PieGage -->

<script type="text/javascript" src="../../assets/widgets/charts/piegage/piegage.js"></script>
<script type="text/javascript" src="../../assets/widgets/charts/piegage/piegage-demo.js"></script>

<!-- Screenfull -->

<script type="text/javascript" src="../../assets/widgets/screenfull/screenfull.js"></script>

<!-- Content box -->

<script type="text/javascript" src="../../assets/widgets/content-box/contentbox.js"></script>

<!-- Overlay -->

<script type="text/javascript" src="../../assets/widgets/overlay/overlay.js"></script>

<!-- Widgets init for demo -->

<script type="text/javascript" src="../../assets/js-init/widgets-init.js"></script>

<!-- Theme layout -->

<script type="text/javascript" src="../../assets/themes/admin/layout.js"></script>

<!-- Theme switcher -->

<script type="text/javascript" src="../../assets/widgets/theme-switcher/themeswitcher.js"></script>

</div>
</body>
</html>