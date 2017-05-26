$(function(){
slideToggleBtn();
});

function slideToggleBtn() {
  $('.toggleBtn ').click(function() {
    $(this).siblings('ul').toggle(1000);
  //  $(this).parent('ul').toggle(1000);
  });
}
