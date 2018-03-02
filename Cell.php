<?php
  require_once( 'Distances.php' );
  class Cell{
      public $row, $column, $north, $east, $west, $south;
      public $distance;
      public $links = [];
      public $visited;

      public function __construct( $row, $column ){
        $this->row = $row;
        $this->column = $column;
        $this->visited = false;
      }

      public function link( $cell ){
        array_push( $this->links , $cell );
      }

      public function unlink( $cell ){
        //Search array for cell passed 
        $index = array_search( $cell, $this->getLinks() );
        unset( $this->links[$index] );

        //Search array for linked cell 
        $index = array_search( $this, $cell->getLinks() );
        $cellLinks = $cell->getLinks();
        unset( $cellLinks[$index] );
      }

      public function keys(){
        return array_keys( $links );
      }

      public function isLinked( $cell ){
        return in_array( $cell, $this->links );
      }

      public function getRow(){
        return $this->row;
      }

      public function getColumn(){
        return $this->column;
      }

      public function getNorth(){
        return $this->north;
      }

      public function getSouth(){
        return $this->south;
      }
      
      public function getEast(){
        return $this->east;
      }

      public function getWest(){
        return $this->west;
      }
      
      public function setRow( $cell ){
         $this->row = $cell;
      }

      public function setColumn( $cell ){
         $this->column = $cell;
      }

      public function setNorth( $cell ){
         $this->north = $cell;
      }

      public function setSouth( $cell ){
         $this->south = $cell;
      }

      public function setEast( $cell){
         $this->east = $cell;
      }

      public function setWest( $cell ){
         $this->west = $cell;
      }

      public function getLinks(){
        return $this->links;
      }
      public function getDistance(){
        return $this->distance;
      }

      public function setDistance( $distance ){
        $this->distance = $distance;
      }

      public function pushLink( $cell ){
        array_push( $this->links , $cell );
      }

      public function neighbors(){
        return $this->list;
      }

      public function getVisited(){
        return $this->visited;
      }

      public function setVisited( $visited ){
        $this->visited = $visited;
      }

      public function calculateDistance(){
        $currentDistance = 0;
        $distance = new Distances( $this );
        $frontier = [];

        array_push( $frontier, $this );

        $this->setDistance( $currentDistance );
        $this->setVisited( TRUE );

        $distance->addToCells( $this, $currentDistance );

        //Update Distance for neighbors of root
        $currentDistance = $currentDistance + 1;

        while( count( $frontier ) > 0 ){
          $newFrontier = []; 
          foreach( $frontier as $key => $border ){
            $neighbors = $border->getLinks();
            foreach( $neighbors as $neighbor ){
              if( !$neighbor->getVisited() ){
                $neighbor->setVisited( TRUE );
                $neighbor->setDistance( $currentDistance );
                $distance->addToCells( $neighbor, $currentDistance );
                array_push( $newFrontier, $neighbor );
              }
            } 
          }

          $currentDistance = $currentDistance + 1;
          $frontier = $newFrontier;
        }
        return $distance;
      }
  }

?>

