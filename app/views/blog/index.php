<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="blog-post-area ">
                    <h2 class="title text-center">Блог</h2>
                    <?php foreach ($blogList as $blog): ?>
                    <div class="single-blog-post">
                        <h2><?php echo $blog->title;?></h2>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> <?php echo $blog->author;?></li>
                                <li><i class="fa fa-clock-o"></i><?php echo $blog->time;?></li>
                                <li><i class="fa fa-calendar"></i><?php echo $blog->date;?></li>
                            </ul>
                        </div>

                            <p></p><img style="width:866px; height: 478px;" src="/public/images/blog/<?php echo $blog->id;?>.jpg" alt=""></p>

                        <p class ="blog_p"><?php echo $blog->description;?></p>
                        <a  class="btn btn-primary" href="/blog/view/<?php echo $blog->id; ?>">Читать далее</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php echo $pager;?>
        </div>
    </div>
</section>