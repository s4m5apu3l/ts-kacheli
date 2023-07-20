<?php

get_header();

?>
<main>
  <section class="max-[560px]:px-[22px] max-[1250px]:px-[50px] max-[1400px]:px-[100px] px-[178px] overflow-x-hidden">
    <div class="js-main-banner swiper max-w-[1180px] h-[650px] w-full">
      <div class="swiper-wrapper">

        <?php
        // Получаем последние 8 новостей
        $pods = pods('banner', []);

        if ($pods->total() > 0) {
          while ($pods->fetch()) {
            // Получаем значения полей
            $title = $pods->field('title');
            $title_mini = $pods->field('title-mini');
            $url = $pods->field('url-custom');

            $post_id = $pods->id();
            $thumbnail_url = get_the_post_thumbnail_url($post_id);
        ?>  
            <div class="swiper-slide">
              <div class="max-[768px]:justify-end   flex flex-col items-start justify-center  w-full h-full">
                <div class="max-[768px]:bg-[#00000099] max-[768px]:px-[40px] px-[80px] py-[40px] flex flex-col h-auto w-full">
                  <img style="filter:brightness(0.7)" class="object-cover w-full h-full absolute left-0 right-0 top-0 bottom-0 z-[-1]" src="<?php echo $thumbnail_url; ?>" alt="">
                  <span class="text-break max-[768px]:leading-[34px] max-[768px]:text-[30px] text-white text-[40px] leading-[46px] font-bold">
                    <?php echo $title ?>
                  </span>
                  <span class="text-break max-[768px]:mt-[20px] text-white text-[20px]  font-bold mt-[5px]">
                    <?php echo $title_mini ?>
                  </span>

                  <div class="max-[768px]:mt-[48px] mt-[32px]">
                    <?php  if ($url) :?>
                      <a href="<?php echo $url; ?>" target="_blank" class="max-[768px]:leading-[18px] max-[768px]:p-0 max-[768px]:items-center max-[768px]:gap-[10px] max-[768px]:border-0 max-[768px]:flex block max-w-[200px] border-[3px] border-white px-[30px] py-[15px] text-center uppercase text-base font-bold text-white hover:bg-main hover:border-main transition-all duration-200">
                        Подробнее
                        <svg class="max-[768px]:block hidden" width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1.56215 8.384e-07L5.46053 4.12286C5.63156 4.30369 5.76723 4.51838 5.85979 4.75468C5.95236 4.99097 6 5.24423 6 5.5C6 5.75577 5.95236 6.00903 5.85979 6.24532C5.76723 6.48162 5.63156 6.69631 5.46053 6.87714L1.56215 11L-6.4419e-07 9.34712L3.6406 5.5L0.00294658 1.65288L1.56215 8.384e-07Z" fill="#F3F2EA" />
                        </svg>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
        <?php
          }
        } else {
          // Если новостей не найдено
          echo 'Новостей не найдено.';
        }
        ?>

      </div>

      <div class="max-[768px]:hidden z-10 absolute bottom-[40px] left-[70px] w-[220px] justify-center flex items-center ">
        <div class="js-main-banner__next css-btn__next swiper-button-next"></div>
        <div class="js-main-banner__prev css-btn__prev swiper-button-prev"></div>
        <div class="counter text-white"></div>
      </div>
    </div>
  </section>

  <!-- news section -->
  <section class="max-[768px]:py-[100px] pt-[160px]">
    <div class="l-wrapper flex justify-between items-center ">

      <div class="max-[850px]:text-center max-[850px]:w-full max-[850px]:justify-center max-[850px]:gap-[20px] flex gap-[45px] items-center">
        <div class="max-[850px]:hidden w-[35px] h-[35px] bg-white"></div>
        <h2 class="text-[40px] font-bold text-white">
          НОВОСТИ, АКЦИИ И СКИДКИ
        </h2>
      </div>

      <div class="max-[1350px]:hidden w-full bg-[#2D2D2D] h-[2px] max-w-[217px]"></div>

      <div class="max-[850px]:hidden w-[120px] flex items-center gap-[20px] relative">
        <div class="js-swiper-news__prev swiper-button-prev css-btn__prev"></div>
        <div class="js-swiper-news__next swiper-button-next css-btn__next"></div>
      </div>

    </div>

    <div class="max-[768px]:mt-[40px] mt-[80px] max-[560px]:px-[22px] max-[1250px]:px-[50px] max-[1400px]:px-[100px] px-[178px] overflow-x-hidden">
      <div class="swiper  max-w-[1180px] js-swiper-news">
        <div class="swiper-wrapper">

          <?php
          // Получаем последние 8 новостей
          $pods = pods('news', [
            'limit' => 3, // Ограничиваем количество новостей до 8
            'orderby' => 'date DESC', // Сортируем по дате в порядке убывания
          ]);

          if ($pods->total() > 0) {
            while ($pods->fetch()) {
              // Получаем значения полей
              $title = $pods->field('title');
              $content = $pods->field('content');
              $date = $pods->field('date_time');

              // Преобразуем название в URL-адрес
              $permalink = sanitize_title($title);

              $post_id = $pods->id();
              $thumbnail_url = get_the_post_thumbnail_url($post_id);
              // Выводим информацию о новости
          ?>
              <div class="swiper-slide">
                <a href="/news/<?php echo $permalink; ?>" class="max-[680px]:max-w-full group transition-all duration-200 max-w-[400px] h-[500px] flex items-end w-full relative">
                  <img class="object-cover absolute z-0 w-full h-full left-0 right-0 top-0 bottom-0" src="<?php echo $thumbnail_url; ?>" alt="">

                  <div class="group-hover:bg-[#C32E4499] flex flex-col justify-between transition-all duration-200 bg-[#00000099] z-20 w-full h-[250px] pb-[22px] pt-[67px]">
                    <div class="flex flex-col">

                      <div class="max-w-[130px] flex items-center bg-[#F3F2EA] py-[6px] pl-[30px] pr-[22px] text-black text-base font-bold">
                        Новости
                      </div>
                      <div class="px-[30px] mt-[20px]">
                        <span class="text-dots text-white text-[20px] font-bold leading-[23px]">
                          <?php echo $title ?>
                        </span>
                      </div>
                    </div>
                    <div class=" pl-[30px] flex items-center gap-[10px]">
                      <img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
                      <span class="text-white text-[14px] font-bold">
                        <?php
                        $formatted_date = date('d.m.Y', strtotime($date));
                        echo $formatted_date;
                        ?>
                      </span>
                    </div>
                  </div>
                </a>
              </div>
          <?php
            }
          }
          ?>

          <?php
          $pods = pods('aksii', [
            'limit' => 3, // Ограничиваем количество новостей до 8
            'orderby' => 'date DESC', // Сортируем по дате в порядке убывания
          ]);

          if ($pods->total() > 0) {
            while ($pods->fetch()) {
              // Получаем значения полей
              $title = $pods->field('title');
              $content = $pods->field('content');
              $date_start = $pods->field('date-time-start');
              $date_end = $pods->field('date-time-end');

              // Преобразуем название в URL-адрес
              $permalink = sanitize_title($title);

              $post_id = $pods->id();
              $thumbnail_url = get_the_post_thumbnail_url($post_id);
              // Выводим информацию о новости
          ?>
              <div class="swiper-slide">
                <a href="/aksii/<?php echo $permalink; ?>" class="max-[680px]:max-w-full group transition-all duration-200 max-w-[400px] h-[500px] flex items-end w-full relative">
                  <img class="object-cover  absolute z-0 w-full h-full left-0 right-0 top-0 bottom-0" src="<?php echo $thumbnail_url; ?>" alt="">

                  <div class="group-hover:bg-[#C32E4499] flex flex-col justify-between transition-all duration-200 bg-[#00000099] z-20 w-full h-[250px] pb-[22px] pt-[67px]">
                    <div class="flex flex-col">
                      <div class="max-w-[130px] flex items-center bg-[#F3F2EA] py-[6px] pl-[30px] pr-[22px] text-black text-base font-bold">
                        Акции
                      </div>
                      <div class="px-[30px] mt-[20px]">
                        <span class="text-dots text-white text-[20px] font-bold leading-[23px]">
                          <?php echo $title ?>
                        </span>
                      </div>
                    </div>
                    <div class=" pl-[30px] flex items-center gap-[10px]">
                      <img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
                      <span class="text-white text-[14px] font-bold">
                        <?php
                        $formatted_date_start = date('d.m.Y', strtotime($date_start));
                        echo $formatted_date_start;
                        ?> - <?php
                        $formatted_date_end = date('d.m.Y', strtotime($date_end));
                        echo $formatted_date_end 
                        ?>
                      </span>
                    </div>
                  </div>
                </a>
              </div>
          <?php
            }
          }
          ?>

