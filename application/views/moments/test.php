<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pubUrl = base_url('public') . '/'; ?>
		<script src="<?php echo $pubUrl . 'libs/foundation-5.0.2/js/vendor/jquery.js'; ?>"></script>
	</head>
	<body>
    curl 'http://localhost/clarinet/index.php/moment/integration/ping/059727320a2a3c8293edf186bf112e5b/null/null/ff0000'
    <script>
      var s = 'http://localhost/clarinet/index.php/moment/integration/pong/059727320a2a3c8293edf186bf112e5b/1.2%203.4/1';
      setInterval
      (
        function()
        {
          $.ajax
          (
            {
              url: s, success: 
              function(response)
              {
                $($('body')[0]).css('backgroundColor', '#' + response);
              }
            }
          );
        }, 
        1000
      );
    </script>
  </body>
</html>