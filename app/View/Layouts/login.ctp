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

?>
<!DOCTYPE html>
<html>
    <head>
	<?php echo $this->Html->charset(); ?>
        <title>
		<?php //echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
        </title>
	<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css('admin/bootstrap-cerulean.min');
	echo $this->Html->css('styles');
	echo $this->Html->css('admin/charisma-app'); 
	echo $this->Html->css('admin/bower_components/fullcalendar/dist/fullcalendar');
	echo $this->Html->css('admin/bower_components/fullcalendar/dist/fullcalendar.print');
	echo $this->Html->css('admin/bower_components/chosen/chosen.min');
	echo $this->Html->css('admin/bower_components/colorbox/example3/colorbox');
	echo $this->Html->css('admin/bower_components/responsive-tables/responsive-tables');
	echo $this->Html->css('admin/bower_components/bootstrap-tour/build/css/bootstrap-tour.min');
	echo $this->Html->css('admin/jquery.noty');
	echo $this->Html->css('admin/noty_theme_default');
	echo $this->Html->css('admin/elfinder.min');
	echo $this->Html->css('admin/elfinder.theme');
	echo $this->Html->css('admin/jquery.iphone.toggle');
	echo $this->Html->css('admin/uploadify');
	echo $this->Html->css('admin/animate.min');
        
	echo $this->Html->script('admin/bower_components/bootstrap/dist/js/bootstrap.min');
	echo $this->Html->script('admin/jquery.cookie');
	echo $this->Html->script('admin/bower_components/moment/min/moment.min');
	echo $this->Html->script('admin/bower_components/fullcalendar/dist/fullcalendar.min');
	echo $this->Html->script('admin/jquery.dataTables.min');
	echo $this->Html->script('admin/bower_components/chosen/chosen.jquery.min');
	echo $this->Html->script('admin/bower_components/colorbox/jquery.colorbox-min');
	echo $this->Html->script('admin/jquery.noty');
	echo $this->Html->script('admin/bower_components/responsive-tables/responsive-tables');
	echo $this->Html->script('admin/bower_components/bootstrap-tour/build/js/bootstrap-tour.min');
	echo $this->Html->script('admin/jquery.raty.min');
	echo $this->Html->script('admin/jquery.iphone.toggle');
	echo $this->Html->script('admin/jquery.autogrow-textarea');
	echo $this->Html->script('admin/jquery.uploadify-3.1.min');
	echo $this->Html->script('admin/jquery.history');
	echo $this->Html->script('admin/charisma');
        
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="container col-md-15" id="content">
		<?php echo $this->fetch('content'); ?>
                </div>
            </div>
            <hr>
            <div id="footer"></div>
        </div>
    </body>
</html>

