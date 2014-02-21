function CustomGmap()
{
  this.map;
  this.markers;
  this.hasDistanceWidget;
  //
  this.init = function(containerName, useDistanceWidget)
  {
    this.map = null;
    this.markers = [];
    this.hasDistanceWidget = false;
    //
    var options = 
    {
      zoom: 17,
      center: new google.maps.LatLng(1.297421, 103.851049),
      //ROADMAP/SATELLITE/HYBRID/TERRAIN
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map($(containerName)[0], options);
    this.map = map;
    //
    if(!useDistanceWidget) return;
    //
    var o = this;
    google.maps.event.addListener(map, 'click', 
    function(e)
    {
      if(o.hasDistanceWidget) return;
      o.hasDistanceWidget = true;
      new MapMarkerWidget(map, e.latLng, o.onRadiusUpdated);
    });
  };
  /*
    @param  info   Object.
    Properties: longitude, latitude and distance.
  */
  this.onRadiusUpdated = function(info){/*Callback.*/};
  this.createInfoWindow = function(marker, location)
  {
	var s = '<div class="customGmapInfoWindow" style="width: 250px; height: 150px;">' + 
      '<strong>' + location.name + '</strong>' + 
      '<div>' + location.description + '</div>' +
      '<div>' + location.address + '</div>' +
	  '<div>' + location.latitude + '</div>' +
	  '<div>' + location.longitude + '</div>' +
      '<div><a href="' + 
      location.website + 
      '" target="_blank">' + 
      location.website + 
      '</a></div>' +
	  '<div>' + location.phone + '</div>' +
	  '<div>' + location.email + '</div>' +
    '</div>';
    var o = this;
    var info = new google.maps.InfoWindow({content: s});
    google.maps.event.addListener(marker, 'click', function(){
		info.open(o.map, marker);
	});
  };
  this.createIcon = function(imagePath, width, height, anchorLeft, anchorRight)
  {
    var i = new google.maps.MarkerImage
    (
      imagePath,
      new google.maps.Size(width, height),
      // The origin for this image is 0,0.
      new google.maps.Point(0,0),
      // The anchor for this image is the base of the flagpole.
      new google.maps.Point(anchorLeft, anchorRight)
    );
    return i;
  };
  this.removeAllMarkers = function()
  {
    if(this.markers){
      for(var i in this.markers){
        this.markers[i].setMap(null);
      }
    }
  };
  this.createMarker = function(longitude, latitude, icon, draggable, title)
  {
	title = title ? title : '';
    var m = new google.maps.Marker
    ({
      position: new google.maps.LatLng(latitude, longitude),
      map: this.map,
      icon: icon,
      //clickable: false,
      draggable: draggable,
	  title: title
    });
    this.markers.push(m);
    return m; 
  };
}