<?php defined( 'ABSPATH' ) or die( ':)' );
get_header('home'); ?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://kozioldev.eu/wp-content/plugins/n4gmap/style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-sm-12 col-md-9">
				<div class="jumbotron height" id="map-canvas"></div>
			</div>
			<div class="col-sm-12 col-md-3" style="text-align: center">
				<?php if(wp_get_current_user()->has_cap('edit_users')): ?>
				<button class="btn btn-success">Dodaj strefę</button>
				<?php endif; ?>
				<button class="btn btn-info" id="showAreaList">Lista stref</button>

				<div style="margin-top: 4rem">
					<p class="alert alert-danger footer">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Strefy, które znajdują się w niedostępnych miejsach, są ukryte.
					</p>

					<p class="alert alert-info footer">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Po kliknięciu flagi (obok nazwy strefy) możesz ją podejrzeć na mapie.
					</p>

					<p class="alert alert-warning footer">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Wielkie podziękowania dla <a href="https://net4game.com/user/112822-magnes-mob/">Magnes Mob</a> oraz <a href="https://net4game.com/user/123093-shopa-mob/">Shopa Mob</a> za sprawdzenie każdej strefy! :)
					</p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" tabindex="-1" role="dialog" id="areaList" aria-hidden="true">
  		<div class="modal-dialog" role="document">
   	 		<div class="modal-content">
     		 	<div class="modal-header">
        			<h5 class="modal-title">Lista stref</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>

     	 		<div class="modal-body">
				  	<table class="table" id="dataTable">
						<thead>
							<tr>
								<th>Strefa</th>
								<th>Cena</th>
								<th>Metraż</th>
								<th>Typ</th>
								<th>Zasięg Mobile 2.0</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(count($n4gmap_areas)) {
								foreach($n4gmap_areas as $i => $area) {
									if($area->type == 0) continue; ?>
									<tr data-id="<?=$i?>">
										<td><span class="navigateToArea">&#8251;</span> <?=$area->x?>x<?=$area->y?></td>
										<td><?=$area->price?></td>
										<td><?=$area->surface?></td>
										<td><?=($area->type == 1 ? 'Każdy' : ($area->type == 2 ? 'Mieszkalny' : ($area->type == 3 ? 'Biznesowy' : 'N/I')))?></td>
										<td><?=($area->mobile ? 'Tak' : 'Nie')?></td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
      			</div>
    		</div>
  		</div>
	</div>

	<script>
	var TYPE_NONE = 0;
	var TYPE_ALL = 1;
	var TYPE_BUSINESS = 2;
	var TYPE_HOUSE = 3;
	var areas = <?php echo json_encode($n4gmap_areas)?>;
	</script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCB5MtvuJu58m1T9lm_Uq9PspY49m2Obz0"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="https://kozioldev.eu/wp-content/plugins/n4gmap/js/SanMap.min.js"></script>
	<script src="https://kozioldev.eu/wp-content/plugins/n4gmap/js/init.js"></script>
<?php get_footer(); ?>