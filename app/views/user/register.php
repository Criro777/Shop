<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php if ($success): ?>
                    <div style="text-align: center;" class="alert alert-success">Вы успешно зарегистрированы!</div>
                <?php else: ?>
                <?php if (isset($errors)): ?>
                    <?php foreach ($errors as $error): ?>
                        <?php echo '<div style="text-align: center" class="alert alert-danger">'; ?>
                        <?php echo $error->getMessage(); ?>
                        <?php echo ' </div>'; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                <div class="signup-form"><!--sign up form-->
                    <h2>Регистрация нового пользователя</h2>
                    <form action="/user/register" method="post">
                        <input type="text" name ="name" placeholder="Имя" value="<?php echo $_POST['name']?>"/>
                        <input type="email" name="email" placeholder="E-мэйл" value="<?php echo $_POST['email']?>"/>
                        <input type="password" name="password" placeholder="Пароль"/>
                        <button type="submit" name="register" class="btn btn-default">Регистрация</button>
                    </form>
                </div><!--/sign up form-->
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section><!--/form-->