<?php

get_header();

?>
<?php
/* Template Name: banner */
?>

<?php
// Получаем данные о текущей новости
$pods = pods('banner', get_queried_object_id());

// Проверяем, есть ли данные
if ($pods->exists()) {
  // Получаем значения полей
  $title = $pods->field('title');
  $content = $pods->field('content');
  $date = $pods->field('date');
  $gallery = $pods->field('gallery');
  $title_mini = $pods->field('type-card');

?>
  <main>
    <!-- news section -->
    <section class="max-[560px]:pt-[20px] pb-[200px] pt-[76px] border border-[#2D2D2D]">
      <div class="l-wrapper">
        <div class="swiper js-swiper-news__detail-page">
          <div class="swiper-wrapper">
            <?php
            foreach ($gallery as $image) {
            ?>
              <div class="swiper-slide">
                <div class="max-[560px]:h-[400px] max-[768px]:p-[20px] w-full h-[600px] p-[40px] relative">
                  <img src="<?php echo $image['guid']; ?>" alt="<?php echo $image['post_title']; ?>" class=" filter brightness-75 object-cover z-[-1] absolute right-0 left-0 top-0 bottom-0 w-full h-full">
                  <div class="flex w-full justify-between">
                    <div class=" flex items-center gap-[10px]">
                      <img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
                      <span class="max-[425px]:text-[10px] text-white text-[14px] font-bold">
                        <?php
                        $formatted_date = date('d.m.Y', strtotime($date));
                        echo $formatted_date;
                        ?>
                      </span>
                    </div>
                    <div class="max-[425px]:text-[10px] py-[6px] px-[21px] text-base font-bold leading-[18px] text-white active-news-link">
                      <?php echo $title_mini ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>


          </div>

          <div class="max-[768px]:hidden js-news-detail__next css-btn__next absolute z-10 right-[40px] top-[50%] swiper-button-next"></div>
          <div class="max-[768px]:hidden js-news-detail__prev css-btn__prev absolute z-10 left-[40px] top-[50%] swiper-button-prev"></div>
        </div>
        <div class="max-[520px]:pb-[20px]  max-[520px]:px-[25px] max-[900px]:px-[50px] px-[100px] pb-[60px] mt-[-11%] bg-[#1C1C1C]">
          <div class="max-[560px]:p-[20px] max-[560px]:px-0 max-[768px]:text-[20px] max-[768px]:leading-[23px] relative z-10 max-w-[720px] mx-auto text-center p-[60px] bg-[#151515] text-[40px] text-[#F3F2EA] leading-[46px] font-bold">
            <?php echo $title ?>
          </div>
          <div class=" max-[425px]:mt-[22px] mt-[60px]">
            <div class="max-[768px]:text-base max-[768px]:leading-[24px] text-[24px] text-[#F3F2EA] font-bold leading-[36px]">
              <?php echo $content ?>
            </div>
          </div>
        </div>

        <div class="mt-[80px] flex justify-between items-center w-full gap-[5px]">
          <?php if (get_previous_post()) : ?>
            <a href="<?php echo get_permalink(get_previous_post()); ?>" class="cursor-pointer w-[200px] border-[3px] border-[#F3F2EA] h-[60px] flex items-center justify-center">
              <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.939341 10.9393C0.353554 11.5251 0.353554 12.4749 0.939341 13.0607L10.4853 22.6066C11.0711 23.1924 12.0208 23.1924 12.6066 22.6066C13.1924 22.0208 13.1924 21.0711 12.6066 20.4853L4.12132 12L12.6066 3.51472C13.1924 2.92893 13.1924 1.97919 12.6066 1.3934C12.0208 0.807611 11.0711 0.807611 10.4853 1.3934L0.939341 10.9393ZM25 10.5L2 10.5V13.5L25 13.5V10.5Z" fill="#F3F2EA" />
              </svg>
            </a>
          <?php else : ?>
            <a href="javascript:void(0)" style="opacity: 0.4; cursor:unset;" class=" cursor-pointer w-[200px] border-[3px] border-[#F3F2EA] h-[60px] flex items-center justify-center">
              <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.939341 10.9393C0.353554 11.5251 0.353554 12.4749 0.939341 13.0607L10.4853 22.6066C11.0711 23.1924 12.0208 23.1924 12.6066 22.6066C13.1924 22.0208 13.1924 21.0711 12.6066 20.4853L4.12132 12L12.6066 3.51472C13.1924 2.92893 13.1924 1.97919 12.6066 1.3934C12.0208 0.807611 11.0711 0.807611 10.4853 1.3934L0.939341 10.9393ZM25 10.5L2 10.5V13.5L25 13.5V10.5Z" fill="#F3F2EA" />
              </svg>
            </a>
          <?php endif; ?>

          <div class="w-full bg-[#2D2D2D] h-[2px] max-w-[600px]"></div>
          <?php if (get_next_post()) : ?>
            <a href="<?php echo get_permalink(get_next_post()); ?>" class="cursor-pointer w-[200px] border-[3px] border-[#F3F2EA] h-[60px] flex items-center justify-center">
              <svg class=" rotate-180" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.939341 10.9393C0.353554 11.5251 0.353554 12.4749 0.939341 13.0607L10.4853 22.6066C11.0711 23.1924 12.0208 23.1924 12.6066 22.6066C13.1924 22.0208 13.1924 21.0711 12.6066 20.4853L4.12132 12L12.6066 3.51472C13.1924 2.92893 13.1924 1.97919 12.6066 1.3934C12.0208 0.807611 11.0711 0.807611 10.4853 1.3934L0.939341 10.9393ZM25 10.5L2 10.5V13.5L25 13.5V10.5Z" fill="#F3F2EA" />
              </svg>
            </a>
          <?php else : ?>
            <a href="javascript:void(0)" style="opacity: 0.4; cursor:unset;" class=" cursor-pointer w-[200px] border-[3px] border-[#F3F2EA] h-[60px] flex items-center justify-center">
              <svg class=" rotate-180" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.939341 10.9393C0.353554 11.5251 0.353554 12.4749 0.939341 13.0607L10.4853 22.6066C11.0711 23.1924 12.0208 23.1924 12.6066 22.6066C13.1924 22.0208 13.1924 21.0711 12.6066 20.4853L4.12132 12L12.6066 3.51472C13.1924 2.92893 13.1924 1.97919 12.6066 1.3934C12.0208 0.807611 11.0711 0.807611 10.4853 1.3934L0.939341 10.9393ZM25 10.5L2 10.5V13.5L25 13.5V10.5Z" fill="#F3F2EA" />
              </svg>
            </a>
          <?php endif; ?>


        </div>
      </div>
    </section>
  </main>
<?php
}

?>

<?php

get_footer();

?>