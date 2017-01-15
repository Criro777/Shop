<section id="admin_prod">


    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li class="active">Управление блогом</li>
                </ol>
            </div>

            <a href="/admin-blog/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить новую
                запись</a>

            <h4>Список записей в блоге</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>Изображение записи</th>
                    <th>id</th>
                    <th>Заголовок записи</th>
                    <th>Описание записи</th>
                    <th>Автор записи</th>
                    <th>Дата записи</th>
                    <th>Время записи</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>

                <?php foreach ($blogList as $blog): ?>
                    <tr>
                        <td><img style="width: 100px;height: 70px;" src="<?php echo \app\models\Blog::getImage($blog->id); ?>" alt=""/></td>
                        <td><?php echo $blog->id; ?></td>
                        <td><?php echo $blog->title; ?></td>
                        <td><?php echo $blog->description; ?></td>
                        <td><?php echo $blog->author; ?></td>
                        <td><?php echo $blog->date; ?></td>
                        <td><?php echo $blog->time; ?></td>

                        <td><a href="/admin-blog/update/<?php echo $blog->id; ?>" title="Редактировать"><i
                                    class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="#" data-toggle="modal" data-target="#<?php echo $blog->id; ?>"><i
                                    class="fa fa-trash-o"></i></a>
                            <div class="modal fade" id="<?php echo $blog->id; ?>" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h3>Вы действительно хотите удалить эту запись ?</h3>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/admin-blog/delete/<?php echo $blog->id; ?>"
                                               class="btn btn-default  btn-success">Удалить</a>
                                            <a class="btn btn-default btn-danger" data-dismiss="modal">Отмена</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $pager; ?>

        </div>
    </div>
</section>