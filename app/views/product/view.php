<section>
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
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img style="width: 334px; height: 334px;" src="<?php echo \app\models\Product::getImage($product->id); ?>" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <?php if($product->is_new): ?>
                                <img src="/public/images/product-details/new.jpg" class="newarrival" alt="" />
                                <?endif; ?>
                                <h2><?php echo $product->name;?></h2>
                                <p>Код товара: <?php echo $product->code;?></p>
                                <span>
                                    <span>US $<?php echo $product->price;?></span>
                                    <label>Количество:</label>
                                    <input type="text" name = "quantity" id = "quantity" value="1"/>
                                   <button type="button" id="<?php echo $product->id;?>" class="btn btn-default add-to-cart">
                                       <i class="fa fa-shopping-cart"></i>
                                       В корзину
                                   </button>
                                </span>

                                <p><b>Наличие:</b> На складе</p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> D&amp;G</p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <?php echo $product->description;?>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>