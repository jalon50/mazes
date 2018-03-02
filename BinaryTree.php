<?php
  class binaryTree{
    public $grid;

    public function __construct( $grid ){
      $this->grid = $grid;
      foreach( $this->grid->getGrid() as $rows => $row ){
        foreach( $row as $columns => $column ){
          $neighbors = [];
          if ( $column->getNorth() ){
            array_push( $neighbors, $column->getNorth() );
          }
          if ( $column->getEast() ){
            array_push( $neighbors, $column->getEast() );
          }
          if ( count($neighbors ) != 0 ){
            $index = rand( 0, count($neighbors) - 1 );
            $neighbor = $neighbors[$index];

            if( $neighbor ){
              $column->link( $neighbor ); 
              $neighbor->link( $column );
            }
          }
        }
      }
    }
  }
?>
