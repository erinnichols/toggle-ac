<?php
$command = 'sh /home/enichols/bin/toggle_ac.sh';
$output = shell_exec($command.' > /dev/null; echo $?');
$result = array(); 
if(trim($output) == "0") { 
  $historyFile = fopen('history.json', 'r') or die('{ success: false }');
  $historyData = fread($historyFile, filesize('history.json'));
  fclose($historyFile);
  $historyJson = json_decode($historyData);
  array_unshift($historyJson, time());
  $historyFile = fopen('history.json', 'w') or die('{ success: false }');
  fwrite($historyFile, json_encode($historyJson));
  fclose($historyFile);
  $result['success'] = true;
  $result['history'] = $historyJson;
} else {
  $result['success'] = false;
}
echo json_encode($result);
?>
