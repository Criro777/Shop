<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin-blog">Управление блогом</a></li>
                    <li class="active">Редактировать запись</li>
                </ol>
            </div>


            <h4>Добавить новый товар</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-xs-10">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Заголовок заметки</p>
                        <input type="text" name="title" placeholder="" value="<?php echo $blog->title; ?>">

                        <p>Описание заметки</p>
                        <textarea rows="10" name="description"><?php echo $blog->description; ?></textarea>

                        <br/><br/>

                        <p>Полный текст замктки</p>
                        <textarea rows="50" id="editor1" name="text"><?php echo $blog->text; ?></textarea>
                        
                        <br/><br/>
                        <p>Автор</p>
                        <input type="text" name="author" placeholder="" value="<?php echo $blog->author; ?>">


                        <input type="submit" name="update" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>