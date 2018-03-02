<?php
  require_once('grid.php');
  require_once('sidewinder.php');
  
  $grid = new Grid( 25, 25 );
  $sd = new Sidewinder( $grid );

  echo $grid;
?>
