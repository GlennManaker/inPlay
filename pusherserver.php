<?php
  require 'C:/Users/myHP-PAVILION/vendor/autoload.php';

  $options = array(
    'cluster' => 'eu',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '755c975c92e8de460dd0',
    '6eb34711b011718a8557',
    '1047053',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
?>