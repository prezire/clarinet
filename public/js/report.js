function Report()
{
  this.init = function(){this.setListeners();};
  this.setListeners = function()
  {
    var o = this;
    $('.reports .btnGenerate').click(function()
    {
      o.generate();
      return false;
    });
  };
  this.onReportGenerated = function(result)
  {
    result = 
    {
      charts:
      [
        {
          type: 'frequency',
          labels:
          [
            'January', 
            'February', 
            'March', 
            'April', 
            'May', 
            'June', 
            'July'
          ],
          datasets:
          [
            {data: [65,59,90,81,156,55,140]},
            {data: [28,48,40,19,96,27,100]}
          ]
        },
        {
          type: 'location',
          labels:
          [ 
            'US', 
            'EUROPE',
            'MIDDLE EAST',
            'AFRICA',
            'APAC'
          ],
          datasets:
          [
            {data: [65, 59, 90, 70, 95]},
            {data: [28, 48, 40, 32, 88]}
          ]
        },
        {
          type: 'network',
          labels:
          [
            'M1', 
            'SingTel', 
            'StarHub'
          ],
          datasets:
          [
            {data: [65, 59, 90]},
            {data: [28, 48, 40]}
          ]
        }
      ]
    };
    for(var a = 0; a < result.charts.length; a++)
    {
      var chart = result.charts[a];
      var ctx = $('#' + chart.type).get(0).getContext('2d');
      var datasets = chart.datasets;
      var searchData = datasets[0];
      var detailData = datasets[1];
      searchData.fillColor = 'rgba(220,220,220,0.5)';
      searchData.strokeColor = 'rgba(220,220,220,1)';
      searchData.pointColor = 'rgba(220,220,220,1)';
      searchData.pointStrokeColor = '#fff';
      detailData.fillColor = 'rgba(151,187,205,0.5)';
      detailData.strokeColor = 'rgba(151,187,205,1)';
      detailData.pointColor = 'rgba(151,187,205,1)';
      detailData.pointStrokeColor = '#fff';
      new Chart(ctx).Line(chart);
      $('.reports .charts').show();
    }
  };
  this.generate = function()
  {
    var vl = $('.reports .vertical').val();
    var dr = $('.reports .dateResolution').val();
    var df = $('.reports .dateFrom').val();
    var dt = $('.reports .dateTo').val();
    var s = 'report/generate/' + vl 
    + '/' + dr 
    + '/' + df 
    + '/' + dt;
    //$.ajax({url: s, success: this.onReportGenerated});
    this.onReportGenerated(null);
  };
}