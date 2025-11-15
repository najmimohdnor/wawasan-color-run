$(".menu > ul > li").click(function(e) {
    $(this).siblings().removeClass("active");
    $(this).toggleClass("active");
    $(this).find("ul").slideToggle();
    $(this).siblings().find("ul").slideUp();
    $(this).siblings().find("li").removeClass("active"); 
    toggleSidebarAndDashboardPosition();
});
  
$(".menu-btn").click(function() {
    $(".sidebar").toggleClass("active");
      
    toggleSidebarAndDashboardPosition();
});
  
function toggleSidebarAndDashboardPosition() {
    if ($(".sidebar").hasClass("active")) {
    $(".dashboard").css("left", "88px");
    } else {
    $(".dashboard").css("left", "256px");
    }
}
