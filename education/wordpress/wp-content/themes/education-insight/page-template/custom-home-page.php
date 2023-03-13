<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
  <?php if( get_theme_mod('education_insight_hide_show') != ''){ ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <?php
          for ( $i = 1; $i <= 4; $i++ ) {
            $education_insight_mod =  get_theme_mod( 'education_insight_post_setting' . $i );
            if ( 'page-none-selected' != $education_insight_mod ) {
              $education_insight_slide_post[] = $education_insight_mod;
            }
          }
           if( !empty($education_insight_slide_post) ) :
          $education_insight_args = array(
            'post_type' =>array('post','page'),
            'post__in' => $education_insight_slide_post
          );
          $education_insight_query = new WP_Query( $education_insight_args );
          if ( $education_insight_query->have_posts() ) :
            $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $education_insight_query->have_posts() ) : $education_insight_query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
            <div class="carousel-caption">
              <div class="inner_carousel">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                <p><?php $education_insight_excerpt = get_the_excerpt(); echo esc_html( education_insight_string_limit_words( $education_insight_excerpt, 15 )); ?></p>
              </div>
            </div>
          </div>
          <?php $i++; endwhile;
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
          </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php if( get_theme_mod('education_insight_middle_sec_page_settigs') != '' || get_theme_mod('education_insight_middle_sec_settigs') != ''){ ?>
    <section id="middle-sec">
      <div class="container">
        <div class="middle-sec-inner">
          <div class="row">
            <div class="col-lg-4 col-md-4">
              <?php
                $education_insight_mod =  get_theme_mod( 'education_insight_middle_sec_page_settigs' );
                if ( 'page-none-selected' != $education_insight_mod ) {
                  $education_insight_page[] = $education_insight_mod;
                }
                if( !empty($education_insight_page) ) :
                $education_insight_args = array(
                  'post_type' =>'page',
                  'post__in' => $education_insight_page
                );
                $education_insight_query = new WP_Query( $education_insight_args );
                if ( $education_insight_query->have_posts() ) :
              ?>
              <?php  while ( $education_insight_query->have_posts() ) : $education_insight_query->the_post(); ?>
                <div class="middle-sec-box">
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                  <p><?php $education_insight_excerpt = get_the_excerpt(); echo esc_html( education_insight_string_limit_words( $education_insight_excerpt, 40 )); ?></p>
                </div>
              <?php endwhile;
              wp_reset_postdata();?>
              <?php else : ?>
              <div class="no-postfound"></div>
                <?php endif;
              endif;?>
            </div>
            <div class="col-lg-8 col-md-8">
              <div class="row">
                <?php
                  for ( $education_insight_s = 1; $education_insight_s <= 4; $education_insight_s++ ) {
                    $education_insight_mod =  get_theme_mod( 'education_insight_middle_sec_settigs'.$education_insight_s );
                    if ( 'page-none-selected' != $education_insight_mod ) {
                      $education_insight_post[] = $education_insight_mod;
                    }
                  }
                   if( !empty($education_insight_post) ) :
                  $education_insight_args = array(
                    'post_type' =>array('post','page'),
                    'post__in' => $education_insight_post
                  );
                  $education_insight_query = new WP_Query( $education_insight_args );
                  if ( $education_insight_query->have_posts() ) :
                    $education_insight_s = 1;
                ?>
                <?php  while ( $education_insight_query->have_posts() ) : $education_insight_query->the_post(); ?>
                  <div class="col-lg-3 col-md-6 pl-lg-0 pl-md-0">
                    <div class="<?php echo('mid-inner-box').$education_insight_s ?>">
                      <i class="<?php echo esc_html(get_theme_mod('education_insight_mid_section_icon'.$education_insight_s)); ?>"></i>
                      <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                      <p><?php $education_insight_excerpt = get_the_excerpt(); echo esc_html( education_insight_string_limit_words( $education_insight_excerpt, 8 )); ?></p>
                    </div>
                  </div>
                <?php $education_insight_s++; endwhile;
                wp_reset_postdata();?>
                <?php else : ?>
                <div class="no-postfound"></div>
                  <?php endif;
                endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php }?>

  <?php if( get_theme_mod('education_insight_popular_courses_heading') != '' || get_theme_mod('education_insight_popular_courses_setting') != ''){ ?>
    <section id="course-cat">
      <div class="container">
        <?php if( get_theme_mod('education_insight_popular_courses_heading') != ''){ ?>
          <h3><?php echo esc_html(get_theme_mod('education_insight_popular_courses_heading','')); ?></h3>
          <hr class="top">
          <hr class="down">
        <?php }?>
        <div class="row">
          <?php
          $education_insight_catData1=  get_theme_mod('education_insight_popular_courses_setting');if($education_insight_catData1){
          $education_insight_page_query = new WP_Query(array( 'category_name' => esc_html($education_insight_catData1 ,'education-insight')));?>
            <?php while( $education_insight_page_query->have_posts() ) : $education_insight_page_query->the_post(); ?>
              <div class="col-lg-3 col-md-3">
                <div class="box">
                  <?php the_post_thumbnail(); ?>
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                  <p><?php $education_insight_excerpt = get_the_excerpt(); echo esc_html( education_insight_string_limit_words( $education_insight_excerpt, 15 )); ?></p>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          }?>
        </div>
      </div>
    </section>
  <?php }?>
</main>

<?php get_footer(); ?>
