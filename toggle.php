<?php
$output = shell_exec('sh /home/enichols/bin/toggle_ac.sh');
$historyFile = fopen('history.json', 'r') or die('{ success: false }');
$historyData = fread($historyFile, filesize('history.json'));
fclose($historyFile);
$historyJson = json_decode($historyData);
array_unshift($historyJson, time());
$historyFile = fopen('history.json', 'w') or die('{ success: false }');
fwrite($historyFile, json_encode($historyJson));
fclose($historyFile);
$result = array();
$result['success'] = true;
$result['history'] = $historyJson;
echo json_encode($result);
?>
