<?php
  require_once('Grid.php');

  class DistanceGrid extends Grid{
      public function __construct( $rows, $columns){
          parent::__construct( $rows, $columns );
      }

      public function contents( $cell ){
        $content = "";
        switch( intval( $cell->getDistance() )){
          case 10:
            $content = " A ";
            break;
          case 11:
            $content = " B ";
            break;
          case 12:
            $content = " C ";
            break;
          case 13:
            $content = " D ";
            break;
          case 14:
            $content = " E ";
            break;
          case 15:
            $content = " F ";
            break;
          case 16:
            $content = " G ";
            break;
          case 17:
            $content = " H ";
            break;
          case 18:
            $content = " I ";
            break;
          case 19:
            $content = " J ";
            break;
          case 20:
            $content = " K ";
            break;
          case 21:
            $content = " L ";
            break;
          case 22:
            $content = " M ";
            break;
          case 23:
            $content = " N ";
            break;
          case 24:
            $content = " O ";
            break;
          case 25:
            $content = " P ";
            break;
          case 26:
            $content = " Q ";
            break;
          case 27:
            $content = " R ";
            break;
          case 28:
            $content = " S ";
            break;
          case 29:
            $content = " T ";
            break;
          case 30:
            $content = " U ";
            break;
          case 31:
            $content = " V ";
            break;
          case 32:
            $content = " W ";
            break;
          case 33:
            $content = " X ";
            break;
          case 34:
            $content = " Y ";
            break;
          case 35:
            $content = " Z ";
            break;
         default:
            $content = " " . strval(intval( $cell->getDistance() ) . " " );
            break;
        } 
        return $content;
      }

      public function printGridWithShortestPathToTarget( $distances ){
        $wall = "|";
        $corner = "+";
        $open = "   ";

        $format = str_repeat("+---", $this->columns);
        $output = $format . $corner . "\n";

        foreach( $this->grid as $rows ){
          $bottom = "+";
          $output .= $wall;
          foreach( $rows as $columns => $cell ){
            if ( in_array( $cell, $distances->getCells() ) ){
              $content = $this->contents( $cell );           
            }
            else{
              $content = "   ";           
            }
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
  }

?>
