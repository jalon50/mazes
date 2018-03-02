<?php
  require_once( 'DistanceGrid.php' );
  require_once( 'BinaryTree.php' );
  require_once( 'Sidewinder.php' );
  require_once( 'Distances.php' );
  
  $grid = new DistanceGrid( 12, 12 );

  $bt = new Sidewinder( $grid ); 

  $start = $grid->getCell( 5, 3 );

  $distances = $start->calculateDistance();
  
  echo $grid;

  $pathToGoal = $distances->pathTo( $grid->getCell( 9, 9 ) );

  echo $grid->printGridWithShortestPathToTarget( $pathToGoal );


?>
