<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CRM');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
    <head>
	<?php echo $this->Html->charset(); ?>
        <title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
        </title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min.css');
                //echo $this->Html->css('common.css');
                //echo $this->Html->css('login/css');
                //echo $this->Html->css('login/site');
                //echo $this->Html->css('login/stylesheets');
                echo $this->Html->css('bootstrap.css');
                echo $this->Html->css('cake.generic.css');
                //echo $this->Html->css('AdminLTE.css');
                //echo $this->Html->css('font-awesome.min.css');
                echo $this->Html->css('ionicons.min.css');
                echo $this->Html->css('css.css');
                //echo $this->Html->css('jQueryUI/jquery-ui-1.10.3.custom.min');
                //echo $this->Html->css('datatables/dataTables.bootstrap');
                //echo $this->Html->css('iCheck/*');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    </head>
    <body class="skin-blue">
        <div id="container">
            <div id="header" class="header">

            </div>

            <div id="content">
                <div class="wrapper">

                    <?php echo $this->fetch('content'); ?>

                    <div id="loading" style="display:none;">

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>