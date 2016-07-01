var display = true;
$(function(){
    $("#view_buttion").click(function () 
    {
        if(display)
        {
      	    $(".description").css( 'display', 'none' );
            display = false;
        } else
        {
            $(".description").css( 'display', 'block' );
            display = true;
        }
    });
});
