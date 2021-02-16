$(document).ready(function() {
	var table = $('#dataTable').DataTable({ 
		order: [1, 'asc'], 
		"bLengthChange": false, 
		"bInfo": false, 
		"pageLength": 13,
		"language": {
            "zeroRecords": "Brak stref o podanych parametrach.",
            "infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Wyszukaj:",
			"paginate": {
				"next":       "Dalej",
				"previous":   "Wcześniej"
			},
        },
	});
	var info = new google.maps.InfoWindow();
	var beforePolygon = null;
	
    var satType = new SanMapType(1, 3, function (zoom, x, y) {
        return x == -1 && y == -1 ? null : "https://sanmap.ikkentim.com/tiles/sat." + zoom + "." + x + "." + y + ".png";
    });
	
    var map = SanMap.createMap(document.getElementById('map-canvas'), {'NET4Game.com': satType}, 1, null, false, 'NET4Game.com');
	
	for(var area in areas) {
		var i = areas[area]; var calcX = -2900+(i.x*100); var calcY = -2900+(i.y*100);

		var polygonCoords = [
			SanMap.getLatLngFromPos( calcX, calcY ), // LD
			SanMap.getLatLngFromPos( calcX+100, calcY ), // PD
			SanMap.getLatLngFromPos( calcX+100, calcY+100 ), // PG
			SanMap.getLatLngFromPos( calcX, calcY+100 ) // LG
		];

		areas[area].polygon = new google.maps.Polygon({
			paths: polygonCoords,
			strokeColor: '#2592d3',
			strokeOpacity: 0.7,
			strokeWeight: 0.5,
			fillColor: '#FFFFFF',
			fillOpacity: (typeof i.price === 'undefined' || i.price != 0 ? 0 : 0.1),
			label: i.x+'x'+i.y,
			surface: i.surface,
			price: i.price,
			type: i.type,
			mobile: i.mobile
		});
		
		areas[area].polygon.setMap(map);
		areas[area].polygon.addListener('click', showInfo);
	}

	if( urlParam('x') != 'x' && urlParam('y') != 'y') {
		var pos = SanMap.getLatLngFromPos( urlParam('x'), urlParam('y') );
		
		new google.maps.Marker({ position: pos, map: map });
		
		map.setCenter(pos);
	} else {
		map.setCenter({lat: -46.5, lng: 46.5});
	}

	function showInfo(event) {
		var text = '<div style="text-align: center"><h4>Strefa '+this.label+'</h4>';
		var centerpath = getCenterPath(this);
		
		if(this.type == TYPE_NONE) {
			text += 'Na tej strefie nie możesz postawić budynku';
		} else if(this.price == 0) {
			text += 'Strefa nie została jeszcze uzupełniona, <a href="https://net4game.com/user/2897-szemek/">pomóż nam</a>!';
		} else {
			text += '<b>Cena m2</b>: $'+this.price+'<br>';
			text += '<b>Powierzchnia</b>: '+this.surface+'m2<br>';
			
			if(this.type == TYPE_BUSINESS) {
				text += '<br>Na tej strefie możesz postawić tylko budynek biznesowy';
			} else if(this.type == TYPE_HOUSE) {
				text += '<br>Na tej strefie możesz postawić tylko budynek mieszkalny';
			}
		}
		
		info.setContent(text+'</div>');
		info.setPosition(centerpath);
		info.open(map);
		
		map.setCenter(centerpath);
		
		cleanPolygon(this);
    }
	
	$('#dataTable').on('click', 'span', function() {
		var id = $(this).parent().parent().data('id');
		
		cleanPolygon(areas[id].polygon);
		
		google.maps.event.trigger(areas[id].polygon, "click", {});

		$('#areaList').find('button.close').trigger('click');

		map.setCenter(getCenterPath(areas[id].polygon));
		map.setZoom(3);
	});
	
	$('#showAreaList').click(function(){
		$('#areaList').modal();
	});

	function cleanPolygon(polygon) {
		if(beforePolygon != null) {
			beforePolygon.setOptions({ strokeColor: '#2592d3', strokeWeight: 2, strokeOpacity: 0.4, zIndex: 104 });
		}

		beforePolygon = polygon;
		beforePolygon.setOptions({ strokeColor: '#FF0000', strokeWeight: 3, strokeOpacity: 1, zIndex: 999 });
	}
	
	function getCenterPath(p) {
		var path = p.getPath();
		return { "lat": ( path.getAt(0).lat() + path.getAt(2).lat() )/2, "lng": (path.getAt(0).lng() + path.getAt(2).lng() )/2 };
	}
	
	function urlParam(param) {
		location.search.substr(1).split("&").some(function(item) { // returns first occurence and stops
			return item.split("=")[0] == param && (param = item.split("=")[1])
		});
		return param;
	}
});