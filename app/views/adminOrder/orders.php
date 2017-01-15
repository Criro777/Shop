<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление заказами</li>
                </ol>
            </div>

            <h4>Список заказов</h4>

            <br/>


            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Имя покупателя</th>
                    <th>Телефон покупателя</th>
                    <th>Дата оформления</th>
                    <th>Статус</th>
                    <th>Смотреть</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>

                <?php foreach ($ordersList as $order): ?>
                    <tr>
                        <td>
                                <?php echo $order->id; ?>
                        </td>
                        <td><?php echo $order->user_name; ?></td>
                        <td><?php echo $order->user_phone; ?></td>
                        <td><?php echo $order->date; ?></td>
                        <td><?php echo \app\models\Order::getStatusText($order->status); ?></td>
                        <td><a href="/admin-order/view/<?php echo $order->id; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin-order/update/<?php echo $order->id; ?>" title="Редактировать"><i class="fa fa-edit"></i></a></td>
                        <td> <a href="#" data-toggle="modal" data-target="#<?php echo $order->id; ?>"><i class="fa fa-trash-o"></i></a>
                            <div class="modal fade" id="<?php echo $order->id;?>" data-backdrop="static"  >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h3>Вы действительно хотите удалить этот заказ?</h3>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/admin-order/delete/<?php echo $order->id; ?>"class="btn btn-default  btn-success">Удалить</a>
                                            <a class="btn btn-default btn-danger" data-dismiss="modal">Отмена</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>