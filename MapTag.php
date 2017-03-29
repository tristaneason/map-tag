<?php
namespace cms\tags;

use cms\dao\DAO;

/*
  This map tag will render the specific location defined in its parameters
  This will utilize the custom map created by Creative
  
  Examples of use:
  <cms:map location="cincinnati" height="480" />
  <cms:map location="cleveland" height="480" />
  <cms:map location="oklahoma" height="480" />
  <cms:map location="philadelphia" height="480" />
  <cms:map location="scottsdale" height="480" />
  <cms:map location="stlouis" height="480" />
  <cms:map location="tampa" height="480" />
  <cms:map location="all" height="480" />
  
  @author Tristan Eason
  @version 1.0
  @copyright Copyright (c) 2015

*/

class MapTag extends TagBase {
  protected $key;
  
  public function __construct() {
    parent::__construct();
  }
  
  public function render($params = '') {
      
    // Define error message
    $error = "<em style='color: tomato;'>There was an error. Did you properly set the location and height parameters?</em>";
    
    // Ensure that parameters are set and that the page doesn't explode
    if (isset($params['location']) && isset($params['height'])) {
      
      // Set the location and height variables
      $location = $params['location'];
      $height = $params['height'];
      
      // If the inputted location and height has any extra spaces (for some odd reason) trim them out
      $location = trim($location);
      $height = trim($height);
      
      // Prep the value of the location and height parameters to be used throughout the rest of this function
      $this->prepParams($params);
      
      // Set default zoom level
      $z = '16';
      
      // The following switch/case block sets the latitude and longtitude paramters for its respective location parameter
      switch ($location) {
        case 'cincinnati':
          $ll = '39.117562,-84.497330';
          break;
        case 'cleveland':
          $ll = '41.505567,-81.457293';
          break;
        case 'oklahoma':
          $ll = '35.610943,-97.607780';
          break;
        case 'philadelphia':
          $ll = '40.078972,-75.414896';
          break;
        case 'scottsdale':
          $ll = '33.621161,-111.889795';
          break;
        case 'stlouis':
          $ll = '38.663242,-90.441892';
          break;
        case 'tampa':
          $ll = '27.967987,-82.567658';
          break;
        case 'all':
          $z = '4';
          $ll = '38,-95';
          break;
        default:
          $z = '';
          $ll = '';
      }
      
      // Build the Google map iframe
      $this->output = "<div class='overlay' onClick=\"style.pointerEvents='none'\"></div>";
      $this->output .= "<iframe src='https://www.google.com/maps/d/embed?mid=zJYgm4UWu_xo.kgJC8QgRe3So&z={$z}&ll={$ll}' width='100%' height='{$height}'></iframe>";
      
      // Display error message if no location or height entered
      if ($location == '' || $height == '') {
        $this->output .= $error;
      }
      
      // Error message if invalid location
      elseif ($location !== 'cincinnati' &&
              $location !== 'cleveland' &&
              $location !== 'oklahoma' &&
              $location !== 'philadelphia' &&
              $location !== 'scottsdale' &&
              $location !== 'stlouis' &&
              $location !== 'tampa' &&
              $location !== 'all') {
        
        $this->output .= $error;
      }      
    } // end isset($location) && isset($height)
    
    else {
      return $error;
    }
    
    return $this->output;
  }
}