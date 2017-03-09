<section>

    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <div class="blog-post-area">
                    <h2 class="title text-center"><?php echo $blog->title; ?></h2>
                    <div class="single-blog-post">
                        <h2><?php echo $blog->title; ?></h2>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i><?php echo $blog->author; ?></li>
                                <li><i class="fa fa-clock-o"></i><?php echo $blog->time; ?></li>
                                <li><i class="fa fa-calendar"></i><?php echo $blog->date; ?></li>
                            </ul>

                        </div>
                        <p><img style="width:866px; height: 478px;: center;"
                                src="/public/images/blog/<?php echo $blog->id; ?>.jpg" alt=""></p>
                        <article><?php echo $blog->text; ?></article>


                    </div>
                </div><!--/blog-post-area-->
                <hr>
                <h4>Оцените данную статью:</h4>
                <br>

                <div style="float: left; margin-left:5%; margin-top: 5px;" class="tip1" data-toggle="tooltip"></div>


                <?php if ($isVoted ): ?>

                <div style=" clear:left;float:left; margin-top:0px; height: 40px; width: 115px; cursor: default;"
                     class="area disabled" id="<?php echo $blog->id; ?>"
                     data="<?php echo(round($blog->rate / $blog->voted)); ?>">

                    <?php else: ?>
                    <div style=" clear:left;float:left; margin-top:0px; height: 40px; width: 115px; cursor: default;"
                         class="area" id="<?php echo $blog->id; ?>"
                         data="<?php echo(round($blog->rate / $blog->voted)); ?>">



                        <?php endif; ?>


                    </div><!--/rating-area-->
                    <div style="float: left;  margin-top:0px; margin-left: 10px; ">(Всего голосов: <span
                            style="color:#eb8f00;" class="color"><?php echo $blog->voted; ?></span>)
                    </div>

                    <div style="clear: left; margin-top: 80px;" class="socials-share">
                        <a href="#"><img src="/public/images/blog/socials.png" alt=""></a>
                    </div><!--/socials-share-->
                    <h2>Комментарии :</h2>


                    <div class="replay-box">
                        <div class="row">
                            <div class="col-sm-4">
                                <h2>Напишите свой комментарий</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-7">
                                <div class="text-area">
                                    <div class="blank-arrow">
                                        <label>Ваш комментарий</label>
                                    </div>
                                    <span>*</span>
                                    <textarea name="message" rows="7"></textarea>
                                    <a class="btn btn-primary" href="">Отправить</a>
                                </div>
                            </div>
                        </div>
                    </div><!--/Repaly Box-->
                    <div class="media commnets">

                        <div class="media-body">
                            <h2 class="media-heading">Annie Davis</h2>
                            <p style="font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <div class="blog-socials">
                                <a class="btn btn-primary" href="">все комментарии</a>
                            </div>
                        </div>
                    </div><!--Comments-->
                </div>
            </div>
        </div>
</section>