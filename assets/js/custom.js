 jQuery(function(){
      var j = jQuery.noConflict();    
      j('.srcoll_icon').click(function() {
        var divID = '#scroll_top';
        j('html, body').animate({
        scrollTop: j('.main_banner_area').offset().top
        }, 2000);
      });   
    });
    
    jQuery(document).ready(function () {  
      size_li = jQuery(".myList").size();   
        x=6;    
          jQuery('.myList:lt('+x+')').show("slow", "swing");   
          jQuery('#loadMore').click(function () {    
          x= (x+3 <= size_li) ? x+3 : size_li;    
          jQuery('.myList:lt('+x+')').show("slow", "swing"); 
        if(size_li == x)    {      jQuery("#loadMore").hide();   }   
      });
    });

    function toggleForm() {
       var element = document.getElementById("feedbackside-wrap");
       element.classList.toggle("slideon");
    }
 
      function previewFile(){
       var preview = document.querySelector('.feedimg img'); //selects the query named img
       var file    = document.querySelector('input[type=file]').files[0]; //sames as here
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
       }

       if (file) {
           reader.readAsDataURL(file); //reads the data as a URL
       } else {
           preview.src = "default-avatar.jpg";
       }
  }

  previewFile();  //calls the function named previewFile()
  
    function validateform(){
    var captcha_response = grecaptcha.getResponse();
    if(captcha_response.length == 0)
    {
        // Captcha is not Passed
        return false;
    }
    else
    {
        // Captcha is Passed
        return true;
    }
    }