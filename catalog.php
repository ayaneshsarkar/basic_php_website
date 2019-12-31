<?php 

include("inc/data.php");
include("inc/functions.php");

$pageTitle = 'Full Catalog!';
$section = null;

if (isset($_GET["cat"])) {
  if ($_GET["cat"] === 'books') {
    $pageTitle = 'Books';
    $section = 'books';
  } elseif ($_GET["cat"] === 'movies') {
    $pageTitle = 'Movies';
    $section = 'movies';
  } elseif ($_GET["cat"] === 'music') {
    $pageTitle = 'Music';
    $section = 'music';
  }
}

include("inc/header.php");

?>
  
  <div class="section catalog page">
    <div class="wrapper">
      <h1><?php echo "<a href='catalog.php'>Full Catalog</a> &gt; "; 
      if($pageTitle != 'Full Catalog') { echo $pageTitle; } ?></h1>
      <ul class="items">
        <?php 
					$categories = $array_category($catalog, $section);
					foreach($categories as $id) {	
						echo $get_html_item($id, $catalog[$id]);
					}
				?>
      </ul>
    </div>
  </div>

<?php include("inc/footer.php"); ?>






