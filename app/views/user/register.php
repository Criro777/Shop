<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php if (isset($_SESSION['errors'])): ?>
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <?php echo '<div style="text-align: center" class="alert alert-danger">'; ?>
                        <?php echo $error; ?>
                        <?php echo ' </div>'; ?>
                    <?php endforeach; ?>

                <?php endif; ?>
                <div class="signup-form"><!--sign up form-->
                    <h2>Регистрация нового пользователя</h2>
                    <form action="/user/register" method="post" data-toggle="validator">

                        <div class="form-group has-feedback">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" type="text" name="name" placeholder="Имя" required>
                            </div>
                            <span class="glyphicon form-control-feedback reg"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input class="form-control" type="email" name="email" placeholder="E-мэйл" required>
                            </div>
                            <span class="glyphicon form-control-feedback reg "></span>
                        </div>

                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-eye-close"></i></span>
                                <input class="form-control" type="password" name="password" required
                                       placeholder="Пароль">
                            </div>
                            <span class="glyphicon form-control-feedback reg "></span>
                        </div>

                        <button type="submit" name="register" id="register_button btn btn-default"
                        ">Регистрация</button>
                    </form>
                </div><!--/sign up form-->

                <br/>
                <br/>
            </div>
        </div>
    </div>
</section><!--/form-->