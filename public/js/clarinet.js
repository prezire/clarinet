var Clarinet = Backbone.Model.extend
({
  gm: null,
  constructor: function()
  {
    this.setListeners();  
    this.gm = new CustomGmap();
  },
  setListeners: function()
  {
    var o = this;
    $('.socialCntr').click(function()
    {
      var t = $(this);
      var ul = t.children('ul');
      ul.toggle();
      return false;
    });
    this.onSenderLocationFetched = function(lat, lng)
    {
      var t = lat;
      var g = lng;
      $('.lat').val(t);
      $('.lng').val(g);
      o.gm.removeAllMarkers();
      var mkr = o.gm.createMarker
      (
        g, 
        t, 
        o.gm.createIcon
        (
          '../public/images/point_map_pin.png', 
          32, 32, 
          16, 32
        ),
        true,
        'You should be here.'
      );
      google.maps.event.addListener(mkr, 'drag', function()
      {
        var lat = this.getPosition().lat();
        var lng = this.getPosition().lng();
        o.popuplateSharedUrl(lat, lng);
      });
      o.gm.map.setCenter(mkr.getPosition());
      o.gm.createInfoWindow(mkr, {});
    };
  },
  getHashbang: function()
  {
    var s = window.location.hash;
    s = s.substring(2, s.length);
    return s;
  },
  onSenderLocationFetched: function(latitude, longitude)
  {
    //Callback.
  },
  fetchSenderLocation: function()
  {
    var o = this;
    o.onSenderLocationFetched(1, 2);
    return;
    if(navigator.geolocation)
    {
      navigator.geolocation.getCurrentPosition
      (
        function(position)
        {
          o.onSenderLocationFetched
          (
            position.coords.latitude,
            position.coords.longitude
          );
        }
      );
    }
    else
    {
      alert('Geolocation is not supported by this browser.');
    }
  },
  popuplateSharedUrl: function(latitude, longitude)
  {
    var lat = latitude;
    var lng = longitude;
    $('.point .lat').val(lat);
    $('.point .lng').val(lng);
    var s = document.location.pathname + 
    '#!' + lat + '/' + lng;
    $('.point .sharedUrl input').val(s);
  }
});
var Moment = Clarinet.extend
({
  /*
    @var  sTok    Lock token and don't change it unless 
    responded. If token has been responded, or not 
    responded within an hour, mark it as unconfirmed in DB.
  */
  sTok: null,
  sUserState: null,
  sUserId: null,
  sVert: null,
  iPong: null,
  //
  constructor: function()
  {
    this.setUserState($('.selUserState').val());
    this.setListeners();
  },
  setUserId: function(value)
  {
    this.sUserId = value;
  },
  /*
  * Sets the user to either sender or responder.
  * Default state will be in the settings.
  * @param  state   Either sender or responder.
  */
  setUserState: function(state)
  {
    var o = this;
    this.sUserState = state;
    if(state == 'responder')
    {
      //User is app_subscriber. Use pong every 
      //3 seconds to listen for any pings from DB.
      this.iPong = setInterval(function()
      {
        o.pong();
      }, 3000);
    }
    else
    {
      if(this.iPong)
      {
        clearInterval(this.iPong);
      }
      //Do nothing.
    }
  },
  setListeners: function()
  {
    var o = this;
    $('.btnSetUserState').click(function(){
      o.setUserState($('.selUserState').val());
    });
    $('#moments .moment .btnTitle').click(function(e){
      e.preventDefault();
      var p = $(this).parent().parent().parent().parent();
      var id = p.children('input').val();
      o.ping(id, false);
    });
    $('#moments .moment .btnPing').click(function(e){
      e.preventDefault();
      var p = $(this).parent();
      var id = p.children('input').val();
      o.ping(id, true);
    });
    $('#moments .moment .btnShowDescr').click(function(e){
      e.preventDefault();
      var p = $(this).parent().parent().parent().parent();
      $(p.children('div')[1]).toggle();
    });
  },
  //Private.
  getToken: function()
  {
    var o = this;
    $.ajax
    (
      {
        url: url, 
        success: function(response)
        {
          if(response.status)
          {
            o.sTok = response.token;
          }
          else
          {
            //console.log('Error requesting token.');
          }
        }
      }
    );
  },
  //Public meths.
  ping: function(id, requestForResponder)
  {
    var o = this;
    this.onSenderLocationFetched = function(lat, lng)
    {
      var latLng = lat + ' ' + lng;
      if(requestForResponder)
      {
        $.ajax
        ({
          url: 'moment/ping/' + 
          id + '/' + latLng, 
          success: function(response){
            //Displ responders.
          }
        });
      }
    };
    this.fetchSenderLocation();
  },
  confirm: function()
  {
    $.ajax({url: url, success: function(){}});
  }
});
var Radius = Clarinet.extend
({
  constructor: function()
  {
    this.setListeners();
    this.gm.init('#gmap', true);
  },
  onFormatResult: function(result)
  {
    var s = '<div class="searchResult">' + 
    '<div class="name">' + result.name + '</div>' + 
    '<div>' + result.verticals + '</div>' + 
    '<div>' + result.description + '</div>' + 
    '<div>' + result.address + '</div>' + 
    '</div>';
    return s;
  },
  onFormatSelection: function(result)
  {
    return result.name;
  },
  onUserSearch: function(keywords)
  {
    var s = 'http://localhost/clarinet/' + 
        'index.php/radius/search/' + keywords;
    return s;
  },
  createReport: function(id, metricType)
  {
    $.get("http://ipinfo.io", function(response){
      var url = 'report/create/' + 
      id + '/' + 
      metricType + '/' + 
      response.country + '/' + 
      response.org;
      //
      $.ajax({url: url});
    }, 'jsonp');
  },
  setListeners: function()
  {
    var o = this;
    $('.keywords').select2({
        placeholder: 'I am looking for...', 
        allowClear: true,
        minimumInputLength: 3,
       ajax: 
       {
        //TODO: Research how to get using clean url.
        url: o.onUserSearch,
        dataType: 'json',
        quietMillis: 100,
        data: function(term, page)
        {
          var o = {keywords: term};
          return o;
        },
        results: function(data, page)
        {
          var more = (page * 10) < data.result.length;
          var o = {results: data.result, more: more};
          return o;
        }
      },
      formatResult: o.onFormatResult, 
      //BUG: Not working.
      formatSelection: o.onFormatSelection, 
      escapeMarkup: function(m){return m;}
    });
    this.gm.onRadiusUpdated = function(info)
    {
      var url = 'radius/getAllWithinRadius' + 
      '/' + info.longitude + 
      '/' + info.latitude + 
      '/' + info.distance + 
      '/' + $('.keywords').val();
      $.ajax
      ({
        url: url,
        method: 'GET',
        success: function(response)
        {
          o.gm.removeAllMarkers();
          //
          var locs = response.locations;
          for(var a = 0; a < locs.length; a++)
          {
            var l = locs[a];
            var mkr = o.gm.createMarker
            (
              l.longitude, 
              l.latitude, 
              o.gm.createIcon
              (
                '../public/images/radius_map_pin.png', 
                32, 32, 
                8, 13
              ),
              false
            );
            o.gm.createInfoWindow(mkr, l);
            o.createReport(l.id, 'search');
          }
        }
      });
    };
  },
  initCrud: function()
  {
    //Note false param.
    this.gm.init('#gmap', false);
    this.fetchSenderLocation();
    var m = this.gm.createMarker
    (
      response.longitude, 
      response.latitude, 
      this.gm.createIcon
      (
        '../public/images/point_map_pin.png', 
        32, 32, 
        8, 13
      ),
      false
    );
    google.maps.event.addListener(m, 'drag', function()
    {
      $('.radius.create .lat').val(this.getPosition().lat());
      $('.radius.create .lng').val(this.getPosition().lng());
    });
    this.gm.map.setCenter(m.getPosition());
    this.gm.createInfoWindow(m, {});
  }
});
var Point = new Clarinet.extend
({
  construct: function()
  {
    this.setListeners();
    $('.shares .share').hide();
    var h = this.getHashbang();
    if(h.length > 0)
    {
      var coords = h.split('/');
      this.popuplateSharedUrl(coords[0], coords[1]);
    }
    //
    this.gm.init('#gmap', false);
  },
  setListeners: function()
  {
    var o = this;
    $('.shareLoc').click(function(){
      $('.shares input').attr('placeholder', 'Loading...');
      $('.shares .share').toggle();
      $('.shares .share .sharedUrl').toggle();
      //
      o.fetchSenderLocation();
      return false;
    });
    $('.shareUrl a').click(function(){
      $('.shares .share .sharedUrl').toggle();
      return false;
    });
    $('.twitter.popup').click(function(){
      var width  = 575;
      var height = 400;
      var left = ($(window).width()  - width)  / 2;
      var top = ($(window).height() - height) / 2;
      var url = 'http://twitter.com/share?text=' + 
          encodeURIComponent($('.sharedUrl input').val());
          console.log(url);
      var opts  = 'status=1' +
          ',width=' + width +
          ',height=' + height +
          ',top=' + top +
          ',left=' + left;
      window.open(url, 'twitter', opts);
      return false;
    });
    $('.gplus.popup').click(function(){
      var url = 'https://plus.google.com/share?url=' + 
          encodeURIComponent($('.sharedUrl input').val());
      var width  = 575;
      var height = 400;
      var left = ($(window).width()  - width)  / 2;
      var top = ($(window).height() - height) / 2;
      var opts  = 'status=1' +
          ',width=' + width +
          ',height=' + height +
          ',top=' + top +
          ',left=' + left + 
          ',menubar=no, toolbar=no, ' + 
          'resizable=yes, scrollbar=yes';
      window.open(url, 'gplus', opts);
      return false;
    });
    $('.fb.popup').click(function(){
      var width = 400;
      var height = 300;
      var leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
      var topPosition = (window.screen.height / 2) - ((height / 2) + 50);
      var opts = "status=no,height=" + height + 
          ",width=" + width + 
          ",resizable=yes,left=" + leftPosition + 
          ",top=" + topPosition + 
          ",screenX=" + leftPosition + 
          ",screenY=" + topPosition + 
          ", toolbar=no, menubar=no, " + 
          "scrollbars=no, location=no, directories=no";
      var url = $('.sharedUrl input').val();
      var t = document.title;
      window.open
      (
        'http://www.facebook.com/sharer.php?u=' + 
        encodeURIComponent(url) + 
        '&t='+encodeURIComponent(url),
        'sharer', 
        opts, 
        'fb'
      );
      return false;
    });
    $('.getLoc').click(function(){o.fetchSenderLocation();});
  }
});
var Report = Clarinet.extend
({
  construct: function()
  {
    this.setListeners();
  },
  setListeners: function()
  {
    var o = this;
    var d = new Date();
    var sYr = d.getFullYear();
    var sMo = d.getMonth() + 1;
    var sDate = d.getDate();
    var sHrs = d.getHours();
    var sMin = d.getMinutes();
    var s = sYr + '/' + sMo + '/' + sDate + ' ' + sHrs + ':' + sMin;
    $('.dateFrom').datetimepicker({mask: s, step: 1});
    $('.dateTo').datetimepicker({mask: s, step: 1});
    $('.reports .btnGenerate').click(function()
    {
      o.generate();
      return false;
    });
  },
  onReportGenerated: function(result)
  {
    $('.reports #chartData').show();
    var o = this;
    /*result = 
    {
      title: {text: 'Frequency'},
      data:
      [
        o.toChartData
        (
          'Search',
          //result.search.
          [
            {label: "January", y: 23},
            {label: "February", y: 33},
            {label: "March", y: 48},              
            {label: "April", y: 37},
            {label: "May", y: 20}
          ]
        ),
        o.toChartData
        (
          'Expansion',
          //result.expansion.
          [
            {label: "January", y: 11},
            {label: "February", y: 26},
            {label: "March", y: 40},             
            {label: "April", y: 34},
            {label: "May", y: 20}
          ]
        )
      ]
    };*/
    //BUG: Remove quotes on nums.
    new CanvasJS.Chart("chartData", result).render();
  },
  toSqlDate: function(value)
  {
    var yr = value.substring(0, 4);
    var mo = value.substring(5, 7);
    var day = value.substring(8, 8);
    var s = yr + '-' + 
    mo + '-' 
    + day + 
    value.substring(8, value.length);
    //return value.replace(/\/ /g, '-');
    return s;
  },
  generate: function()
  {
    var vl = $('.reports .vertical').val();
    var type = $('.reports .type').val();
    var dr = $('.reports .dateType').val();
    var df = this.toSqlDate($('.reports .dateFrom').val());
    var dt = this.toSqlDate($('.reports .dateTo').val());
    var s = 'report/generate/' + vl 
    + '/' + type
    + '/' + dr 
    + '/' + df 
    + '/' + dt;
    $.ajax({
      url: s, 
      success: this.onReportGenerated,
      error: function(response){
        console.log('Error ', response);
      }
    });
    //this.onReportGenerated(null);
    return false;
  }
});