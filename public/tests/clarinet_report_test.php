<!DOCTYPE HTML>
<html>
<head>
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {            
      title:
      {
        text: "Fruits sold in First & Second Quarter"              
      },
      data: 
      [
        //array of dataSeries     
        { 
        //dataSeries - first quarter
        /*** Change type "column" to "bar", "area", "line" or "pie", spline***/        
       type: "column",
       name: "First Quarter",
       showInLegend: true,
       dataPoints: 
       [
         { label: "banana", y: 18 },
         { label: "orange", y: 29 },
         { label: "apple", y: 40 },                                    
         { label: "mango", y: 34 },
         { label: "grape", y: 24 }
       ]
     },
     { 
      //dataSeries - second quarter
      type: "column",
      name: "Second Quarter", 
      showInLegend: true,               
      dataPoints: 
      [
        { label: "banana", y: 23 },
        { label: "orange", y: 33 },
        { label: "apple", y: 48 },                                    
        { label: "mango", y: 37 },
        { label: "grape", y: 20 }
      ]
     }
    ],
    /** Set axisY properties here*/
    axisY:
    {
      prefix: "$",
      suffix: "K"
    }    
  });
  chart.render();
}
</script>
<script type="text/javascript" src="canvasjs.min.js"></script>
</head>

<script>

//TODO: logo, fonts, this file.
//lessen height for radius read map
//impl radius create map

$sRepType = 'metric_type, ';
switch($reportType)
{
	case 'location':
		$sRepType .= 'location, ';
	break;
	case 'network':
		$sRepType .= 'network, ';
	break;
}
//
switch($dateType)
{
	case 'yearly':
		$this->db->select('count(id) as total, MONTHNAME(MONTH(timestamp)) months');
	break;
	case 'monthly':
		$this->db->select('count(id) as total, DAY(timestamp) days');
	break;
	case 'hourly':
		$this->db->select('count(id) as total, HOUR(timestamp) hours');
	break;
}
//
if(isset($verticals)) $this->db->where_in('verticals', $i->post('verticals'));
//
$this->db->where('metric_type', $metricType);
$this->db->where('timestamp >=', $dateFrom);
$this->db->where('timestamp <=', $dateTo);
$r = $this->db->get();
return $r;

</script>

160000 / 200 ipinfo.io
150000 / 210 te
	-1000 free
	= 0.0014 per client or 1.4 per 1000 requests.

ads/bidding.

<script>
/*
	{
  "ip": "8.8.8.8",
  "hostname": "google-public-dns-a.google.com",
  "loc": "37.385999999999996,-122.0838",
  "org": "AS15169 Google Inc.",
  "city": "Mountain View",
  "region": "California",
  "country": "US",
  "phone": 650
}
*/
	$.get("http://ipinfo.io", function(response) {
		//org is network carrier.
		console.log(response.org, response.ip, response.country);
	}, "jsonp");
</script>
<body>
  <div id="chartContainer" style="height: 300px; width: 100%;">
  
  </div>
</body>
</html>