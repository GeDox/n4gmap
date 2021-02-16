<?php
/*
 * Template Name: Mapa stref net4game
 * Description: Interaktywna mapa stref serwera <a href="https://net4game.com">net4game.com</a>.
 */
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>

	<title>Mapa stref NET4Game.com</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light navbar-dark bg-dark">
		<!--<a class="navbar-brand" href="#">Navbar w/ text</a>-->

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active" style="border-right: 1px solid white">
					<a class="nav-link" href="https://net4game.com">net4game.com</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#podziekowania">Autorstwo i podziękowania</a>
				</li>
			</ul>
			<span class="navbar-text">
				<a href="https://kozioldev.eu">KoziolDev.eu</a> &copy; 2018; Wszelkie prawa zastrzeżone.
			</span>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-6">
				<div class="alert alert-warning text-center" role="alert">
					Po kliknięciu flagi (obok nazwy strefy) możesz ją podejrzeć na mapie.
				</div>
				<div class="alert alert-info text-center" role="alert">
					Strefy, które znajdują się w niedostępnych miejsach, są ukryte.
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div id="mapid"></div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="podziekowania" tabindex="-1" role="dialog" aria-labelledby="modalPodziekowania" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalPodziekowania">Autorstwo i podziękowania</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="text-center mb-2">
						<strong>Projekt i wykonanie:</strong></br>
						<a href="https://kozioldev.eu" target="_blank">Przemysław "Szemek/Przemus/GeDox" Kozłowski</a>
					</div>

					W projekcie wykorzystano:</br>
					<ul>
						<li><strong>CMS:</strong> <a href="https://wordpress.com/" target="_blank">WordPress</a></li>
						<li><strong>Warstwa wizualna:</strong> <a href="https://getbootstrap.com/" target="_blank">Twitter Bootstrap</a></li>
						<li><strong>Silnik mapy:</strong> <a href="https://leafletjs.com/" target="_blank">LeafletJS</a></li>
						<li><strong>Zdjęcia mapy:</strong> <a href="http://forum.sa-mp.com/member.php?u=76946" target="_blank">SanMap by ikkentim</a></li>
					</ul>

					Wielkie podziękowania dla (kolejność przypadkowa):</br>
					<ul>
						<li><a href="https://net4game.com/user/112822-magnes-mob/" target="_blank">Magnes Mob</a></li>
						<li><a href="https://net4game.com/user/123093-shopa-mob/" target="_blank">Shopa Mob</a></li>
						<li><a href="https://net4game.com/user/128770-skino/" target="_blank">Skino</a></li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js" integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q==" crossorigin=""></script>

	<style>
		html, body, #mapid, .row { height: 100% }
		.nav { height: 56px }

		.container-fluid { margin-top: 15px; height: calc(100% - 56px - 30px) }

		#mapid { width: 100%; border-radius: 5px }
		.info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } 
		.info h3 { margin: 0 0 5px; color: #777; }
	</style>

	<script>
		$(document).ready(function() {
			var mymap = L.map('mapid').setView([0, 0], 1);

			var LTileLayerExtended = L.TileLayer.extend({    
				_isValidTile: function (coords) {
					var maxTiles = [
						{'x': 0, 'y': 0},
						{'x': 1, 'y': 1},
						{'x': 3, 'y': 3},
						{'x': 7, 'y': 7}
					];

					if( coords.x < 0 ||
						coords.y < 0 ||
						maxTiles[coords.z].x < coords.x || 
						maxTiles[coords.z].y < coords.y) {
						return false;
					}

					return true;
				},
			});

			new LTileLayerExtended('https://sanmap.ikkentim.com/tiles/sat.{z}.{x}.{y}.png', {
				attribution: 'Więcej informacji w zakładce "Autorstwo i podziękowania".',
				minZoom: 1,
                maxZoom: 3,
				noWrap: true,
				tileSize: 512
			}).addTo(mymap);

			var info = L.control();

			info.onAdd = function (map) {
				this._div = L.DomUtil.create('div', 'info');
				this.update();
				return this._div;
			};

			info.update = function (props) {
				this._div.innerHTML = '<h3>Informacje o strefie</h3>' +  (props ?
					'<b>' + props.name + '</b><br />' + props.density + ' m2<sup>2</sup>'
					: 'Najedź na strefę, by zobaczyć więcej informacji');
			};

			info.addTo(mymap);
			//[{"lat":-54,"lng":3},{"lat":-51,"lng":3},{"lat":-51,"lng":6},{"lat":-54,"lng":6}]
			
			L.point(0, 0);

			function styles(feature) {
		return {
			weight: 2,
			opacity: 1,
			color: 'white',
			dashArray: '3',
			fillOpacity: 0.7,
			fillColor: '#BD0026'
		};
	}

			var statesData = '{"type":"FeatureCollection","features":[{"type":"Feature","id":"01","properties":{"name":"Alabama","density":94.65},"geometry":{"type":"Polygon","coordinates":[[[-10,-10],[-15,-10],[-15,-15],[-10,-15]]]}}]}';
			L.geoJson(JSON.parse(statesData), {
				styles: styles,
				onEachFeature: function(feature, layer) {
					/*var label = L.marker(layer.getBounds().getCenter(), {
						icon: L.divIcon({
							className: 'label',
							html: feature.properties.name,
							iconSize: [100, 40]
						})
					}).addTo(mymap);*/
				}
			}).addTo(mymap);
		});
	</script>
</body>
</html>