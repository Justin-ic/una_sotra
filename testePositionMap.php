<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

<script type="text/javascript">
	

// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx POSITIONNEMENT CLIENT xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
function initMap() {

// Logitude : 5.38695
// Latitude: -4.016034


	// Map options
	var options = {
		zoom:8,
		center:{lat:,lng:}
	}

	// new map
	var map = new google.maps.Map(document.getElementById('map'), options);

/*
	// add marker
	var marker = new google.maps.Marker({
		position:{lat:,lng:},
		map:map,
		icon:
	});

	var infoWindow = new google.maps.infoWindow({
		content:'<h1>Lyna Ma</h1>'
	});

	marker.addListener('click', function () {
		infoWindow.open(map,marker);
	});

*/


// Array for markers
var marker = [
	{
		coords:{lat:,lng:},
		iconImage:'...image.pnp',
		content:content:'<h1>Lyna Ma</h1>'
	},
	{
		coords:{lat:,lng:},
		content:content:'<h1>Lyna Ma</h1>'
	},
	{
		coords:{lat:,lng:},
		content:content:'<h1>Lyna Ma</h1>'
	},
	{
		coords:{lat:,lng:},
		content:content:'<h1>Lyna Ma</h1>'
	}
];


// Loop through marker
for (var i = 0; i < marker.length; i++) {
	addMarker(marker[i]);
}

	function addMarker(props) {
			// add marker
			var marker = new google.maps.Marker({
				position:props.coords,
				map:map
			});


			if (props.iconImage) {marker.setIcon(props.iconImage)}

			if (props.content) {
					var infoWindow = new google.maps.infoWindow({
						content:props.content
					});

					marker.addListener('click', function () {
						infoWindow.open(map,marker);
					});
			}
	}

}

// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


</script>

</head>
<body>
	<div>
		Ma position
		<div id="map">
			
		</div>
	</div>
</body>
</html>