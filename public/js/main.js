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
      })
  })
})
