$(function(){
/* выбор города */
   $("#theme .selected_item").click
   (
       function(){
                     $("#theme .dropdown_list").slideToggle('fast');
                 }
   );
   $('#theme ul.dropdown_list li').click
   (
       function()
       {
           var tx = $(this).html();
           var tv = $(this).attr('alt');
           $("#theme .dropdown_list").slideUp('fast');
           $("#theme .selected_item span").html(tx);
           $("#theme .selected_item").html(tv);
       });
    $("#time .selected_item").click
   (
       function(){
                     $("#time .dropdown_list").slideToggle('fast');
                 }
   );
   $('#time ul.dropdown_list li').click
   (
       function()
       {
           var tx = $(this).html();
           var tv = $(this).attr('alt');
           $("#time .dropdown_list").slideUp('fast');
           $("#time .selected_item span").html(tx);
           $("#time .selected_item").html(tv);
       });
   $("#sort .selected_item").click
   (
       function(){
                     $("#sort .dropdown_list").slideToggle('fast');
                 }
   );
   $('#sort ul.dropdown_list li').click
   (
       function()
       {
           var tx = $(this).html();
           var tv = $(this).attr('alt');
           $("#sort .dropdown_list").slideUp('fast');
           $("#sort .selected_item span").html(tx);
           $("#sort .selected_item").html(tv);
       });
});
