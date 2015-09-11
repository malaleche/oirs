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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset();
        ?>

        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap-responsive.min');
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('jquery-ui');

        echo $this->Html->script('jquery-1.8.2.min');
        echo $this->Html->script('jquery.validate.min');
        echo $this->Html->script('additional-methods.min');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap.min');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container" class="container" style="margin-top: 20px;">
            <div id="header">
                <div class="navbar">
                    <div class="navbar-inner">
                        <a class="brand" href="#">OIRS-D</a>
                        <ul class="nav">
                            <li id="a1"><?php echo $this->Html->link('Usuarios', array('controller' => 'Users', 'action' => 'index')); ?></li>
                            <li id="a2"><?php echo $this->Html->link('Areas', array('controller' => 'Areas', 'action' => 'index')); ?></li>
                            <li><?php echo $this->Html->link('Tipos Ingresos', array('controller' => 'TiposIngresos', 'action' => 'index')); ?></li>
                            <li><?php echo $this->Html->link('Estados', array('controller' => 'Estados', 'action' => 'index')); ?></li>
                            <li><?php echo $this->Html->link('Unidades', array('controller' => 'Unidades', 'action' => 'index')); ?></li>
                            <li><?php echo $this->Html->link('Encuestas', array('controller' => 'Encuestas', 'action' => 'index')); ?></li>
                            <li id="a4"><?php echo $this->Html->link('Tipos Plazos', array('controller' => 'TiposPlazos', 'action' => 'index')); ?></li>
                            <li><?php echo $this->Html->link('Cerrar Sesion', array('controller' => 'Users', 'action' => 'logout')); ?></li>
                        </ul>
                    </div>
                    </di>
                </div>
                <div id="content">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>  
                </div>
                <div id="footer">

                </div>
            </div>
    </body>
</html>
