/**
 * A distance widget that will display a circle that can be resized and will
 * provide the radius in km.
 * @param {google.maps.Map} map The map on which to attach the distance widget.
 * @constructor
**/
function DistanceWidget(map, latLng)
{
	this.set('map', map);
	this.set('position', latLng);
	//
	var marker = new google.maps.Marker
	({
		icon: '../public/images/radius_generic_map_pin.png',
		draggable: true,
		title: 'Move me!'
	});
	marker.bindTo('map', this);
	marker.bindTo('position', this);
	//
  var radiusWidget = new RadiusWidget();
  radiusWidget.bindTo('map', this);
  radiusWidget.bindTo('center', this, 'position');
  //
  this.bindTo('distance', radiusWidget);
  this.bindTo('bounds', radiusWidget);
}
DistanceWidget.prototype = new google.maps.MVCObject();