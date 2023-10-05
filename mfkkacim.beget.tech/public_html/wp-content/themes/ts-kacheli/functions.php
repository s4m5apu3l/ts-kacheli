<?php

function kacheli_assets()
{

	wp_enqueue_style('hystmodal', get_template_directory_uri() . '/assets/css/hystmodal.min.css');

	wp_enqueue_style('outputcss', get_template_directory_uri() . '/assets/css/output.css');

	wp_enqueue_style('maincss', get_template_directory_uri() . '/assets/css/main.css');

	wp_enqueue_script('hystmodal', get_template_directory_uri() . '/assets/js/hystmodal.min.js', array(), '20151215', true);

	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array(), '20151215', true);
}

add_action('wp_enqueue_scripts', 'kacheli_assets');

show_admin_bar(false);

add_theme_support('post-thumbnails');

add_theme_support('post-thumbnails', array('news'));

// load more logic
add_action('wp_ajax_load_more_news', 'load_more_news');
add_action('wp_ajax_nopriv_load_more_news', 'load_more_news');

add_action('wp_ajax_load_more_aksii', 'load_more_aksii');
add_action('wp_ajax_nopriv_load_more_aksii', 'load_more_aksii');

add_action('wp_ajax_load_more_skidki', 'load_more_skidki');
add_action('wp_ajax_nopriv_load_more_skidki', 'load_more_skidki');

function load_more_news()
{
	$offset = intval($_POST['offset']);

	$my_posts = get_posts(array(
		'numberposts' => 3,
		'offset' => $offset,
		'category' => 0,
		'orderby' => 'date DESC',
		'order' => 'DESC',
		'post_type' => 'news',
		'suppress_filters' => true,
	));

	global $post;

	foreach ($my_posts as $post) {
		setup_postdata($post);
	?>
		<a href="<?php the_permalink() ?>" class="max-[490px]:h-[270px] max-[525px]:h-[350px] max-[768px]:h-[400px] h-[500px] max-[680px]:max-w-full group transition-all duration-200 flex items-end w-full relative">
			<img class="absolute z-0 w-full h-full left-0 right-0 top-0 bottom-0" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">

			<div style='height:50%' class="flex flex-col max-[490px]:pb-[10px] max-[768px]:h-[50%] max-[768px]:pt-[10px] group-hover:bg-[#C32E4499] transition-all duration-200 bg-[#00000099] z-20 w-full h-[50%] pb-[22px] pt-[67px]">
				<div class="max-[490px]:h-[20px] max-[768px]:pl-[10px] max-[768px]:pr-[13px] max-[425px]:text-[10px] max-[768px]:w-fit max-w-[130px] flex items-center bg-[#F3F2EA] py-[6px] pl-[30px] pr-[22px] text-black text-base font-bold">
					Новости
				</div>
				<div class="max-[490px]:mt-[10px] max-[768px]:px-[10px] px-[30px] mt-[20px]">
					<span class="max-[768px]:text-base max-[490px]:text-[12px] text-dots text-white text-[20px] font-bold leading-[23px]">
						<?php echo the_title() ?>
					</span>
				</div>
				<div class="max-[768px]:pl-[10px] mt-auto pl-[30px] flex items-center gap-[10px]">
					<img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
					<span class="max-[490px]:text-[12px] text-white text-[14px] font-bold">
						<?php
						$date = get_post_meta(get_the_id(), 'date_time', true);
						$formatted_date = date('d.m.Y', strtotime($date));
						echo $formatted_date;
						?>
					</span>
				</div>
			</div>
		</a>
	<?php
	}

	wp_die();
};





