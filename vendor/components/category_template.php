<li>
    <a href="/category/<?=$category['id']?>"><?=$category['name']?>

        <?php if( isset($category['childs']) ): ?>
            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
        <?php endif;?>
    </a>
    <?php if($category['childs']): ?>
        <ul>
            <?php echo \vendor\components\TreeCategory::categories_to_string($category['childs']); ?>
        </ul>
    <?php endif; ?>
</li>