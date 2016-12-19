<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title text-center">Contact <strong>Us</strong></h2>
                <div id="map_container">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">

                <?php if ($result): ?>
                    <?php echo '<div class="alert alert-success">'; ?>
                    <?php echo '<p style="text-align: center;">Сообщение отправлено!<br> Мы ответим Вам на указанный email.</p>' ?>
                    <?php echo ' </div>'; ?>
                <?php endif; ?>
                
                <div class="contact-form">
                    <h2 class="title text-center">Связаться с нами</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Имя">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="userEmail" class="form-control" required="required" placeholder="E-mail адрес">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" required="required" placeholder="Тема">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="textMessage" id="message" required="required" class="form-control" rows="8" placeholder="Ваше сообщение"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="message" class="btn btn-primary pull-left" value="Отправить">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Контактные данные</h2>
                    <address>
                        <p>E-Shopper Inc.</p>
                        <p>Проспект Мира 21/2, офис 306, 127000</p>
                        <p>Москва Россия</p>
                        <p>Mobile: +7 926 123 45 67</p>
                        <p>Fax: 1-714-252-0026</p>
                        <p>Email: info@e-shopper.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Мы в соцсетях</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->