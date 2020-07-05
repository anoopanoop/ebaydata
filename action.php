<?php
$id = $_GET['product-id'];
$imagePathsThumb = '';
$imagePaths = array();
$doc = new DOMDocument;
$doc->loadhtmlfile('https://www.ebay.com/itm/'.$id);
$title = $doc->getElementsByTagName('h1')->item(0)->textContent;
$title = str_replace("Details about ", "",$title);
$imageTags = $doc->getElementById('mainImgHldr');
if($imageTags){
	$img = $imageTags->getElementsByTagName('img');
	foreach($img as $tag) {
	    $imagePaths[]=urldecode($tag->getAttribute('src'));
	}
}
$mainImg = isset($imagePaths[1]) ? $imagePaths[1] : '';
$imageTagsThumb = $doc->getElementById('vi_main_img_fs_slider');
if($imageTagsThumb){
	$imgThumb = $imageTagsThumb->getElementsByTagName('img');
	foreach($imgThumb as $tagThumb) {
	    $imagePathsThumb .=urldecode($tagThumb->getAttribute('src'))."<br>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>EBAY RESULTS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>EBAY Results</h2>
  <?php if($title) { ?>
  <p>Details of Product id # <?php echo $id; ?></p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Label</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Public URL of Product</td>
        <td><?php echo 'https://www.ebay.com/itm/'.$id ?></td>
      </tr>
      <tr>
        <td>Title of product from Ebay</td>
        <td><?php echo $title ?></td>
      </tr>
      <tr>
        <td>URL of main image</td>
        <td><?php echo $mainImg ?></td>
      </tr>
      <tr>
        <td>List of Thumbnail images</td>
        <td><?php echo $imagePathsThumb ?></td>
      </tr>
    </tbody>
  </table>
<?php } else { ?>
	 <p>Product id # <?php echo $id; ?> not found in ebay.com</p> 
<?php } ?>
</div>
</body>
</html>







