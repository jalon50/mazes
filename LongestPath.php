<?php
  require_once( 'DistanceGrid.php' );
  require_once( 'BinaryTree.php' );
  require_once( 'Sidewinder.php' );
  require_once( 'Distances.php' );
  
  $grid = new DistanceGrid( 4, 4 );

  $bt = new Sidewinder( $grid ); 

  $start = $grid->getCell( 0, 0 );

  $distances = $start->calculateDistance();
  
  $maxCell = $distances->maxDistance( $distances );

  echo $grid;

  $pathToGoal = $distances->pathTo( $maxCell );

  echo $grid->printGridWithShortestPathToTarget( $pathToGoal );


?>
