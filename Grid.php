<?php
  require_once('Cell.php');

  class Grid{
    public $rows, $columns;
    public $grid;

    public function __construct( $rows, $columns ){
      $this->rows = $rows;
      $this->columns = $columns;
      $this->grid = array(array());

      $this->prepare_grid();
      $this->configure_cells();
    }
    public function prepare_grid(){
      $i = 0;
      $j = 0;
      for( $i = 0; $i < $this->rows; $i++){
        for( $j = 0; $j < $this->columns; $j++ ){
            $this->grid[$i][$j] = new Cell( $i, $j );
        }
      }
    }
    public function configure_cells(){
      foreach( $this->grid as $rows => $row ){
        foreach( $row as $columns => $cell ){
          //Check north
          if ( $cell->getRow() - 1 >= 0 ){
            $north = $this->grid[$cell->getRow() - 1][$cell->getColumn()];
            $cell->setNorth( $north ); 
          }
          //Check south
          if ( $cell->getRow() + 1 < $this->rows ){
            $south = $this->grid[$cell->getRow() + 1][$cell->getColumn()];
            $cell->setSouth( $south ); 
          }
          //Check east
          if ( $cell->getColumn() + 1 < $this->columns ){
            $east = $this->grid[$cell->getRow()][$cell->getColumn() + 1];
            $cell->setEast( $east ); 
          }
          //Check west
          if ( $cell->getColumn() - 1 >= 0 ){
            $west = $this->grid[$cell->getRow()][$cell->getColumn() - 1];
            $cell->setWest( $west ); 
          }
        }
      }
    }

    public function size(){
      return $this->row * $this->column;
    }
    public function eachRow(){
      $rows = [];
      foreach( $this->grid as $key => $value ){
        array_push( $rows, $value );
      }
      return $rows;
    }

    public function eachColumn(){
      $columns = [];
      foreach( $this->grid as $key => $value ){
        foreach( $value as $columns => $column) {
          array_push( $columns, $column );
        }
      }
      return $columns;
    }
    public function randomCell(){
      $row = rand( 0, $this->row() - 1 );
      $column = rand( 0, $this->column() - 1 );

      return $this->grid[$row][$column];
    }
    public function getGrid(){
      return $this->grid;
    }
    public function __toString(){
      $wall = "|";
      $corner = "+";
      $open = "   ";

      $format = str_repeat("+---", $this->columns);
      $output = $format . $corner . "\n";

      foreach( $this->grid as $rows ){
        $bottom = "+";
        $output .= $wall;
        foreach( $rows as $columns => $cell ){
          $content = $this->contents( $cell );           
          $output .= $content; 

          $eastBoundary = $cell->isLinked( $cell->getEast() ) ? " " : "|";
          $output .= $eastBoundary;

          $southBoundary = $cell->isLinked( $cell->getSouth() ) ? "   " : "---";
          $bottom .= $southBoundary . $corner;
        }

        $output .=  "\n" . $bottom . "\n";
      }

      return $output;
    }

    public function contents( $cell ){
      return "   ";
    }

    public function getCell( $row, $column ){
      return $this->grid[$row][$column];
    }
  }
?>
