<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="blog-post-area">
                    <h2 class="title text-center"><?php echo $blog->title;?></h2>
                    <div class="single-blog-post">
                        <h2><?php echo $blog->title;?></h2>
                        <div  class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i><?php echo $blog->author;?></li>
                                <li><i class="fa fa-clock-o"></i><?php echo $blog->time;?></li>
                                <li><i class="fa fa-calendar"></i><?php echo $blog->date;?></li>
                            </ul>

                        </div>
                            <p><img style="width:866px; height: 478px;: center;" src="/public/images/blog/<?php echo $blog->id;?>.jpg" alt=""></p>
                       <article><?php echo $blog->text;?></article>


                    </div>
                </div><!--/blog-post-area-->

                <div class="rating-area">
                    <ul class="ratings">
                        <li class="rate-this">Rate this item:</li>
                        <li>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </li>
                        <li class="color">(6 votes)</li>
                    </ul>
                    <ul class="tag">
                        <li>TAG:</li>
                        <li><a class="color" href="">Pink <span>/</span></a></li>
                        <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                        <li><a class="color" href="">Girls</a></li>
                    </ul>
                </div><!--/rating-area-->

                <div class="socials-share">
                    <a href=""><img src="images/blog/socials.png" alt=""></a>
                </div><!--/socials-share-->
                
            </div>
        </div>
    </div>
</section>