jQuery(document).ready(function ($) {
  var add_form = $("#add_feedback");

  // Сброс значений полей
  $("#add_feedback input, #add_feedback textarea").on("blur", function () {
    $("#add_feedback input, #add_feedback textarea").removeClass("error");
    $(".error-name,.error-email,.error-comments,.message-success").remove();
    $("#submit-feedback").val("Отправить");
  });

  // Отправка значений полей
  var options = {
    url: feedback_object.url,
    data: {
      action: "feedback_action",
      nonce: feedback_object.nonce,
    },
    type: "POST",
    dataType: "json",
    beforeSend: function (xhr, formData) {
      // Создаем объект FormData
      var formData = new FormData();
      formData.append("art_name", $("#art_name").val());
      formData.append("art_lastname", $("#art_lastname").val());
      formData.append("art_phone", $("#art_phone").val());
      formData.append("art_textarea", $("#art_textarea").val());
      formData.append("art_anticheck", $("#art_anticheck").val());
      formData.append("art_submitted", $("#art_submitted").val());

      // Получаем файл из input[type="file"]
      var fileInput = $("#art_file")[0];
      var file = fileInput.files[0];
      formData.append("art_file", file);

      // Устанавливаем данные formData в настройки options
      options.data = formData;

      // При отправке формы меняем надпись на кнопке
      $("#submit-feedback").val("Отправляем...");
    },
    processData: false,
    contentType: false,
    success: function (request, xhr, status, error) {
      if (request.success === true) {
        // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
        add_form
          .after('<div class="message-success">' + request.data + "</div>")
          .slideDown();
        $("#submit-feedback").val("Отправить");
        // Перезагрузка страницы через 3 секунды
        setTimeout(function () {
          location.reload();
        }, 2000); // 3000 миллисекунд = 3 секунды
      } else {
        // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
        $.each(request.data, function (key, val) {
          $(".art_" + key).addClass("error");
          $(".art_" + key).before(
            '<span class="error-' + key + '">' + val + "</span>"
          );
        });
        $("#submit-feedback").val("Что-то пошло не так...");
      }
      // При успешной отправке сбрасываем значения полей
      $("#add_feedback")[0].reset();
    },
    error: function (request, status, error) {
      $("#submit-feedback").val("Что-то пошло не так...");
    },
  };
  // Отправка формы
  add_form.ajaxForm(options);
});
