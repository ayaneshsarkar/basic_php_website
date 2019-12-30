<?php 
  $get_html_item = function($id, $item) {
    $output = "<li><a href ='#'>"
              . "<img src='" . $item["img"] ."' alt='" .$item["title"] . "' />"
              . "<p>View Details</p>"
            . "</a></li>";
    return $output;
  };

  $array_category = function($catalog, $category) {

    $output = [];

    foreach ($catalog as $id => $item) {
      if ($category == null || strtolower($category) == strtolower($item["category"])) {
        $sort = $item["title"];
        $sort = ltrim($sort, "The ");
        $sort = ltrim($sort, "A ");
        $sort = ltrim($sort, "An ");
        $output[$id] = $sort;
      }
    }

    asort($output);
    return array_keys($output);
  
  };


