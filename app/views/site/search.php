<section id="advertisement">
    <div class="container">
        <img src="/public/images/shop/advertisement.jpg" alt=""/>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Категории</h2>
                <ul class="category-products">
                    <?php echo \vendor\components\TreeCategory::tree_builder() ?>
                </ul>
            </div>
        </div>

        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
                <h2 class="title text-center">Вы искали : <?php echo $search;?></h2>
                <?php if(!empty($categoryProducts)): ?>
                    <?php foreach ($categoryProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo \app\models\Product::getImage($product->id); ?>"  alt="" />
                                        <h2><?php echo $product->price;?>$</h2>
                                        <p>
                                            <a href="/product/<?php echo $product->id;?>">
                                                <?php echo $product->name;?>
                                            </a>
                                        </p>
                                        <a href="/category/<?php echo $product->id ?>" id="<?php echo $product->id;?>"
                                           class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($product->is_new): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <?php echo $pager;?>
                <?php else : ?>
                    <div style="height: 350px;">
                        <h2 style="text-align: center;">По вашему запросу ничего не найдено...</h2>
                    </div>
                <?php endif; ?>

            </div><!--features_items-->



        </div>
    </div>
</div>
</section>