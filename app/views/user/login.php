<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php if (isset($errors1)): ?>
                    <?php foreach ($errors1 as $error): ?>
                        <div class="alert alert-danger">
                        <?php echo $error->getMessage(); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="login-form"><!--login form-->
                    <h2>Вход</h2>
                    <form id= "login" action="/user/login" method="post">
                        <input type="email" name="email" placeholder="E-мэйл" />
                        <input type="password" name="password" placeholder="Пароль"/>
							<span>
								<input type="checkbox" name="remember">
								Запомнить меня
							</span>
                        <button type="submit" name="login" class="btn btn-default">Войти</button>

                    </form>
                </div><!--/login form-->

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