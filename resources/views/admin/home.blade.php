@extends('admin.layouts.app')
@section('main-content')
	<div class="page-content">
		<!-- BEGIN PAGE HEAD-->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Admin Dashboard 2
					<small>statistics, charts, recent events and reports</small>
				</h1>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<div class="page-toolbar">
				<div id="dashboard-report-range" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" data-original-title="Change dashboard date range">
					<i class="icon-calendar"></i>&nbsp;
					<span class="thin uppercase hidden-xs"></span>&nbsp;
					<i class="fa fa-angle-down"></i>
				</div>
				<!-- BEGIN THEME PANEL -->
				<div class="btn-group btn-theme-panel">
					<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
						<i class="icon-settings"></i>
					</a>
					<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<h3>HEADER</h3>
								<ul class="theme-colors">
									<li class="theme-color theme-color-default active" data-theme="default">
										<span class="theme-color-view"></span>
										<span class="theme-color-name">Dark Header</span>
									</li>
									<li class="theme-color theme-color-light " data-theme="light">
										<span class="theme-color-view"></span>
										<span class="theme-color-name">Light Header</span>
									</li>
								</ul>
							</div>
							<div class="col-md-8 col-sm-8 col-xs-12 seperator">
								<h3>LAYOUT</h3>
								<ul class="theme-settings">
									<li> Theme Style
										<select class="layout-style-option form-control input-small input-sm">
											<option value="square">Square corners</option>
											<option value="rounded" selected="selected">Rounded corners</option>
										</select>
									</li>
									<li> Layout
										<select class="layout-option form-control input-small input-sm">
											<option value="fluid" selected="selected">Fluid</option>
											<option value="boxed">Boxed</option>
										</select>
									</li>
									<li> Header
										<select class="page-header-option form-control input-small input-sm">
											<option value="fixed" selected="selected">Fixed</option>
											<option value="default">Default</option>
										</select>
									</li>
									<li> Top Dropdowns
										<select class="page-header-top-dropdown-style-option form-control input-small input-sm">
											<option value="light">Light</option>
											<option value="dark" selected="selected">Dark</option>
										</select>
									</li>
									<li> Sidebar Mode
										<select class="sidebar-option form-control input-small input-sm">
											<option value="fixed">Fixed</option>
											<option value="default" selected="selected">Default</option>
										</select>
									</li>
									<li> Sidebar Menu
										<select class="sidebar-menu-option form-control input-small input-sm">
											<option value="accordion" selected="selected">Accordion</option>
											<option value="hover">Hover</option>
										</select>
									</li>
									<li> Sidebar Position
										<select class="sidebar-pos-option form-control input-small input-sm">
											<option value="left" selected="selected">Left</option>
											<option value="right">Right</option>
										</select>
									</li>
									<li> Footer
										<select class="page-footer-option form-control input-small input-sm">
											<option value="fixed">Fixed</option>
											<option value="default" selected="selected">Default</option>
										</select>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- END THEME PANEL -->
			</div>
			<!-- END PAGE TOOLBAR -->
		</div>
		<!-- END PAGE HEAD-->
		<!-- BEGIN PAGE BREADCRUMB -->
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="index.html">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span class="active">Dashboard</span>
			</li>
		</ul>
		<!-- END PAGE BREADCRUMB -->
		<!-- BEGIN PAGE BASE CONTENT -->
		<div class="row">
			<div class="col-lg-12 col-xs-12 col-sm-12">
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart font-dark hide"></i>
							<span class="caption-subject font-dark bold uppercase">Member Activity</span>
							<span class="caption-helper">weekly stats...</span>
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" data-toggle="buttons">
								<label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm active">
									<input type="radio" name="options" class="toggle" id="option1">Today</label>
								<label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
									<input type="radio" name="options" class="toggle" id="option2">Week</label>
								<label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
									<input type="radio" name="options" class="toggle" id="option2">Month</label>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="row number-stats margin-bottom-30">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="stat-left">
									<div class="stat-chart">
										<!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
										<div id="sparkline_bar"></div>
									</div>
									<div class="stat-number">
										<div class="title"> Total </div>
										<div class="number"> 2460 </div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="stat-right">
									<div class="stat-chart">
										<!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
										<div id="sparkline_bar2"></div>
									</div>
									<div class="stat-number">
										<div class="title"> New </div>
										<div class="number"> 719 </div>
									</div>
								</div>
							</div>
						</div>
						<div class="table-scrollable table-scrollable-borderless">
							<table class="table table-hover table-light">
								<thead>
								<tr class="uppercase">
									<th colspan="2"> MEMBER </th>
									<th> Earnings </th>
									<th> CASES </th>
									<th> CLOSED </th>
									<th> RATE </th>
								</tr>
								</thead>
								<tr>
									<td class="fit">
										<img class="user-pic rounded" src="../assets/pages/media/users/avatar4.jpg"> </td>
									<td>
										<a href="javascript:;" class="primary-link">Brain</a>
									</td>
									<td> $345 </td>
									<td> 45 </td>
									<td> 124 </td>
									<td>
										<span class="bold theme-font">80%</span>
									</td>
								</tr>
								<tr>
									<td class="fit">
										<img class="user-pic rounded" src="../assets/pages/media/users/avatar5.jpg"> </td>
									<td>
										<a href="javascript:;" class="primary-link">Nick</a>
									</td>
									<td> $560 </td>
									<td> 12 </td>
									<td> 24 </td>
									<td>
										<span class="bold theme-font">67%</span>
									</td>
								</tr>
								<tr>
									<td class="fit">
										<img class="user-pic rounded" src="../assets/pages/media/users/avatar6.jpg"> </td>
									<td>
										<a href="javascript:;" class="primary-link">Tim</a>
									</td>
									<td> $1,345 </td>
									<td> 450 </td>
									<td> 46 </td>
									<td>
										<span class="bold theme-font">98%</span>
									</td>
								</tr>
								<tr>
									<td class="fit">
										<img class="user-pic rounded" src="../assets/pages/media/users/avatar7.jpg"> </td>
									<td>
										<a href="javascript:;" class="primary-link">Tom</a>
									</td>
									<td> $645 </td>
									<td> 50 </td>
									<td> 89 </td>
									<td>
										<span class="bold theme-font">58%</span>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- END PAGE BASE CONTENT -->
	</div>
@endsection