function load_more_skidkii()
{
	$offset = intval($_POST['offset']);

	$my_posts = get_posts(array(
		'numberposts' => 10,
		'offset' => $offset,
		'category' => 0,
		'orderby' => 'date DESC',
		'order' => 'DESC',
		'post_type' => 'skidki',
		'suppress_filters' => true,
	));

	global $post;

	foreach ($my_posts as $post) {
		setup_postdata($post);
	?>
		<a href="<?php the_permalink() ?>" class="max-[490px]:h-[270px] max-[525px]:h-[350px] max-[768px]:h-[400px] h-[500px] max-[680px]:max-w-full group transition-all duration-200 flex items-end w-full relative">
			<img class="absolute z-0 w-full h-full left-0 right-0 top-0 bottom-0" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">

			<div style='height:50%' class="flex flex-col max-[490px]:pb-[10px] max-[768px]:h-[50%] max-[768px]:pt-[10px] group-hover:bg-[#C32E4499] transition-all duration-200 bg-[#00000099] z-20 w-full h-[50%] pb-[22px] pt-[67px]">
				<div class="max-[490px]:h-[20px] max-[768px]:pl-[10px] max-[768px]:pr-[13px] max-[425px]:text-[10px] max-[768px]:w-fit max-w-[130px] flex items-center bg-[#F3F2EA] py-[6px] pl-[30px] pr-[22px] text-black text-base font-bold">
					Скидки
				</div>
				<div class="max-[490px]:mt-[10px] max-[768px]:px-[10px] px-[30px] mt-[20px]">
					<span class="max-[768px]:text-base max-[490px]:text-[12px] text-dots text-white text-[20px] font-bold leading-[23px]">
						<?php echo the_title() ?>
					</span>
				</div>
				<div class="max-[768px]:pl-[10px] mt-auto pl-[30px] flex items-center gap-[10px]">
					<img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
					<span class="max-[490px]:text-[12px] text-white text-[14px] font-bold">
						<?php
						$date = get_post_meta(get_the_id(), 'date_time', true);
						$formatted_date = date('d.m.Y', strtotime($date));
						echo $formatted_date;
						?>
					</span>
				</div>
			</div>
		</a>
	<?php
	}

	wp_die();
};

function load_more_aksii()
{
	$offset = intval($_POST['offset']);

	$my_posts = get_posts(array(
		'numberposts' => 10,
		'offset' => $offset,
		'category' => 0,
		'orderby' => 'date DESC',
		'order' => 'DESC',
		'post_type' => 'aksii',
		'suppress_filters' => true,
	));

	global $post;

	foreach ($my_posts as $post) {
		setup_postdata($post);
	?>
		<a href="<?php the_permalink() ?>" class="max-[490px]:h-[270px] max-[525px]:h-[350px] max-[768px]:h-[400px] h-[500px] max-[680px]:max-w-full group transition-all duration-200 flex items-end w-full relative">
			<img class="absolute z-0 w-full h-full left-0 right-0 top-0 bottom-0" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">

			<div style='height:50%' class="flex flex-col max-[490px]:pb-[10px] max-[768px]:h-[50%] max-[768px]:pt-[10px] group-hover:bg-[#C32E4499] transition-all duration-200 bg-[#00000099] z-20 w-full h-[50%] pb-[22px] pt-[67px]">
				<div class="max-[490px]:h-[20px] max-[768px]:pl-[10px] max-[768px]:pr-[13px] max-[425px]:text-[10px] max-[768px]:w-fit max-w-[130px] flex items-center bg-[#F3F2EA] py-[6px] pl-[30px] pr-[22px] text-black text-base font-bold">
					Акции
				</div>
				<div class="max-[490px]:mt-[10px] max-[768px]:px-[10px] px-[30px] mt-[20px]">
					<span class="max-[768px]:text-base max-[490px]:text-[12px] text-dots text-white text-[20px] font-bold leading-[23px]">
						<?php echo the_title() ?>
					</span>
				</div>
				<div class="max-[768px]:pl-[10px] mt-auto pl-[30px] flex items-center gap-[10px]">
					<img class="w-[20px] h-[20px]" src="<?php echo get_template_directory_uri() ?>/assets/img/time.svg" alt="">
					<span class="max-[490px]:text-[12px] text-white text-[14px] font-bold">
						<?php
						$date = get_post_meta(get_the_id(), 'date_time', true);
						$formatted_date = date('d.m.Y', strtotime($date));
						echo $formatted_date;
						?>
					</span>
				</div>
			</div>
		</a>
<?php
	}

	wp_die();
};

add_filter('wpcf7_default_template', 'custom_cf7_template', 10, 2);
function custom_cf7_template($template, $prop)
{
	if ($prop === 'form') {
		$template = '[test-mail]';
	}
	return $template;
}

include('custom-shortcodes.php');

add_action('wp_enqueue_scripts', 'art_feedback_scripts');
/**
 * Подключение файлов скрипта формы обратной связи
 *
 * @see https://wpruse.ru/?p=3224
 */
function art_feedback_scripts()
{

	// Обрабтка полей формы
	wp_enqueue_script('jquery-form');

	// Подключаем файл скрипта
	wp_enqueue_script(
		'feedback',
		get_stylesheet_directory_uri() . '/assets/js/feedback.js',
		array('jquery'),
		1.0,
		true
	);

	// Задаем данные обьекта ajax
	wp_localize_script(
		'feedback',
		'feedback_object',
		array(
			'url'   => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('feedback-nonce'),
		)
	);
}

add_action('wp_ajax_feedback_action', 'ajax_action_callback');
add_action('wp_ajax_nopriv_feedback_action', 'ajax_action_callback');

