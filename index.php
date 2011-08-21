<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Toggle a/c</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.css" />
	<link rel="apple-touch-icon" href="ac-icon.png"/>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>
	<script type="text/javascript">
	  jQuery(function($) {
	    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
	    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	    
	    $.getJSON('history.json', parseHistory);
	    
	    function parseHistory(history) {
	      var dateLabel = '';
	      var oldDateLabel = 'dummy';
	      var count = 0;
	      for(var i in history) {
	        if(count >= 10) { break; }
	        count++;
	        var dateString = history[i];
	        var date = new Date(dateString * 1000);
	        oldDateLabel = dateLabel;
	        dateLabel = days[date.getDay()] + ', ' + months[date.getMonth()] + ' ' + date.getDate();
	        if(oldDateLabel != dateLabel) {
	          $('<li>', { text: dateLabel, 'data-role': 'list-divider' }).addClass('datapoint').appendTo($('#history'));
	        }
	       
	        $('<li>', { text: date.toLocaleTimeString() }).addClass('datapoint').appendTo($('#history'));
	      }
	      $('#history').listview('refresh');
	    }
	    
	    
	    $('#toggle-button').click(function() {
	      $.getJSON('toggle.php', function(result) {
	        if(result && result.success && result.success == true) {
	          $('.datapoint').remove();
	          parseHistory(result.history);
	        }
	      });
	    });
	  });
	</script>
</head> 
<body>
  <div data-role="page" data-theme="a">
	  <div data-role="content">	
      <button id="toggle-button">Toggle a/c</button>
	  </div><!-- /content -->
	  <div data-role="content">
      <ul data-role="listview" id="history">
        <li data-role="list-divider" role="heading">Toggle History</a>
      </ul>
	  </div>
	  <div data-role="footer">
	  </div>
  </div><!-- /page -->
</body>
</html>

