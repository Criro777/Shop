<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-12 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>


                    <?php if ($result): ?>
                        <?php echo '<div class="alert alert-success">'; ?>
                        <h4 style="text-align: center;"><p>Заказ оформлен. Мы свяжемся с Вами в ближайшее время.</p>
                        </h4>
                        <?php echo ' </div>'; ?>


                    <?php else: ?>

                        <h3>Выбрано товаров: <i><?php echo $totalQuantity; ?></i>, на сумму:
                            <i><?php echo $totalPrice; ?> $.</i></h3><br/>

                        <div class="col-sm-6">
                            <?php if (isset($errors) && is_array($errors)): ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li> - <?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <h5>Для оформления заказа заполните форму</h5><br>

                            <div class="login-form">
                                <form action="/cart/checkout" method="post">

                                    <p>Ваше имя</p>

                                    <input type="text" name="userName" placeholder=""
                                           value="<?php echo $user->name; ?>"/>


                                    <p>Номер телефона</p>
                                    <input type="text" title="Введите телефон в формате 8-xxx-xxx-xx-xx"
                                           name="userPhone" pattern="8-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}"
                                           placeholder="" value="<?php echo $userPhone; ?>"/>

                                    <p>Комментарий к заказу</p>
                                    <input type="text" name="userComment" placeholder="Сообщение"
                                           value="<?php echo $userComment; ?>"/>

                                    <br/>
                                    <br/>
                                    <input type="submit" name="order" class="btn btn-default" value="Оформить"/>
                                </form>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>