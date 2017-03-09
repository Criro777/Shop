<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php if (isset($_SESSION['success'])): ?>
                    <div style="text-align: center;" class="alert alert-success">Регистрация прошла успешно!
                        Войдите под своим именем!
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['errors'])): ?>
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="login-form"><!--login form-->
                    <h2>Вход</h2>
                    <form action="/user/login" method="post" data-toggle="validator">

                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input class="form-control" type="email" name="email" required placeholder="E-мэйл">

                            </div>
                            <span class="glyphicon form-control-feedback "></span>
                        </div>

                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-eye-close"></i></span>
                                <input class="form-control" type="password" name="password" required placeholder="Пароль">
                            </div>

                            <span class="glyphicon form-control-feedback "></span>
                        </div>

							<span>
								<input type="checkbox" name="remember">
								Запомнить меня
							</span>
                        <button type="submit" name = "login" id="login_button" class="btn btn-default">Войти</button>

                    </form>


                    <!--/sign up form-->
                    <div class="signup-form"><!-sign up form->
                        <hr>
                        <form action="/user/register/" method="post">
                            <button type="submit">Создать новую учетную запись</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
</section><!--/form-->