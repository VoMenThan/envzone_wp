<?php
global $wp_query;

$terms = get_terms(array(
    'taxonomy' => 'danh_muc_tin_tuc',
    'hide_empty' => false,
    'orderby' => 'id',
    'order' => 'asc',
    'parent' => 0
));

foreach ( $terms as $k => $v) {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'tin_tuc',
        'order' => 'desc',
        'tax_query' => array(
            array(
                'taxonomy' => 'danh_muc_tin_tuc',
                'field' => 'id',
                'orderby' => 'id',
                'order' => 'desc',
                'terms' => $v->term_id
            )
        )
    );
    $terms[$k]->list = get_posts($args);

}

$args = array(
    'posts_per_page' => -1,
    'offset'=> 0,
    'post_type' => 'tin_tuc',
    'orderby' => 'id',
    'order' =>'desc'
);
$news_all = get_posts( $args );
?>

<section class="category_page">
    <div class="container">

        <?php include(INC."breadcrumb.php");?>

        <article class="list-news">
            <div class="row">
                <?php
                    $val = $terms[0]->list;
                    foreach ($val as $item):
                    $image_featured = get_the_post_thumbnail_url($item->ID);
                    $term = get_the_terms( $item->ID, 'danh_muc_tin_tuc' );
                    ?>
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $image_featured?>" alt="Card image cap">
                            <div class="card-body">
                                <div class="date"><?php echo get_the_date( 'd-m-Y', $item->ID );;?></div>
                                <a href="<?php echo get_home_url()."/truyen-thong/". $item->post_name; ?>"><h5 class="card-title"><?php echo $item->post_title;?></h5></a>
                                <span class="category-name"><?php echo $term[0]->name;?></span>
                            </div>
                            <div class="box-hover">
                                <div class="date"><i class="icon-document"></i> <?php echo get_the_date( 'd-m-Y', $item->ID );;?></div>
                                <h5 class="card-title"><?php echo $item->post_title;?></h5>
                                <p>
                                    <?php echo $item->post_excerpt;?>
                                </p>
                                <span class="category-name"><?php echo $terms[0]->name;?></span>

                                <a class="btn-gradient-slide btn-view-more" href="<?php echo get_home_url()."/truyen-thong/". $item->post_name; ?>">Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>

            <div class="text-center p-5">
                <a class="btn-gradient-slide load-more" href="#" role="button">TẢI THÊM +</a>
            </div>

        </article>
    </div>





</section>