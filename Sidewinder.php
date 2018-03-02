<?php
  class sidewinder{

    function __construct( $grid ){
      $this->grid = $grid;

      foreach( $grid->getGrid() as $rows => $row ){
        $run = [];
        foreach( $row as $column => $cell ){
          array_push( $run, $cell );    

          $easternBoundary = false;
          $northernBoundary = false;

          if( is_null($cell->getEast()) ){
            $easternBoundary = true;
          }

          if( is_null($cell->getNorth()) ){
            $northernBoundary = true;

          }

          $shouldCloseOut = $easternBoundary || ( !$northernBoundary && rand( 0, 2 ) == 0 );

          if ( $shouldCloseOut ){
            $member = array_rand( $run );

            if( $run[$member]->getNorth() ){
              $run[$member]->link( $run[$member]->getNorth() );
              $run[$member]->getNorth()->link( $run[$member] );

              $run = [];
            }
          }
          else{
            $cell->link( $cell->getEast() );
            $cell->getEast()->link( $cell );

          }
        }
      }
    }
  }
?>
