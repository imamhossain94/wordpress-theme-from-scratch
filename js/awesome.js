// javascript functions
// $.noConflict();
jQuery(document).ready(function ($) {
   $(document).on('click', '.open-search a', function (e){
      e.preventDefault();
      // console.log('Hello click!');
      $('.search-form-container').slideToggle(300);
   });
});