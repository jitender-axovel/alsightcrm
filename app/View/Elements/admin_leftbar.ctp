<li class="gn-trigger">
	<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
		<nav class="gn-menu-wrapper">
			<div class="gn-scroller">
				<ul class="gn-menu">
                                      <?php if($this->Session->read('Auth.User.role')=="admin") { ?>
					<li class="gn-search-item">
						<a href="/alsightcrm/employees/index" class="gn-search" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-user"></span>Employee<span class="caret"></span>
						</a>
					</li>
                                      <?php } ?>
                                      <?php if($this->Session->read('Auth.User.role')=="company") { ?>
					<li class="gn-search-item">
						<a href="/alsightcrm/employees/index/company" class="gn-search" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-user"></span>Employee<span class="caret"></span>
						</a>
					</li>
                                      <?php } ?>
					<li>
						<a href="/alsightcrm/opportunities" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-hand-o-right"></span>Opportunities<span class="caret"></span>
						</a>
					</li>
					<li>
						<a href="/alsightcrm/activities" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-info-circle"></span>Activities<span class="caret"></span>
						</a>
					</li>
                                         <?php if($this->Session->read('Auth.User.role')=="admin") { ?>
					<li>
						<a href="/alsightcrm/crm_companies" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-building-o"></span>CRM_Companies<span class="caret"></span>
						</a>
<!--						<ul class="gn-submenu">
							<li>
								<a href="/alsightcrm/companies/index" class="manage-company">
									<span class="fa fa-cog"></span>Manage Company<span class="caret"></span>
								</a>
							</li>
							<li>
								<a href="/alsightcrm/companies/add" class="add">
									<span class="fa fa-plus-square"></span>Add Company<span class="caret"></span>
								</a>
							</li>
						</ul>-->
					</li>
                                         <?php } ?>
                                        <?php if($this->Session->read('Auth.User.role')=="admin") { ?>
                                        <li>
						<a href="/alsightcrm/filters/ajax" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-info-circle"></span>Filter<span class="caret"></span>
						</a>
					</li>
                                        <?php } ?>
                                        <?php if($this->Session->read('Auth.User.role')=='company') { ?>
                                        <li>
						<a href="/alsightcrm/filters/company" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-info-circle"></span>Filter<span class="caret"></span>
						</a>
					</li>
                                        <?php } ?>
                    <!--<li>
						<a href="/alsightcrm/activities" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-info-circle"></span>Activities<span class="caret"></span>
						</a>
					</li>-->
					<li>
						<a href="/alsightcrm/contacts" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-mobile"></span>Contacts<span class="caret"></span>
						</a>
					</li>
					<!--<li>
						<a href="" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-envelope-o"></span>Emails<span class="caret"></span>
						</a>
					</li>
					<li>
						<a href="/alsightcrm/general" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-user"></span>General<span class="caret"></span>
						</a>
					</li>-->
                                        <?php if($this->Session->read('Auth.User.role')=="admin") { ?>
					<li>
						<a href="/alsightcrm/Company_Email_Configs" class="list-group-item" data-toggle="collapse" data-parent="#side-menu">
							<span class="fa fa-wrench"></span>Account Settings<span class="caret"></span>
						</a>
					</li>
                                        <?php } ?>
				</ul>
			</div><!-- /gn-scroller -->
		</nav>
	</li>