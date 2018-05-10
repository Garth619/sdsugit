(function(){
  var formModal;
  var comfirmationPage="Thank you for Registration!";
  $(document).ready(function() {
    $('body').css({'font-family': 'Open Sans,sans-serif'});
    formModal = $('#myModal .modal-body').html();
    $(document).on('click','#closeMyModal',changeModal);

    function changeModal(){
      $('#myModal .modal-body').html(formModal);
    }

    $(".required").blur(function () {
      length = $(this).val().trim().length;
      if(length==0)
      $(this).next('span').show();
      else {
        $(this).next('span').hide();
      }
    });

    $('.requiredDropDown').change(function () {
      if(  $(this).val()!="" ){
        $(this).next('span').hide();
      }
      else{
        $(this).next('span').show();
      }
    });

    $('.requiredDropDown').on("focus blur",function () {
      if(  $(this).val()=="" ){
        $(this).next('span').show();
      }
    });

    $("#email").blur(function () {
      $("#email").next('span').hide();
      $(".invalidEmail").hide();
      validateEmail();
    });

    function validateEmail() {
      var emailRegex = new RegExp(/^[._%+-A-Za-z0-9]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/);
      var userEmail =$("#email").val().toLowerCase();
      if (!emailRegex.test(userEmail)&userEmail.trim().length!=0) {
        $(".invalidEmail").show();
        return false;
      }
      else if(userEmail.trim().length==0){
        $("#email+span").show();
        $(".invalidEmail").hide();
        return false;
      }
      else if(emailRegex.test(userEmail)){
        $(".invalidEmail").hide();
        $("#email").next('span').hide();
        return true;
      }
    }

    function clearErrors() {
      $(".required+span,.requiredDropDown+span").css("display","none");
      $(".invalidEmail").hide();
    }

    $('#myModal').on('hidden.bs.modal', function () {
      $('#reset').trigger("click");
    });

    $('#reset').click(function () {
      $(".required+span,.requiredDropDown+span").css("display","none");
    });

    $("#getting-started button").click(function () {
      $('#reset').trigger("click");
    });

    $(document).on('click', '#submit',function (e) {
      clearErrors();
      if($("#fname").val().trim()==""){
        $("#fname+span").show();
        return false;
      }
      else if($("#lname").val().trim()==""){
        $("#lname+span").show();
        return false;
      }
      else if($("#agency").val().trim()==""){
        $("#agency+span").show();
        return false;
      }
      else if($("#program").val().trim()==""){
        $("#program+span").show();
        return false;
      }
      else if($("#email").val().trim()==""){
        $("#email+span").show();
        return false;
      }
      else if(!validateEmail() ){
        console.log("enter");
        return false;
      }
      e.preventDefault();

      var fname = $("#fname").val();
      var lname = $("#lname").val();
      var agency = $("#agency").val();
      var program = $("#program").val();
      var email = $('#email').val();
      var form_data = new FormData();
      form_data.append('fname',fname);
      form_data.append('lname',lname);
      form_data.append('agency',agency);
      form_data.append('program',program);
      form_data.append('email',email);
      console.log(form_data);
      for (var pair of form_data.entries()) {
  console.log(pair[0]+ ', ' + pair[1]);
}
      $.ajax( {
        url: "/../wp-content/themes/sdsu/CYF-Outcomes-Registration.php",
        type: "post",
        data: form_data,
        processData: false,
        contentType: false,
        success: function(response) {
          $('#myModal .modal-body').html(response);
          console.log(response);
        },
        error: function(response) {
          console.log("Error");
        }
      });
    });
  });
})();
