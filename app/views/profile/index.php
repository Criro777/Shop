<section style="margin-bottom: 18%">
    <div class="container">
        <div class="row">

            <h1>Профиль пользователя</h1><br>
            <h3>Привет, <i><?php echo $user->name;?>!</i></h3>
            <h3>Привет, <i><?php echo $user->time;?></i></h3>
            <ul>
                <li><a href="/cabinet/edit">Редактировать данные</a></li>
                <li><a href="/cabinet/history">Список покупок</a></li>
            </ul>

        </div>
    </div>
</section>