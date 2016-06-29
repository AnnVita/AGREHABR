$(function(){
   var flip = 0;
    $("#view_buttion").click(function () {
      $(".description").toggle( flip++ % 2 == 0 );
    });
});