<?php
          $pods = pods('skidki', [
            'limit' => 3, // Ограничиваем количество новостей до 8
            'orderby' => 'date DESC', // Сортируем по дате в порядке убывания
          ]);

          if ($pods->total() > 0) {
            while ($pods->fetch()) {
              // Получаем значения полей
              $title = $pods->field('title');
              $content = $pods->field('content');
              $date_start = $pods->field('date-time-start');
              $date_end = $pods->field('date-time-end');

              // Преобразуем название в URL-адрес
              $permalink = sanitize_title($title);

              $post_id = $pods->id();
              $thumbnail_url = get_the_post_thumbnail_url($post_id);
              // Выводим информацию о новости
          ?>
              <div class="swiper-slide">
                <a href="/skidki/<?php echo $permalink; ?>" class="max-[680px]:max-w-full group transition-all duration-200 max-w-[400px] h-[500px] flex items-end w-full relative">
                  <img class="object-cover  absolute z-0 w-full h-full left-0 right-0 top-0 bottom-0" src="<?php echo $thumbnail_url; ?>" alt="">

                  <div class="group-hover:bg-[#C32E4499] flex flex-col justify-between transition-all duration-200 bg-[#00000099] z-20 w-full h-[250px] pb-[22px] pt-[67px]">
                    <div class="flex flex-col ">
                      <div class="max-w-[130px] flex items-center bg-[#F3F2EA] py-[6px] pl-[30px] pr-[22px] text-black text-base font-bold">
                        Скидки
                      </div>
                      <div class="px-[30px] mt-[20px]">
                        <span class="text-dots text-white text-[20px] font-bold leading-[23px]">
                          <?php echo $title ?>
                        </span>
                      </div>

                    </div>
                    <div class="pl-[30px] flex items-center gap-[10px]">
                      <img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
                      <span class="text-white text-[14px] font-bold">
                      <?php
                        $formatted_date_start = date('d.m.Y', strtotime($date_start));
                        echo $formatted_date_start;
                        ?> - <?php
                        $formatted_date_end = date('d.m.Y', strtotime($date_end));
                        echo $formatted_date_end 
                        ?>
                      </span>
                    </div>
                  </div>
                </a>
              </div>
          <?php
            }
          }
          ?>

        </div>
      </div>

      <div class=" max-[768px]:mt-[40px] max-w-[210px] mx-auto mt-[60px] relative z-20">
        <a href="/all" class="block border-[3px] border-white px-[30px] py-[19px] leading-[16px] text-center uppercase text-base font-bold text-white hover:bg-main hover:border-main transition-all duration-200">
          Все Новости
        </a>
      </div>
    </div>
  </section>

  <section class="max-[768px]:hidden bg-[#1C1C1C] mt-[-370px] h-[530px]"></section>

  <section id='about' class="max-[768px]:py-[100px] pt-[205px] pb-[180px] bg-kacheli-photo relative">
    <div class="absolute w-full h-full left-0 right-0 bg-[#111111F2] top-0 bottom-0"></div>
    <div class="l-wrapper">
      <div class="max-[800px]:flex-col  relative z-100 flex gap-[20px] justify-between">

        <div class="w-full max-w-[600px]">
          <div class="max-[800px]:w-full max-[800px]:justify-center max-[800px]:text-center flex gap-[45px] items-center">
            <div class="max-[850px]:hidden w-[35px] h-[35px] bg-white"></div>
            <h2 class="text-[40px] font-bold text-white">
              О НАС
            </h2>
          </div>

          <div class="mt-[40px] hidden max-[800px]:block ">
            <div class="mx-auto w-full max-w-[480px] h-[422px] img-border relative">
              <img class="w-full h-full" src="<?php echo get_template_directory_uri() ?>/assets/img/kacheli-photo.png" alt="kacheli photo">
            </div>
          </div>

          <div class="w-full mt-[60px]">
            <span class=" uppercase max-[768px]:text-base max-[768px]:leading-[24px] max-[800px]:text-center w-full block text-white text-[20px] leading-[150%] font-bold">
              Многофункциональный комплекс «Качели» - первое семейное пространство города Якутска, в котором собраны,
              пожалуй, лучшие магазины и услуги как для детей, так и для взрослых. Более 60-ти предприятий находятся в
              стенах нашего уютного здания в самом сердце прогрессивного 203 микрорайона!
            </span>
          </div>
        </div>

        <div class="max-[800px]:hidden w-[480px] h-[422px] img-border relative">
          <img class="w-full h-full" src="<?php echo get_template_directory_uri() ?>/assets/img/kacheli-photo.png" alt="kacheli photo">
        </div>

      </div>
    </div>
  </section>

  <section id="map" class="max-[768px]:pt-[100px] bg-[#1C1C1C] pt-[160px] pb-[200px]">
    <div class="l-wrapper">
      <div class="w-full flex items-center justify-between">
        <div class="max-[800px]:w-full max-[800px]:justify-center max-[800px]:text-center flex gap-[45px] items-center">
          <div class="max-[850px]:hidden w-[35px] h-[35px] bg-white"></div>
          <h2 class="text-[40px] font-bold text-white">
            СХЕМА МФК
          </h2>
        </div>

        <div class="max-[1350px]:hidden w-full bg-[#2D2D2D] h-[2px] max-w-[700px]"></div>
      </div>

      <div class="mt-[50px]">
        <?php
        echo do_shortcode('[mapplic id="233"]');

        ?>

      </div>
    </div>
  </section>

</main>

<?php

get_footer();

?>