function ajax_action_callback()
{
	// Массив ошибок
	$err_message = array();

	// Проверяем nonce. Если проверка не прошла, блокируем отправку
	if (!wp_verify_nonce($_POST['nonce'], 'feedback-nonce')) {
		wp_die('Данные отправлены с левого адреса');
	}

	// Проверяем на спам. Если скрытое поле заполнено или снят чекбокс, блокируем отправку
	if (false === $_POST['art_anticheck'] || !empty($_POST['art_submitted'])) {
		wp_die('Пошел нахрен, мальчик!(c)');
	}

	// Проверяем поля имени, фамилии и телефона, если пустые, добавляем сообщения в массив ошибок
	if (empty($_POST['art_name']) || !isset($_POST['art_name'])) {
		$err_message['name'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$art_name = sanitize_text_field($_POST['art_name']);
	}

	if (empty($_POST['art_lastname']) || !isset($_POST['art_lastname'])) {
		$err_message['lastname'] = 'Пожалуйста, введите фамилию.';
	} else {
		$art_lastname = sanitize_text_field($_POST['art_lastname']);
	}

	if (empty($_POST['art_phone']) || !isset($_POST['art_phone'])) {
		$err_message['phone'] = 'Пожалуйста, введите телефон.';
	} else {
		$art_phone = sanitize_text_field($_POST['art_phone']);
	}
	// Проверяем полей сообщения, если пустое, то пишем сообщение в массив ошибок
	if (empty($_POST['art_textarea']) || !isset($_POST['art_textarea'])) {
		$err_message['comments'] = 'Пожалуйста, введите ваше сообщение.';
	} else {
		$art_textarea = sanitize_textarea_field($_POST['art_textarea']);
	}
	// Обработка загрузки файла
	$file_attachment = handleFileUpload();

	// Проверяем массив ошибок, если он не пустой, возвращаем сообщение об ошибках
	if ($err_message) {
		wp_send_json_error($err_message);
	} else {
		// Указываем адресата mfkkacheli@yandex.ru
		$email_to = 'mfkkacheli@yandex.ru';

		// Если адресат не указан, берем данные из настроек сайта
		if (!$email_to) {
			$email_to = get_option('admin_email');
		}

		$art_subject = 'Форма обратной связи'; // Установите тему письма, если нужно

		// Создаем тело электронного письма
		$body = "Имя: $art_name \nФамилия: $art_lastname \n\nТелефон: $art_phone \n\nСообщение: $art_textarea";

		// Отправка письма с файлом
		if ($file_attachment && file_exists($file_attachment)) {
			// Добавляем прикрепленный файл, если он доступен
			$attachments = array($file_attachment);

			// Заголовки для письма
			$headers = array();
			$headers[] = 'From: ' . $art_name . ' <' . $email_to . '>';
			$headers[] = 'Reply-To: ' . $email_to;

			// Отправляем письмо с прикрепленным файлом
			$sent = wp_mail($email_to, $art_subject, $body, $headers, $attachments);

			// Удаляем временный файл после отправки
			unlink($file_attachment);

			if ($sent) {
				// Письмо успешно отправлено
				wp_send_json_success('Сообщение отправлено. В ближайшее время свяжемся с вами.');
			} else {
				// Ошибка при отправке письма
				wp_send_json_error('Сообщение не может быть отправлено. Пожалуйста, попробуйте позже.');
			}
		} else {
			// Отправка письма без прикрепленного файла
			$sent = wp_mail($email_to, $art_subject, $body);

			if ($sent) {
				// Письмо успешно отправлено
				wp_send_json_success('Сообщение отправлено. В ближайшее время свяжемся с вами.');
			} else {
				// Ошибка при отправке письма
				wp_send_json_error('Сообщение не может быть отправлено. Пожалуйста, попробуйте позже.');
			}
		}
	}

	// Завершаем AJAX-запрос
	wp_die();
}

function handleFileUpload() {
	if (isset($_FILES['art_file']) && $_FILES['art_file']['error'] === UPLOAD_ERR_OK) {
		$tmp_name = $_FILES['art_file']['tmp_name'];
		$name = $_FILES['art_file']['name'];

		// Создаем папку для временных файлов, если ее еще нет
		$upload_dir = wp_upload_dir();
		$temp_dir = $upload_dir['basedir'] . '/feedback_temp_files/';

		if (!file_exists($temp_dir)) {
			wp_mkdir_p($temp_dir);
		}

		$destination = $temp_dir . $name;
		// Перемещаем загруженный файл во временную папку
		if (move_uploaded_file($tmp_name, $destination)) {
			return $destination;
		}
	}

	return null;
}


?>