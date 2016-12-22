<section id="admin_prod">


    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li class="active">Управление товарами</li>
                </ol>
            </div>

            <a href="/admin/create-product" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить товар</a>

            <h4>Список товаров</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>Изображение товара</th>
                    <th>id товара</th>
                    <th>Код товара</th>
                    <th>Название</th>
                    <th>Стомость, $</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>

                <?php foreach ($productList as $product): ?>
                    <tr>
                        <td><img style="width: 58px;height: 58px;" src="<?php echo \app\models\Product::getImage($product->id); ?>" alt=""/></td>
                        <td><?php echo $product->id;?></td>
                        <td><?php echo $product->code; ?></td>
                        <td><a href="/product/<?php echo $product->id; ?>"><?php echo $product->name; ?></a></td>
                        <td><?php echo $product->price; ?></td>
                        <td><a href="/admin/update-product/<?php echo $product->id; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td> <a href="#" data-toggle="modal" data-target="#<?php echo $product->id; ?>"><i class="fa fa-trash-o"></i></a>
                                <div class="modal fade" id="<?php echo $product->id;?>" data-backdrop="static"  >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h3>Вы действительно хотите удалить этот товар ?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/admin/delete-product/<?php echo $product->id; ?>"class="btn btn-default  btn-success">Удалить</a>
                                                <a class="btn btn-default btn-danger" data-dismiss="modal">Отмена</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $pager;?>

        </div>
    </div>
</section>