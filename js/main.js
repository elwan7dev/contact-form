/*global $ , alert , console */

$(function () {
  "use strict";
  let userError = true,
    emailError = true,
    messageError = true,
    recaptchaError = true;

  // function checkError() {
  //     if (userError || emailError || messageError) {
  //         console.log("form not valid");

  //     } else {
  //         console.log("form is valid")
  //     }
  // }

  // validate username
  $(".username").blur(function () {
    if ($(this).val().length < 4) {
      $(this).css("border", "1px solid #F00"); //red border
      $(this).parent().find(".custom-alert").fadeIn(200);
      $(this).parent().find(".asterisx").fadeIn(100);
      userError = true;

      //    can i style code with other way
      // $(this).css('border', '1px solid #F00').parent().find(".custom-alert").fadeIn(200)
      //         .end().find(".asterisx").fadeIn(100);
      //         userError = true;
    } else {
      $(this).css("border", "1px solid #080");
      $(this).parent().find(".custom-alert").fadeOut(200);
      $(this).parent().find(".asterisx").fadeOut(200);
      userError = false;
    }
  });
  // validate email
  $(".email").blur(function () {
    if ($(this).val().length < 1) {
      $(this).css("border", "1px solid #F00"); //red border
      $(this).parent().find(".custom-alert").fadeIn(200);
      $(this).parent().find(".asterisx").fadeIn(100);
      emailError = true;
    } else {
      $(this).css("border", "1px solid #080");
      $(this).parent().find(".custom-alert").fadeOut(200);
      $(this).parent().find(".asterisx").fadeOut(100);
      emailError = false;
    }
  });
  // validate message
  $(".message").blur(function () {
    if ($(this).val().length < 11) {
      $(this).css("border", "1px solid #F00"); //red border
      $(this).parent().find(".custom-alert").fadeIn(200);
      $(this).parent().find(".asterisx").fadeIn(100);
      messageError = true;
    } else {
      $(this).css("border", "1px solid #080");
      $(this).parent().find(".custom-alert").fadeOut(200);
      $(this).parent().find(".asterisx").fadeOut(100);
      messageError = false;
    }
  });

  // $(".g-recaptcha").blur(function () {
  //   if (recaptchaError) {
  //     // $(this).css("border", "1px solid #F00"); //red border
  //     $(this).parent().find(".custom-alert").fadeIn(200);
  //     recaptchaError = true;
  //   } else {
  //     $(this).css("border", "1px solid #080");
  //     $(this).parent().find(".custom-alert").fadeOut(200);
  //     recaptchaError = false;
  //   }
  // });

  // form submit validation - when submit form 
  $(".contact-form").submit(function (e) {
    if (userError || emailError || messageError) {
      e.preventDefault();
      $(".username, .email , .message").blur();
    }
  });

  // alert auto close
  $("#success-alert").fadeOut(20000);

  
});
