<?php
  require_once('grid.php');
  require_once('binaryTree.php');
  
  $grid = new Grid(5, 5);
  $bt = new BinaryTree( $grid );
  $bt->applyBinaryTree();

  echo $grid; 
?>
