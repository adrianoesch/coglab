<!doctype html>
<html>
    <head>
        <title>Coglab</title>
    </head>
    <body>
      <h1>Coglab Experiments:</h1>
      <ul>
        <?php
          $experiments = array_diff(scandir('experiments/'), array('..', '.'));
          foreach($experiments as $e){echo '<li>'.$e.'</li>';};
        ?>
      </ul>
    </body>
</html>
