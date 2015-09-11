<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap-responsive.min');
        echo $this->Html->css('bootstrap.min');

        echo $this->Html->script('jquery-1.8.2.min');
        echo $this->Html->script('bootstrap.min');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <script>
        $(document).ready(function() {
            var btn = document.URL.split('/');
            btn = btn.pop();
            if(!isNaN(btn)){
                var obj = '#a'.concat(btn);
                $(obj).addClass('active');
            }else{
                $('#a1').attr('class','active');
            }
        });
    </script>
    <body>
        <div id="container" class="container" style="margin-top: 20px;">
            <div id="header">
                <div class="navbar">
                    <div class="navbar-inner">
                        <a class="brand" href="#">OIRS-D</a>
                        <ul class="nav">
                            <li id="a1"><?php echo $this->Html->link('Operaciones', array('controller' => 'MenuEncargados', 'action' => 'resumenGeneral', '1')); ?></li>
                            <li id="a2"><?php echo $this->Html->link('Control de anotaciones', array('controller' => 'MenuEncargados', 'action' => 'controlAnotaciones', '2')); ?></li>
                            <li id="a3" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Configuracion OIRS <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><?php echo $this->Html->link('Administrar Usuarios', array('controller'=>'Users','action'=>'index','3')); ?></li>
                                        <li><a href="#">Administrar Areas</a></li>
                                        <li><a href="#">Administrar Tipos Ingresos</a></li>
                                        <li><a href="#">Administrar Tipos Plazos</a></li>
                                        <li><a href="#">Administrar Estados</a></li>
                                        <li><a href="#">Administrar Unidades</a></li>
                                        <li><a href="#">Administrar Encuestas</a></li>
                                        <li><a href="#">Administrar Mi Perfil</a></li>
                                    </ul>
                            </li>
                            <li id="a4"><?php echo $this->Html->link('Buscador anotaciones', array('controller' => 'MenuEncargados', 'action' => 'buscadorAnotaciones', '4')); ?></li>
                            <li><?php echo $this->Html->link('Cerrar Sesion', array('controller' => 'Users', 'action' => 'logout')); ?></li>
                        </ul>
                    </div>
                    </di>
                </div>
                <div id="content">
                    <?php echo $this->fetch('content'); ?>
                </div>
                <div id="footer">

                </div>
            </div>

    </body>
</html>

</html>

