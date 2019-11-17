<?php
$title = "Product";
$this->breadcrumbs = array(
	$title,
);

$ProductModel = new Product();
?>
<a href="<?php echo Yii::app()->createUrl('backend/product/createproduct') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> create product</button>
</a>
<hr/>
<div class="row">
    <?php
foreach ($category as $rs):
	$Types = ProductType::model()->findAll("category=:category", array(":category" => $rs['id']));
	?>
	    <div class="col-md-4 col-lg-4">
	    <h4>
	        <a href="<?php echo Yii::app()->createUrl('backend/product/category', array("categoryID" => $rs['id'])) ?>"><?php echo $rs['categoryname'] ?>(<?php echo $ProductModel->countProductCategory($rs['id']) ?>)</a>
	    </h4>
	        <ul>

	            <?php
	foreach ($Types as $rsTypes):
		$sql = "select * from product where type_id = '" . $rsTypes['type_id'] . "' ";

		?>
		                <li><a href="<?php echo Yii::app()->createUrl('backend/product/getproduct', array("category" => $rs['id'], 'type' => $rsTypes['type_id'])) ?>"><?php echo $rsTypes['type_name'] ?> (<?php echo $ProductModel->countProductType($rsTypes['type_id']) ?>)</a>
		                </li>
		            <?php endforeach;?>
	        </ul>
	    </div>
	    <?php endforeach;?>
</div>

<h4>Brands</h4>
<div class="row">
    <?php foreach ($brand as $rsBrand): ?>
        <div class="col-md-3 col-lg-3">
            <a href="<?php echo Yii::app()->createUrl('backend/product/brand', array("brandID" => $rsBrand['id'])) ?>">
                <button type="button" class="btn btn-primary" style="margin-bottom:10px;">
                    <?php echo $rsBrand['brandname'] ?> (<?php echo $ProductModel->countProductBrand($rsBrand['id']) ?>)
                </button>
            </a>
        </div>
    <?php endforeach;?>

</div>