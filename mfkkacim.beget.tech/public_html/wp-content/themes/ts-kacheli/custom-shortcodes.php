<?php add_shortcode( 'form_feedback', 'custom_art_feedback' );
/**
 * Шорткод вывода формы
 *
 * @return string
 * @see https://wpruse.ru/?p=3224
 */
function custom_art_feedback() {

	ob_start();
	?>
        <form id="add_feedback">
          <div class="max-[1100px]:flex-col flex items-center gap-[20px] ">
            <div class="flex flex-col gap-[10px] w-full">
              <span class="text-[20px] text-white ml-[20px] font-bold">
                Имя
              </span>
              <input required type="text" name="art_name" id="art_name" value=""  class="art_name w-full px-[20px] py-[17px] placeholder:text-[#C7C7C7] text-black text-[14px] font-bold" placeholder="Введите имя">
            </div>

            <div class="flex flex-col gap-[10px] w-full">
              <span class="text-[20px] text-white ml-[20px] font-bold">
                Фамилия
              </span>
              <input required type="text" name="art_lastname" id="art_lastname" value="" class="art_lastname w-full px-[20px] py-[17px] placeholder:text-[#C7C7C7] text-black text-[14px] font-bold" placeholder="Введите фамилию">
            </div>

            <div class="flex flex-col gap-[10px] w-full">
              <span class="text-[20px] text-white ml-[20px] font-bold">
                Контактный телефон
              </span>
              <input required type="tel" name="art_phone" id="art_phone" value="" class=" art_phone w-full px-[20px] py-[17px] placeholder:text-[#C7C7C7] text-black text-[14px] font-bold" placeholder="Введите номер телефона">
            </div>
          </div>

          <div class="mt-[20px] ">
            <div class="flex flex-col gap-[10px] w-full">
              <span class="text-[20px] text-white ml-[20px] font-bold">
                Комментарий
              </span>
              <textarea required name="art_textarea" id="art_textarea"  cols="30" rows="6" class="art_textarea max-h-[150px] h-full px-[20px] py-[17px] w-full placeholder:text-[#C7C7C7] text-black text-[14px] font-bold" placeholder="Введите текст запроса Вашей заявки"></textarea>
            </div>
          </div>

          <div class="max-[950px]:flex-col mt-[40px] w-full flex justify-between gap-[20px]">

            <div class="max-[800px]:items-start max-[800px]:flex-col flex items-center gap-[30px]">
              <div class="flex">
                <input hidden name="art_file" id="art_file"  placeholder="Прикрепите файл" type="file">
                <label class="border-dashed border-[3px] border-[#303030] cursor-pointer" for="art_file">
                  <div class="max-[560px]:px-[20px] max-w-[306px] w-full flex items-center gap-[10px] py-[14px] px-[40px]">
                    <div class="min-w-[30px] ">
                      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.42371 27.4375C7.00195 27.4379 5.61201 27.0166 4.42978 26.2268C3.24754 25.4371 2.32614 24.3144 1.78216 23.0008C1.23818 21.6872 1.09607 20.2418 1.37381 18.8474C1.65156 17.453 2.33667 16.1724 3.34246 15.1675L13.9487 4.56C14.1246 4.38412 14.3631 4.28532 14.6118 4.28532C14.8606 4.28532 15.0991 4.38412 15.275 4.56C15.4508 4.73587 15.5496 4.9744 15.5496 5.22312C15.5496 5.47184 15.4508 5.71037 15.275 5.88625L4.66746 16.4925C4.15392 16.9812 3.74339 17.5677 3.46005 18.2176C3.1767 18.8674 3.02628 19.5673 3.01765 20.2762C3.00901 20.9851 3.14234 21.6885 3.40977 22.345C3.6772 23.0015 4.07333 23.5979 4.57481 24.099C5.0763 24.6 5.67299 24.9957 6.32975 25.2626C6.9865 25.5294 7.69003 25.6622 8.39888 25.653C9.10773 25.6437 9.80756 25.4927 10.4572 25.2088C11.1067 24.925 11.6929 24.5139 12.1812 24L25.8812 10.3C26.509 9.6517 26.8568 8.7826 26.8496 7.88018C26.8423 6.97776 26.4806 6.11435 25.8425 5.47622C25.2044 4.8381 24.341 4.47639 23.4385 4.46915C22.5361 4.4619 21.667 4.8097 21.0187 5.4375L9.97121 16.4925C9.8261 16.6376 9.71099 16.8099 9.63246 16.9995C9.55393 17.1891 9.51351 17.3923 9.51351 17.5975C9.51351 17.8027 9.55393 18.0059 9.63246 18.1955C9.71099 18.3851 9.8261 18.5574 9.97121 18.7025C10.1163 18.8476 10.2886 18.9627 10.4782 19.0412C10.6678 19.1198 10.871 19.1602 11.0762 19.1602C11.2814 19.1602 11.4846 19.1198 11.6742 19.0412C11.8638 18.9627 12.0361 18.8476 12.1812 18.7025L19.25 11.6325C19.3364 11.5429 19.4398 11.4714 19.5542 11.4223C19.6685 11.3731 19.7915 11.3472 19.916 11.346C20.0405 11.3449 20.164 11.3685 20.2792 11.4156C20.3944 11.4627 20.4991 11.5323 20.5872 11.6202C20.6753 11.7082 20.7449 11.8129 20.7921 11.9281C20.8393 12.0433 20.8631 12.1667 20.8621 12.2912C20.861 12.4157 20.8352 12.5387 20.7862 12.6531C20.7371 12.7675 20.6657 12.871 20.5762 12.9575L13.5062 20.0287C13.187 20.348 12.8081 20.6013 12.391 20.7741C11.9739 20.9469 11.5269 21.0359 11.0754 21.036C10.6239 21.036 10.1769 20.9472 9.75976 20.7745C9.34264 20.6017 8.96361 20.3486 8.64434 20.0294C8.32506 19.7102 8.07178 19.3312 7.89896 18.9141C7.72614 18.4971 7.63716 18.05 7.6371 17.5986C7.63698 16.6868 7.99907 15.8123 8.64371 15.1675L19.6937 4.125C20.6899 3.12861 22.0412 2.56878 23.4501 2.56866C24.8591 2.56855 26.2105 3.12815 27.2068 4.12437C28.2032 5.12059 28.7631 6.47182 28.7632 7.8808C28.7633 9.28979 28.2037 10.6411 27.2075 11.6375L13.5075 25.3325C12.8413 26.002 12.049 26.5328 11.1764 26.8941C10.3038 27.2554 9.36817 27.4401 8.42371 27.4375Z" fill="#F3F2EA" />
                      </svg>
                    </div>
                    <span class="file-name truncate text-center text-stone-100 text-base font-bold uppercase">
                      Прикрепите файл
                    </span>
                  </div>
                </label>
              </div>

              <span class="text-[#303030] text-[14px] font-bold leading-[16px]">Нажмите или перетащите
                <br>
                файл в эту область
              </span>
            </div>
            <input type="checkbox" name="art_anticheck" id="art_anticheck" class="art_anticheck" style="display: none !important;" value="true" checked="checked"/>
            <input type="text" name="art_submitted" id="art_submitted" value="" style="display: none !important;"/>

            <input type="submit" id="submit-feedback"  class="h-fit border-[3px] border-white px-[30px] py-[19px] leading-[16px] text-center uppercase text-base font-bold text-white hover:bg-main hover:border-main transition-all duration-200">

          </div>
        </form> 
	<?php

	return ob_get_clean();
}

?>