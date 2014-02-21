function MapMarkerWidget(map, latLng, callback)
{
	var distanceWidget = new DistanceWidget(map, latLng);
	//Refer to RadiusWidget.distance_changed().
	var o = this;
	google.maps.event.addListener(distanceWidget, 'distance_changed', 
	function(){callback(o.toInfo(distanceWidget));});
	google.maps.event.addListener(distanceWidget, 'position_changed', 
	function(){callback(o.toInfo(distanceWidget));});
	this.toInfo = function(distanceWidget){
	  var o = {
        longitude: distanceWidget.get('position').lng(),
        latitude: distanceWidget.get('position').lat(),
        distance: distanceWidget.get('distance')
      };
	  return o;
	};
	//
	callback(o.toInfo(distanceWidget));
}