<!doctype html>
<html>
    <head>
        <title>Coglab</title>
    </head>
    <body>
      <h1>Coglab Experiments:</h1>
      <ul>
        <?php
          array_diff(scandir('experiments/'), array('..', '.'));
          foreach($people as $p){echo '<li>'.$p.'</li>';}
        ?>
      </ul>
    </body>
</html>
