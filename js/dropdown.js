var ID_THEME = "#theme";
var ID_TIME = "#time";
var ID_SORT = "#sort";
var lastId = 0;
var postsParams = {
                     theme: "development",
                     time: "week",
                     sortby: "bydate"
                  };
function cleanContentContainer()
{
    $("li.publication").remove();
    lastId = 0;
    engine.init(null, $(".content_container"));
	engine.get();
}
$(function(){
   $(ID_THEME + " " + ".selected_item").click
   (
       function(){
                     $(ID_THEME + " " + ".dropdown_list").slideToggle('fast');      
                 }
   );   
   $(ID_THEME + " " + "ul.dropdown_list li").click
   (
       function()
       {
           var tx = $(this).html();
           var tv = $(this).attr('alt');
           $("#theme .dropdown_list").slideUp('fast');
           $("#theme .selected_item span").html(tx);
           $("#theme .selected_item").html(tv);
           postsParams.theme = $(this).attr('value');
           cleanContentContainer();
       });
   $(ID_TIME + " " + ".selected_item").click
   (
       function(){
                     $(ID_TIME + " " + ".dropdown_list").slideToggle('fast');
                 }
   );
   $(ID_TIME + " " + "ul.dropdown_list li").click
   (
       function()
       {
           var tx = $(this).html();
           var tv = $(this).attr('alt');
           $(ID_TIME + " " + ".dropdown_list").slideUp('fast');
           $(ID_TIME + " " + ".selected_item span").html(tx);
           $(ID_TIME + " " + ".selected_item").html(tv);
           postsParams.time = $(this).attr('value');
           console.log(postsParams.time);
           cleanContentContainer();
       });
   $(ID_SORT + " " + ".selected_item").click
   (
       function(){
                     $(ID_SORT + " " + ".dropdown_list").slideToggle('fast');
                 }
   );
   $(ID_SORT + " " + "ul.dropdown_list li").click
   (
       function()
       {
           var tx = $(this).html();
           var tv = $(this).attr('alt');
           $(ID_SORT + " " + ".dropdown_list").slideUp('fast');
           $(ID_SORT + " " + ".selected_item span").html(tx);
           $(ID_SORT + " " + ".selected_item").html(tv);
           postsParams.sortby = $(this).attr('value');
           cleanContentContainer();
       });
});
