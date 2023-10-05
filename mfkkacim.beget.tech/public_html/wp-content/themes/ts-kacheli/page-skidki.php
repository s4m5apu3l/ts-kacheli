<?php

get_header();

?>
<?php 
  /* Template Name: skidki */
?>
  <main>

    <section class="pb-[200px] pt-[76px] border border-[#2D2D2D]">
      <div class="l-wrapper flex justify-between items-center ">
        <div class="max-[850px]:flex-col flex justify-between w-full items-center gap-[20px]">
          <div class="max-[850px]:text-center max-[850px]:w-full max-[850px]:justify-center max-[850px]:gap-[20px] flex gap-[45px] items-center">
            <div class="max-[850px]:hidden w-[35px] h-[35px] bg-white"></div>
            <h2 class="max-[540px]:text-[30px] text-[40px] font-bold text-white">
            НОВОСТИ, АКЦИИ И СКИДКИ
            </h2>
            
          </div>

          <div class="flex items-center">
            <a href="/news" class="py-[6px] px-[21px] text-base font-bold leading-[18px] text-white ">Новости</a>
            <a href="/aksii" class="py-[6px] px-[21px] text-base font-bold leading-[18px] text-white ">Акции</a>
            <a href="/skidki" class="py-[6px] px-[21px] text-base font-bold leading-[18px] text-white active-news-link">Скидки</a>
          </div>

        </div>


      </div>

      <div class=" l-wrapper max-[768px]:mt-[40px] mt-[80px] max-[560px]:px-[22px] max-[1250px]:px-[50px] max-[1400px]:px-[100px] px-[178px] overflow-x-hidden">
        <div id='skidki-container' class="grid-items-news gap-[1px] max-[850px]:mt-[60px] mt-[80px] max-[950px]:grid-cols-2  grid-cols-3 grid">

          <?php
            // параметры по умолчанию
            $my_posts = get_posts( array(
              'numberposts' => 10,
              'category'    => 0,
              'orderby'     => 'date DESC',
              'order'       => 'DESC',
              'include'     => array(),
              'exclude'     => array(),
              'meta_key'    => '',
              'meta_value'  =>'',
              'post_type'   => 'skidki',
              'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
            ) );

            global $post;

            foreach( $my_posts as $post ){
              setup_postdata( $post );
              $date_start = get_post_meta(get_the_id(), 'date-time-start', true);
              $date_end = get_post_meta(get_the_id(), 'date-time-end', true);
                ?> 
                  <a href="<?php the_permalink()?>" class="max-[490px]:h-[270px] max-[525px]:h-[350px] max-[768px]:h-[400px] h-[500px] max-[680px]:max-w-full group transition-all duration-200 flex items-end w-full relative">
                    <img class="object-cover absolute z-0 w-full h-full left-0 right-0 top-0 bottom-0" src="<?php echo get_the_post_thumbnail_url();?>" alt="">

                    <div style='height:50%' class="flex flex-col max-[490px]:pb-[10px] max-[768px]:h-[50%] max-[768px]:pt-[10px] group-hover:bg-[#C32E4499] transition-all duration-200 bg-[#00000099] z-20 w-full h-[50%] pb-[22px] pt-[67px]">
                      <div
                        class="max-[490px]:h-[20px] max-[768px]:pl-[10px] max-[768px]:pr-[13px] max-[425px]:text-[10px] max-[768px]:w-fit max-w-[130px] flex items-center bg-[#F3F2EA] py-[6px] pl-[30px] pr-[22px] text-black text-base font-bold">
                        Скидки
                      </div>
                      <div class="max-[490px]:mt-[10px] max-[768px]:px-[10px] px-[30px] mt-[20px]">
                        <span class="max-[768px]:text-base max-[490px]:text-[12px] text-dots text-white text-[20px] font-bold leading-[23px]">
                          <?php echo the_title() ?>
                        </span>
                      </div>
                      <div class="max-[768px]:pl-[10px] mt-auto pl-[30px] flex items-center gap-[10px]">
                      <?php if (!empty($date_start) && $date_start !== '0000-00-00' && !empty($date_end) && $date_end !== '0000-00-00') { ?>
                      <img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
                        <span class="text-white text-[14px] font-bold">
                          <?php
                          $formatted_date_start = date('d.m.Y', strtotime($date_start));
                          echo $formatted_date_start;
                          ?> - <?php
                          $formatted_date_end = date('d.m.Y', strtotime($date_end));
                          echo $formatted_date_end;
                          ?>
                        </span>
                      <?php } ?>
                      </div>
                    </div>
                  </a>
                <?php
            }

            wp_reset_postdata(); // сброс
          ?>

        </div>
        <div class=" max-[768px]:mt-[40px] max-w-[210px] mx-auto mt-[60px] relative z-20">
          <a href="javascript:void(0)"
            id="load-more-skidki"
            class="block border-[3px] border-white px-[30px] py-[19px] leading-[16px] text-center uppercase text-base font-bold text-white hover:bg-main hover:border-main transition-all duration-200">
            ЕЩЕ
          </a>
        </div>
      </div>
    </section>
  </main>

<?php

get_footer();

?>