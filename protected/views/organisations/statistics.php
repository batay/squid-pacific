<?php
/* @var $this OrganisationsController */
 ?>
 
 
 
 
<div id="content" class="col-lg-12"> 
 <!-- PAGE HEADER-->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h3 class="content-title pull-left">İstatistik</h3> 
                <div class="action_bar_spacer"></div> 
                <h4 class="pull-left org_name_top" href="#"><i class="fa fa-briefcase"></i> <?php echo $organisation->organisation_name ?></h4>
                
                
                <!-- <a class="btn btn-warning pull-right org_upgrade_packet" href="/organisations/selectPlan?id=<?php echo $id?>&current=<?php echo $plan->transaction_explanation?>">
					<i class="fa fa-arrow-up"></i>
					<span>Paketini Yükselt/Yenile</span>
				</a> -->
                
            </div>
		</div>
	</div>
	<!-- /PAGE HEADER -->
 
 
 	<div class="row">
 
 
 										<div class="col-md-12">
											 <div class="panel panel-default">
												<div class="panel-body">
													 <div class="tabbable">
														<ul class="nav nav-tabs" style="font-size:15px;">
														   <li class="active"><a class="brand_text_color" href="#tab_1_1" data-toggle="tab"><i class="fa fa-book"></i> Kitaplar</a></li>
														   <li><a class="brand_text_color" href="#tab_1_2" data-toggle="tab"><i class="fa fa-money"></i> Satışlar</a></li>
														   <li><a class="brand_text_color" href="#tab_1_3" data-toggle="tab"><i class="fa fa-hdd-o"></i> Kullanım</a></li>
                                                           <li><a class="brand_text_color" href="#tab_1_4" data-toggle="tab"><i class="fa fa-bar-chart-o"></i> Trafik</a></li>
														</ul>
														<div class="tab-content">
														   <div class="tab-pane fade in active" id="tab_1_1">
															  <div class="divide-10"></div>
															  
                                                              <div class="statistics_of_books_box col-md-3">
                                                              	<div class="statistics_of_books_title">Okuyucu Sayısı</div>
                                                                <div class="statistics_of_books_viewer">56</div>
                                                              </div>
                                                              
                                                              <div class="statistics_of_books_box col-md-3">
                                                              	<div class="statistics_of_books_title">İndirilme Sayısı</div>
                                                                <div class="statistics_of_books_viewer">32</div>
                                                              </div>
                                                              
                                                              <div class="statistics_of_books_box col-md-3">
                                                              	<div class="statistics_of_books_title">Okunan Sayfa Sayısı</div>
                                                                <div class="statistics_of_books_viewer">158</div>
                                                              </div>
                                                              
                                                              <div class="statistics_of_books_box col-md-3">
                                                              	<div class="statistics_of_books_title">Harcanan Zaman (dk)</div>
                                                                <div class="statistics_of_books_viewer">525</div>
                                                              </div>
                                                              
                                                              
                                                              
														   </div>
														   <div class="tab-pane fade" id="tab_1_2">
																<div class="divide-10"></div>
															  	
                                                               
                                                               <div class="box-body big">									
										  <div class="sparkline-row">
											<span class="title">Revenue distribution</span>
											<span class="value"><i class="fa fa-usd"></i> 25674</span>
											<span class="sparklinepie">16,7,23</span>
										  </div>
										  <div class="sparkline-row">
											<span class="title">Sales</span>
											<span class="value"><i class="fa fa-money"></i> 19 999,99</span>
											<span class="sparklinepie">6,3,24,25</span>
										  </div>
										  <div class="sparkline-row">
											<span class="title">Employee/ Dept</span>
											<span class="value"><i class="fa fa-user"></i> 645783</span>
											<span class="sparklinepie">11,19,20</span>
										  </div>
									</div>
								</div>
								<!-- /BOX -->
                                                               
                                                               
                                                                
														   </div>
														   <div class="tab-pane fade" id="tab_1_3">
																<div class="divide-10"></div>
															  <p> Yesterday I was on my way to class, when a black cat fell from the sky. I didn't really know what that nonsense was about so I asked him if I could step around him because he was bad luck, but he simply meowed and then disappeared. I was a bit worried that maybe he'd teleported to somewhere dangerous, but a wizard came and assured me that it was alright. I threw my Zune at him because I was 78% sure he was lying. The wizard roared at me and sentenced my mother to thirty five years of chain smoking. I was sad. [do] </p>
														   </div>
                                                           <div class="tab-pane fade" id="tab_1_4">
																<div class="divide-10"></div>
															  <p> Yesterday I was on my way to class, when a black cat fell from the sky. I didn't really know what that nonsense was about so I asked him if I could step around him because he was bad luck, but he simply meowed and then disappeared. I was a bit worried that maybe he'd teleported to somewhere dangerous, but a wizard came and assured me that it was alright. I threw my Zune at him because I was 78% sure he was lying. The wizard roared at me and sentenced my mother to thirty five years of chain smoking. I was sad. [do] </p>
														   </div>
														</div>
													 </div>
												 </div>
											 </div>
										  </div>
 

	</div> 
</div>

<script>
		jQuery(document).ready(function() {
		console.log("<?php echo $organisationId; ?>");	
		    $('#li_<?php echo $organisationId; ?>').addClass('current');	
			App.setPage("gallery");  //Set current page
			App.init(); //Initialise plugins and elements
		});
</script>



	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="/css/ui/js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<script src="/css/ui/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- BOOTSTRAP -->
	<script src="/css/ui/bootstrap-dist/js/bootstrap.min.js"></script>
	
		
	<!-- DATE RANGE PICKER -->
	<script src="/css/ui/js/bootstrap-daterangepicker/moment.min.js"></script>
	
	<script src="/css/ui/js/bootstrap-daterangepicker/daterangepicker.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="/css/ui/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="/css/ui/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>
	<!-- BLOCK UI -->
	<script type="text/javascript" src="/css/ui/js/jQuery-BlockUI/jquery.blockUI.min.js"></script>
	<!-- FLOT CHARTS -->
	<script src="/css/ui/js/flot/jquery.flot.min.js"></script>
	<script src="/css/ui/js/flot/jquery.flot.time.min.js"></script>
    <script src="/css/ui/js/flot/jquery.flot.selection.min.js"></script>
	<script src="/css/ui/js/flot/jquery.flot.resize.min.js"></script>
    <script src="/css/ui/js/flot/jquery.flot.pie.min.js"></script>
    <script src="/css/ui/js/flot/jquery.flot.stack.min.js"></script>
    <script src="/css/ui/js/flot/jquery.flot.crosshair.min.js"></script>
	<!-- FLOT GROWRAF -->
	<script src="/css/ui/js/flot-growraf/jquery.flot.growraf.min.js"></script>
	<!-- GAGE -->
	<script src="/css/ui/js/justgage/js/raphael.2.1.0.min.js"></script>
    <script src="/css/ui/js/justgage/js/justgage.1.0.1.min.js"></script>
	<!-- EASY PIE CHART -->
	<script src="/css/ui/js/jquery-easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="/css/ui/js/easypiechart/jquery.easypiechart.min.js"></script>
	<!-- SPARKLINES -->
	<script type="text/javascript" src="/css/ui/js/sparklines/jquery.sparkline.min.js"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="/css/ui/js/jQuery-Cookie/jquery.cookie.min.js"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="/css/ui/js/script.js"></script>
	<script src="/css/ui/js/charts.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("others");  //Set current page
			App.init(); //Initialise plugins and elements
			Charts.initOtherCharts(); //Init other charts
		});
	</script>
	<!-- /JAVASCRIPTS -->