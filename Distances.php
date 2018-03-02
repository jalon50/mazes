<?php
  class Distances{
    public $root;
    public $cells;

    public function __construct( $root ){
      $this->root = $root;
      $this->cells = [];
      
      $this->addToCells( $root, 0 );
    }
    public function getCells(){
      return $this->cells;

    }

    public function addToCells( $cell, $distance ){
      $cell->setDistance( $distance );
      $size = array_push( $this->cells, $cell ); 

      return $size;
    }
    public function getRoot(){
      return $this->root;
    }
    public function pathTo( $target ){
      $root = $this->getRoot();

      $breadcrumbs = new Distances( $root ); 
      $cells = $this->getCells();
      $closestDistance = PHP_INT_MAX; 

      $breadcrumbs->addToCells($target, $target->getDistance());
      while ( ($root->getRow() != $target->getRow()) || ($root->getColumn() != $target->getColumn()) ){
        //Get all neighbors 
        $neighbors = $target->getLinks();
        $closest = null;
        foreach( $neighbors as $neighbor ){
          $distance = $neighbor->getDistance();
          if ( $distance < $closestDistance || $distance == 0 ){
              $closest =  $neighbor;
              $closestDistance = $closest->getDistance();
          }
        }
        $target = $closest;
        $breadcrumbs->addToCells($closest, $closestDistance);
        $closestDistance = PHP_INT_MAX; 
      } 
      return $breadcrumbs;

    }

    public function maxDistance( $distances ){
      $maxDistance = 0;
      $maxCell = $distances->getRoot();
      
      foreach( $distances->cells as $cell ){
        if ( $cell->getDistance() > $maxDistance ){
          $maxDistance = $cell->getDistance();
          $maxCell = $cell;
        }
      }
      
      return $maxCell;

    }

  }

?>
