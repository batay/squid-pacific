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
											 <div class="panel panel-default" style="margin-bottom:50px;">
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
																<div class="divide-10" style="height:30px"></div>
															  	
                                                             <div class="col-md-6">
                                                               <div id="piechart" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; width: 100%; overflow:auto;"></div>
                                                             </div>
                                                             
                                                             <div class="col-md-6">
                                                               <div id="piechart2" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; width: 100%; overflow:auto;"></div>
                                                             </div>
                                                             
                                                             <div class="col-md-12" style="margin-top:30px;">
                                                                <div id="chart_div" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; max-width: 100%; overflow:auto;"></div>
                                                             </div>
                                                             
                                                             <div class="col-md-12" style="margin-top:30px;">
                                                             	<div id="chart_div2" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; max-width: 100%; overflow:auto;"></div>
                                                             </div>
                                                             
                                                             <div class="col-md-12" style="margin-top:30px;">
                                                             	<div id="chart_div3" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; max-width: 100%; overflow:auto;"></div>
                                                             </div>
                                                             
                                                             <div class="col-md-12" style="margin-top:30px;">
                                                             	<div id="chart_div4" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; max-width: 100%; overflow:auto;"></div>
                                                             </div>
                                                             
                                                             
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



<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	 setTimeout(function(){google.load('visualization', '1', {'callback': function (){
		 		
	
			  
			  
			  				  $(function () {

			  //<!-- SALES CHART -->
			  
				var data = google.visualization.arrayToDataTable([
				  ['Task', 'Hours per Day'],
				  ['Yeni Müşteri',     120],
				  ['Varolan Müşteri',      283],
				]);
		
				var options = {
				  title: 'Satışlar',
				  width: 600,
				  height:450,
				  left: 50,
				  top:50,
				  fontName: 'Open Sans',
				  titleTextStyle: { color: '#303030', fontSize: 25, bold: 0 }
				};
		
				var chart = new google.visualization.PieChart(document.getElementById('piechart'));
				chart.draw(data, options);
			 
			
		
			//<!-- VIEWS CHART -->    
			
			  
				var data = google.visualization.arrayToDataTable([
				  ['Task', 'Hours per Day'],
				  ['Yeni Kullanıcı',     68],
				  ['Varolan Kullanıcı',      120],
				]);
		
				var options = {
				  title: 'Görünümler',
				  width: 600,
				  height:450,
				  left: 50,
				  top:50,
				  fontName: 'Open Sans',
				  titleTextStyle: { color: '#303030', fontSize: 25, bold: 0 }
				};
		
				var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
				chart.draw(data, options);
			  
		
		
		//<!-- INCOME CHART -->
		
			
				var data = google.visualization.arrayToDataTable([
				  ['Year', 'Günlük Gelir', 'Günlük Satılan Kitap Miktarı', 'Günlük Ortalama Gelir'],
				  ['10 Şub',  1400,      400,      200],
				  ['11 Şub',  1170,      460,      350],
				  ['12 Şub',  660,       1120,      420],
				  ['13 Şub',  1030,      540,      180],
				  ['14 Şub',  1030,      540,      500],
				  ['15 Şub',  1030,      540,      125],
				  ['16 Şub',  1030,      540,      125],
				]);
		
				var options = {
				  title: 'Gelir Grafiği',
				  hAxis: {title: 'Günler',  titleTextStyle: {color: '#333'}},
				  vAxis: {minValue: 0},
				  width: 1450,
				  height:550,
				  left: 0,
				  top:50,
				  fontName: 'Open Sans',
				  titleTextStyle: { color: '#303030', fontSize: 25, bold: 0 },
				};
		
				var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			  
		
			
			
		
			
			
		//<!-- PUBLISHED BOOKS - CATEGORIES CHART -->   
				
				var data2 = google.visualization.arrayToDataTable([
				  ['Year', "Kategori 1'de yayınlanan Kitap Sayısı", "Kategori 2'de yayınlanan Kitap Sayısı", "Kategori 3'de yayınlanan Kitap Sayısı"],
				  ['10 Şub',  1000, 1000, 900],
				  ['11 Şub',  117, 1100, 500],
				  ['12 Şub',  660, 1200, 700],
				  ['13 Şub',  660, 1200, 700],
				  ['14 Şub',  660, 1200, 700],
				  ['15 Şub',  660, 1200, 700],
				  ['16 Şub',  1030, 800, 800],
				]);
		
				var options2 = {
				  title: 'Kategorilerine Göre Satılan Kitaplar',
				  width: 1450,
				  height:750,
				  left: 0,
				  top:50,
				  fontName: 'Open Sans',
				  titleTextStyle: { color: '#303030', fontSize: 25, bold: 0 },
				};
		
				var chart2 = new google.visualization.BarChart(document.getElementById('chart_div2'));
				chart2.draw(data2, options2);
			 
			   
		//<!-- GEO CHART -->   
			   
			   
			   var data = google.visualization.arrayToDataTable([
				  ['Ülke', 'Satış Miktarı'],
				  ['Germany', 200],
				  ['United States', 300],
				  ['Brazil', 400],
				  ['Canada', 500],
				  ['France', 600],
				  ['RU', 700]
				]);
		
				var options = {
				  width: 1450,
				  height:750,
				  left: 0,
				  top:50,	
				};
		
				var chart = new google.visualization.GeoChart(document.getElementById('chart_div3'));
				chart.draw(data, options);
			   
		//<!-- LANGUAGE CHART -->   
			   
			  var data = google.visualization.arrayToDataTable([
				  ['Year', 'Satış Miktarı'],
				  ['Türkçe',  1000],
				  ['İngilizce',  100],
				  ['Almanca',  660],
				  ['Fransızca',  100],
				  ['İtalyanca',  1170],
				  ['Çince',  680],
				  ['Japonca',  200],
				  ['İspanyolca',  1070],
				  ['Romence',  60],
				  ['Yunanca',  300],
				  ['Fince',  1560],
				  ['Arapça',  660],
				  ['Azerice',  1000],
				  ['Rusça',  1170],
				  ['Bulgarca',  660],
				  ['Slovakça',  1030]
				]);
		
				var options = {
				  width: 1450,
				  height:750,
				  left: 0,
				  top:50,
				  fontName: 'Open Sans',
				  titleTextStyle: { color: '#303030', fontSize: 25, bold: 0 },
				  title: 'Kullanıcıların Dillerine Göre Satışlar',
				  hAxis: {title: 'Diller', slantedText: 'true'},
				  bar: {groupWidth: 15},
				  legend: {position: 'none'},
				};
		
				var chart = new google.visualization.ColumnChart(document.getElementById('chart_div4'));
				chart.draw(data, options); 
			  
			   
			   
			   
			   });
			  
	  			
				 
	 }
	, 'packages':['corechart']});
	  }, 2000);
    </script>
    
    <style type="text/css">
		#chart_div svg{
			width:1500px !important;
		}
	</style>