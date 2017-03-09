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
                            <div class="view-product gallery">
                                <a href="<?php echo \app\models\Product::getImage($product->id); ?>"> <img
                                        style="width: 291px; height: 291px;"
                                        src="<?php echo \app\models\Product::getImage($product->id, 'mini'); ?>"
                                        alt=""/></a>

                                <h5 style="text-align: center;">Увеличить</h5>
                                <a href="<?php echo \app\models\Product::getImage(105); ?>"><img
                                        style="width: 95px;height: 90px;"
                                        src="<?php echo \app\models\Product::getImage(105, 'mini'); ?>" alt=""/></a>
                                <a href="<?php echo \app\models\Product::getImage(56); ?>"><img
                                        style="width: 95px;height: 90px;"
                                        src="<?php echo \app\models\Product::getImage(56, 'mini'); ?>" alt=""/></a>
                                <a href="<?php echo \app\models\Product::getImage(55); ?>"><img
                                        style="width: 95px;height: 90px;"
                                        src="<?php echo \app\models\Product::getImage(55, 'mini'); ?>" alt=""/></a>


                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <?php if ($product->is_new): ?>
                                    <img src="/public/images/product-details/new.jpg" class="newarrival" alt=""/>
                                <? endif; ?>
                                <h2><?php echo $product->name; ?></h2>
                                <p><b>Код товара: </b><?php echo $product->code; ?></p>
                                <span>
                                    <span><?php echo \app\models\Product::getCurrentPrice($product->price) ?></span>
                                    <label>Количество:</label>
                                    <input type="text" name="quantity" id="quantity" value="1"/>
                                   <button type="button" id="<?php echo $product->id; ?>"
                                           class="btn btn-default add-to-cart">
                                       <i class="fa fa-shopping-cart"></i>
                                       В корзину
                                   </button>
                                </span>
                                <?php if ($product->availability): ?>
                                    <p><b>Наличие:</b> На складе</p>
                                <?php endif; ?>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> <?php echo $product->brand; ?> </p>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->
                    <br>
                    <hr>
                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#details" data-toggle="tab">Описание</a></li>
                                <li><a href="#reviews" data-toggle="tab">Отзывы</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="details">
                                <div class="col-sm-12">
                                    <h4>Описание товара:</h4>
                                    <div style="margin-left: 15px;"><?php echo $product->description; ?></div>
                                </div>
                            </div>


                            <div class="tab-pane fade " id="reviews">

                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis
                                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                    dolore eu fugiat nulla pariatur.</p>
                                <br><br>
                                <h3><i>Оставьте Ваш отзыв о данном товаре:</i></h3>

                                <form data-toggle="validator">
                                    <div class="form-group">
                                        <label for="name"><span>*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Ваше Имя"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><span>*</span></label>
                                        <input style="outline:none;" type="email" name="email" class="form-control"
                                               placeholder="E-mail адрес"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><span>*</span></label>
                                            <textarea name="review" required class="form-control" rows="6"
                                                      placeholder="Ваше сообщение"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default">Отправить</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div><!--/category-tab-->

                </div>

            </div>
        </div>
    </div>
</section>