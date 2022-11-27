$(function () {
  "use strict";
  $("[placeholder]")
    .focus(function () {
      $(this).attr("data-text", $(this).attr("palceholder"));
      $(this).attr("placeholder", "");
    })
    .blur(function () {
      $(this).attr("placeholder", $(this).attr("data-text"));
    });
  $(".confirm").click(function () {
    return confirm("Are you sure");
  });
});
