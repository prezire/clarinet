/**
 * A radius widget that add a circle to a map and centers on a marker.
 * @constructor
**/
function RadiusWidget() 
{
	var circle = new google.maps.Circle({strokeWeight: 1});
	// Set the distance property value, default to 50km.
	this.set('distance', 2);
	this.bindTo('bounds', circle);
	//
	circle.bindTo('center', this);
	circle.bindTo('map', this);
	circle.bindTo('radius', this);
	//
	this.addSizer();
}
RadiusWidget.prototype = new google.maps.MVCObject();
/**
 * Update the radius when the distance has changed.
**/
RadiusWidget.prototype.distance_changed = function() 
{
  this.set('radius', this.get('distance') * 1000);
};
/**
 * Add the sizer marker to the map.
 * @private
**/
RadiusWidget.prototype.addSizer = function() 
{
	var sizer = new google.maps.Marker
	({
		icon: '../public/images/radius_map_pin_orange.png',
		draggable: true,
		title: 'Drag me!'
	});
	sizer.bindTo('map', this);
	sizer.bindTo('position', this, 'sizer_position');
	//
	var me = this;
	google.maps.event.addListener(sizer, 'dragend', 
	function() 
	{
	  // Set the circle distance (radius)
	  me.setDistance();
	});
};
/**
 * Update the center of the circle and position the sizer back on the line.
 * Position is bound to the DistanceWidget so this is expected to change when
 * the position of the distance widget is changed.
**/
RadiusWidget.prototype.center_changed = function() 
{
  var bounds = this.get('bounds');
  // Bounds might not always be set so check that it exists first.
  if (bounds) 
  {
    var lng = bounds.getNorthEast().lng();
    var lat = this.get('center').lat();
    // Put the sizer at center, right on the circle.
    var position = new google.maps.LatLng(lat, lng);
    this.set('sizer_position', position);
  }
};
/**
 * Calculates the distance between two latlng locations in km.
 * @see http://www.movable-type.co.uk/scripts/latlong.html
 * @param {google.maps.LatLng} p1 The first lat lng point.
 * @param {google.maps.LatLng} p2 The second lat lng point.
 * @return {number} The distance between the two points in km.
 * @private
**/
RadiusWidget.prototype.computeDistance = function(p1, p2) 
{
  if (!p1 || !p2) 
  {
    return 0;
  }
  var earthKmRadius = 6371;
  var dLat = (p2.lat() - p1.lat()) * Math.PI / 180;
  var dLon = (p2.lng() - p1.lng()) * Math.PI / 180;
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
	Math.cos(p1.lat() * Math.PI / 180) * Math.cos(p2.lat() * Math.PI / 180) *
	Math.sin(dLon / 2) * Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = earthKmRadius * c;
  return d;
};

/**
 * Set the distance of the circle based on the position of the sizer.
**/
RadiusWidget.prototype.setDistance = function() 
{
  // As the sizer is being dragged, its position changes.  Because the
  // RadiusWidget's sizer_position is bound to the sizer's position, it will
  // change as well.
  var pos = this.get('sizer_position');
  var center = this.get('center');
  var distance = this.computeDistance(center, pos);
  // Set the distance property for any objects that are bound to it
  this.set('distance', distance);
};