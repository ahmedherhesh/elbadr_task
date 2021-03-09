$(function(){
  var categories = $('#categories');
  var subCategories = $('#sub_categories');
  categories.on('change',function(){
      $.ajax({
        url:"/get-sub-categories",
        method:"get",
        data: {categories:categories.val()},
        success: function(data) {
          if(data !== ''){
            subCategories.show();
            subCategories.html('')
            subCategories.append('<option value="0" selected>sub_categories</option>');
            subCategories.append(data);
          }else{
            subCategories.hide();
          }
        }
      });
  });
  $('#count, #original_price').on('keyup', function(){
      $('#total_original_price').text($('#count').val() * $('#original_price').val());
  });
})

