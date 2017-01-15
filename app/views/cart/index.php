<section style="margin-bottom: 7%;" id="cart_section">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>

                    <?php if ($productsInCart): ?>
                        <h3><i>Вы выбрали товары:</i></h3><br>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Изображение товара</th>
                                <th>Код товара</th>
                                <th>Название</th>
                                <th>Стомость, $</th>
                                <th>Количество, шт</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><img style="width: 58px;height: 58px;" src="<?php echo \app\models\Product::getImage($product->id); ?>" alt=""/></td>
                                    <td><?php echo $product->code;?></td>
                                    <td>
                                        <a href="/product/<?php echo $product->id;?>">
                                            <?php echo $product->name;?>
                                        </a>
                                    </td>
                                    <td><?php echo \app\models\Product::getCurrentPrice($product->price)?></td>
                                    <td><?php echo $productsInCart[$product->id];?></td>
                                    <td>
                                        <a id="<?php echo $product->id;?>" class="btn btn-default checkout delete-item" id = "<?php echo $product->id;?>">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4"><b>Общая стоимость:</b></td>
                                <td><b><?php echo $totalPrice;?></b></td>
                            </tr>
                        </table>
                        <a class="btn btn-default checkout" href="/cart/checkout/"><i class="fa fa-shopping-cart"></i> Оформить заказ</a>

                        <a class="btn btn-default cart-clear" id="clear-all"><i class="fa fa-times"></i> Очистить</a>

                    <?php else: ?>
                        <p><h3 style="text-align: center;">Корзина пуста</h3></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
