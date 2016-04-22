<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>Administrator | <?php echo $title_for_layout; ?></title>
    <?php
        echo $this->fetch('meta');
        
        echo $this->Html->css('css');
        echo $this->Html->css('bootstrapadmin');
        echo $this->Html->css('admin');
		echo $this->Html->css('demo');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('normalize');
	echo $this->Html->css('component');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->script('jquery');
        echo $this->Html->script('bootstrap');
        echo $this->Html->script('gnmenu');
	echo $this->Html->script('modernizr.custom');
        echo $this->Html->script('classie');
    ?>
</head>
	<body>
		<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
                <?php echo $this->element('admin_leftbar'); ?>
				<li></li>
				<li><a class="crmhomelogo" href="/<?php echo Configure::read('SITENAME');?>"><span> CRM </span></a></li>
                                <li><a class="codrops-icon codrops-icon-drop" href="/<?php echo Configure::read('SITENAME');?>/users/users/logout"><span>Logout</span></a></li>
			</ul>
			<div class="row-offcanvas row-offcanvas-left">
				<div class="jumbotron">
                                       <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div><!-- /container -->
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>