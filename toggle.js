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
      var date = new Date(history[i] * 1000);
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
