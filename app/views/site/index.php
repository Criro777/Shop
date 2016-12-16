<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <?php $item_class = ' active'; ?>
                        <?php for ($i = 1; $i < 4; $i++): ?>
                            <div class="item<?= $item_class ?>">
                                <?php $item_class = ''; /* убираем 'active' для следующих */ ?>
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img style="width: 484px; height: 441px;;"
                                         src="/../public/images/home/slide<?php echo $i; ?>.jpg"
                                         class="girl img-responsive" alt=""/>
                                </div>
                            </div>
                        <? endfor; ?>
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <ul class="category-products">
                        <?php echo \vendor\components\TreeCategory::tree_builder() ?>
                    </ul>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Популярные товары</h2>
                    <?php foreach ($latestProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img style="width: 210px; height: 190px;" src="/public/images/home/product1.jpg"
                                             alt=""/>
                                        <h2><?php echo $product->price; ?>$</h2>
                                        <p>
                                            <a href="/product/<?php echo $product->id; ?>"><?php echo $product->name; ?></a>
                                        </p>
                                        <a href="#" id="<?php echo $product->id; ?>"
                                           class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В
                                            корзину</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!--features_items-->
                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>

                    <div class="cycle-slideshow"
                         data-cycle-fx=carousel
                         data-cycle-timeout=5000
                         data-cycle-carousel-visible=3
                         data-cycle-carousel-fluid=true
                         data-cycle-slides="div.item"
                         data-cycle-prev="#prev"
                         data-cycle-next="#next"
                    >
                        <?php foreach ($latestProducts as $product): ?>
                            <?php if ($product->is_recommended): ?>
                                <div class="item">
                                    <div class="product-image-wrapper ">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="/public/images/home/recommend1.jpg" alt=""/>
                                                <h2><?php echo $product->price; ?>$</h2>
                                                <p>
                                                    <a href="/product/<?php echo $product->id; ?>"><?php echo $product->name; ?></a>
                                                </p>
                                                <a href="#" id="<?php echo $product->id; ?>"
                                                   class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>В
                                                    корзину</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <a class="left recommended-item-control" id="prev" href="#recommended-item-carousel"
                       data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" id="next" href="#recommended-item-carousel"
                       data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>

                </div>
            </div><!--/recommended_items-->
        </div>
    </div>
</section>


