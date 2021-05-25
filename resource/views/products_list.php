<?php
ob_start();
?>
    <div class="product_list">
        <div class="row">
            <div class="col-md-12">
                <h4>Produkty</h4>
            </div>
        </div>
        <?php if(!count($products)) { ?>
            <div class="default_font">
                <h4>Nie znaleziono produktów</h4>
            </div>
        <?php } else { ?>
            <div class="row">
                <?php $lp = 0; ?>
                <?php foreach($products as $product) { ?>
                    <?php $lp++; ?>
                    <div class="col-md-4 one_product">
                        <a href="/">
                            <div class="image" style="background-image:url('/uploaded_images/<?php if($product->image!='') { echo $product->image; } else { echo 'no-image-found.jpg';} ?>');"></div>
                            <h4><?php echo $product->name; ?></h4>
                            <h5><?php echo $product->price; ?> ,-</h5>
                        </a>
                    </div>
        <?php if($lp%3==0) { ?></div><div class="row"><?php } ?>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php if($pages_count>0) { ?>
    <div class="paggination">
        <ul>
            <?php for($i = 1; $i<=$pages_count; $i++) { ?>
            <li><a href="/produkty/<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
<?php
$content = ob_get_contents();
ob_clean();
echo views::include_to_view('frame_filters','content', $content);
?>