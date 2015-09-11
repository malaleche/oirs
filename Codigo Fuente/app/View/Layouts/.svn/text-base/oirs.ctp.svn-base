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
        echo $this->Html->css('core');
        
        echo $this->Html->script('jquery-1.8.2.min');
        echo $this->Html->script('jquery.validate.min');
        echo $this->Html->script('additional-methods.min');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('core');

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
                            <li id="a1"><?php echo $this->Html->link('Operaciones', array('controller' => 'Oirs', 'action' => 'index')); ?></li>
                            <li id="a2"><?php echo $this->Html->link('Control de anotaciones', array('controller' => 'Oirs', 'action' => 'desempenoMunicipal')); ?></li>
                            <li id="a3" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Configuracion OIRS <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php 
                                    if($this->Session->read('Auth.User.Rol.rol')=='oirs'):
                                    ?>
                                    <li><?php echo $this->Html->link('Administrar Usuarios', array('controller' => 'Users', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Administrar Areas', array('controller' => 'areas', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Administrar Tipos Ingresos', array('controller' => 'tiposIngresos', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Administrar Tipos Plazos', array('controller' => 'tiposPlazos', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Administrar Tipos Anotaciones', array('controller' => 'tiposAnotaciones', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Administrar Estados', array('controller' => 'estados', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Administrar Unidades', array('controller' => 'unidades', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Administrar Encuestas', array('controller' => 'encuestas', 'action' => 'index')); ?></li>
                                    <?php 
                                    endif;
                                    ?>
                                    <li><?php echo $this->Html->link('Mi Perfil', array('controller' => 'Users', 'action' => 'edit', $this->Session->read('Auth.User.id'))); ?></li>
                                </ul>
                            </li>
                            <li id="a4"><?php echo $this->Html->link('Buscador anotaciones', array('controller' => 'Anotaciones', 'action' => 'buscar')); ?></li>
                            <li><?php echo $this->Html->link('Cerrar Sesion', array('controller' => 'Users', 'action' => 'logout')); ?></li>
                        </ul>
                    </div>
                    </di>
                </div>
                <div id="content">
                    <div id="breadcrumb" class="well well-small">
                        <?php
                        echo $this->Html->getCrumbs(' > ', array(
                            'text' => 'Home',
                            'url' => array('controller' => 'Oirs', 'action' => 'index'),
                            'escape' => false
                        ));
//                        echo $this->Html->getCrumbs(' > ','Home');
                        ?>
                    </div>
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>  
                </div>
                <div id="footer">

                </div>
            </div>
    </body>
</html>

