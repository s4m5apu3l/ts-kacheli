<?php

get_header();

?>
<?php
/* Template Name: all */
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
          <a href="/news" class="all-page__hover py-[6px] px-[21px] text-base font-bold leading-[18px] text-white ">Новости</a>
          <a href="/aksii" class="all-page__hover py-[6px] px-[21px] text-base font-bold leading-[18px] text-white ">Акции</a>
          <a href="/skidki" class="all-page__hover py-[6px] px-[21px] text-base font-bold leading-[18px] text-white ">Скидки</a>
        </div>

      </div>


    </div>

    <div class=" l-wrapper max-[768px]:mt-[40px] mt-[80px] max-[560px]:px-[22px] max-[1250px]:px-[50px] max-[1400px]:px-[100px] px-[178px] overflow-x-hidden">
      <div id='news-container' class="grid-items-news gap-[1px] max-[850px]:mt-[60px] mt-[80px] max-[950px]:grid-cols-2  grid-cols-3 grid">

      <?php
        // Создаем массив для всех постов
        $all_posts = array();

        // Запрос для типа записи 'news'
        $news_posts = get_posts(array(
          'numberposts' => -1,
          'post_type' => 'news',
          'orderby' => 'date',
          'order' => 'DESC',
        ));

        // Добавляем новости в массив
        $all_posts = array_merge($all_posts, $news_posts);

        // Запрос для типа записи 'aksii'
        $aksii_posts = get_posts(array(
          'numberposts' => -1,
          'post_type' => 'aksii',
          'orderby' => 'date',
          'order' => 'DESC',
        ));

        // Добавляем акции в массив
        $all_posts = array_merge($all_posts, $aksii_posts);

        // Запрос для типа записи 'skidki'
        $skidki_posts = get_posts(array(
          'numberposts' => -1,
          'post_type' => 'skidki',
          'orderby' => 'date',
          'order' => 'DESC',
        ));

        // Добавляем скидки в массив
        $all_posts = array_merge($all_posts, $skidki_posts);

        usort($all_posts, function($a, $b) {
          return strtotime($b->post_date) - strtotime($a->post_date);
        });

        // Выводим все посты
        foreach ($all_posts as $post) {
          
          setup_postdata($post);
          $date = get_post_meta(get_the_id(), 'date_time', true);
          $post_type = get_post_type();
          ?>
                  <a href="<?php the_permalink() ?>" class="max-[490px]:h-[270px] max-[525px]:h-[350px] max-[768px]:h-[400px] h-[500px] max-[680px]:max-w-full group transition-all duration-200 flex items-end w-full relative">
            <img class="object-cover absolute z-0 w-full h-full left-0 right-0 top-0 bottom-0" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">

            <div style='height:50%' class="flex flex-col max-[490px]:pb-[10px] max-[768px]:h-[50%] max-[768px]:pt-[10px] group-hover:bg-[#C32E4499] transition-all duration-200 bg-[#00000099] z-20 w-full h-[50%] pb-[22px] pt-[67px]">
              <div class="max-[490px]:h-[20px] max-[768px]:pl-[10px] max-[768px]:pr-[13px] max-[425px]:text-[10px] max-[768px]:w-fit max-w-[130px] flex items-center bg-[#F3F2EA] py-[6px] pl-[30px] pr-[22px] text-black text-base font-bold">
              <?php
                // Вывод заголовка и текста в зависимости от типа записи
                switch ($post_type) {
                  case 'news':
                    echo 'Новости';
                    break;
                  case 'aksii':
                    echo 'Акции';
                    break;
                  case 'skidki':
                    echo 'Скидки';
                    break;
                }
                ?>
              </div>
              <div class="max-[490px]:mt-[10px] max-[768px]:px-[10px] px-[30px] mt-[20px]">
                <span class="max-[768px]:text-base max-[490px]:text-[12px] text-dots text-white text-[20px] font-bold leading-[23px]">
                  <?php echo the_title() ?>
                </span>
              </div>
              <div class="max-[768px]:pl-[10px] mt-auto pl-[30px] flex items-center gap-[10px]">
              <?php if (!empty($date) && $date !== '0000-00-00') { ?>
                <img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
                  <span class="text-white text-[14px] font-bold">
                    <?php
                    $formatted_date = date('d.m.Y', strtotime($date));
                    echo $formatted_date;
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
    </div>
  </section>
</main>

<?php

get_footer();

?>