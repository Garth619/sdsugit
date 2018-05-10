
var searchCouponPairs = {
  "Coupon Id": 0,
  "First Name": 1,
  "Last Name": 2,
  "Email":3 ,
  "Agency":4 ,
  "Program Name": 5,
  "Registration Date":6

};
(
  function(){
  $(document).ready(function() {
    $('#container-custom').css({'max-width':'none'});
    $('input[type=radio][name=UsedOrNotUsedCoupon]').change(function() {
       if (this.value == 'notUsedCoupon') {
         $("#couponTableUsed").hide();
        $("#couponContentUsed").html('');
$('#toAndFromDateCoupon').hide();
       }
       else if (this.value == 'usedCoupon') {
         $("#couponTableUnused").hide();
             $("#couponContentUnused").html('');
             $('#toAndFromDateCoupon').show();
       }
   });
   $('.accordionForCYF').click(function() {
     if($(this).children('.plusAccordion').is(':visible')){
       $(this).children('.plusAccordion').hide();
       $(this).children('.minusAccordion').show();
     }
     else{
       $(this).children('.plusAccordion').show();
       $(this).children('.minusAccordion').hide();
     }
   });


  $("#searchCouponField").prop("readonly", true);
    $("#searchCouponTable").change(function () {
        var firstDropVal = $('#searchCouponTable').val();
        if(firstDropVal===""|firstDropVal==null){
          $("#searchCouponField").prop("readonly", true);
        }
        else{
            $("#searchCouponField").prop("readonly", false);
        }
    });

    $(document).on('click', '#exportCouponData',function (e) {
      e.preventDefault();
      $('#dateError').hide();
          var UsedOrNotUsedCoupon=$('input[type=radio][name=UsedOrNotUsedCoupon]:checked').val();
      if(UsedOrNotUsedCoupon=="usedCoupon"&&!validateToAndFromDateCoupon()){
              $('#dateError').show();
      }
      else{

        var form_data = new FormData();
        var option=$('input[name=UsedOrNotUsedCoupon]:checked').val();
        form_data.append('exportCouponData',option);
        form_data.append('to',$('#toDateCoupon').val());
        form_data.append('from',$('#fromDateCoupon').val());
        $.ajax( {
          url: "/../wp-content/themes/sdsu/admin-CYF-Outcomes.php",
          type: "post",
          data: form_data,
          processData: false,
          contentType: false,
          success: function(response) {
            console.log(response.length);
            if(response.length>1){
              if(option==="usedCoupon"){
                $("#couponContentUsed").html(response);
                $("#couponTableUsed").show();
              }
              else{
                $("#couponContentUnused").html(response);
                $("#couponTableUnused").show();
              }
            }
            else{
                  $("#noDataExport").show();
            }

            console.log(response);
          },
          error: function(response) {
            console.log("Error");
          }
        });
      }
    });
    function validateToAndFromDateCoupon() {
      var from= $('#fromDateCoupon').val();
      var to=$('#toDateCoupon').val();
      if(from==""||to==""){
          return false;
      }
      else if(!/^\d{4}-\d{1,2}-\d{1,2}$/.test(from)||!/^\d{4}-\d{1,2}-\d{1,2}$/.test(to)){
        return false;
      }
      else{
        return true;
      }
    }
    $("#downloadCouponDataForm").submit(function(e){
      var UsedOrNotUsedCoupon=$('input[type=radio][name=UsedOrNotUsedCoupon]:checked').val();
       $('#dateError').hide();
        if(UsedOrNotUsedCoupon=="usedCoupon"&&!validateToAndFromDateCoupon()){
          e.preventDefault();
          $('#dateError').show();
        }
        else{
          var from= $('#fromDateCoupon').val();
          var to=$('#toDateCoupon').val();
          $('#to').val(to);
          $('#from').val(from);
          $('input[name=UsedOrNotUsedCouponForm]').val($('input[type=radio][name=UsedOrNotUsedCoupon]:checked').val());

        }

    });

    $("form#data").submit(function(e) {
        $('#errorImport').hide();
      e.preventDefault();
      if($('#file').val()!=""){
        var form_data = new FormData(this);
        console.log(form_data);
        var filecsv = $("#file");

        form_data.append('importCouponData','importCouponData');
        form_data.append('file',filecsv);
        $.ajax( {
          url: "/../wp-content/themes/sdsu/admin-CYF-Outcomes.php",
          type: "POST",
          data:  form_data,
          cache:false,
          processData: false,
          contentType: false,
          success: function(response) {
            $("#file+span").hide();
            $('#errorImport').html(response);
            $('#errorImport').show();
            console.log(response);
          },
          error: function(response) {
              $("#file+span").hide();
            console.log("Error");
          }
        });
      }
      else{
          $("#file+span").show();
            $('#errorImport').hide();
      }

    });

    $( "#searchCouponField" ).keyup(function() {

      var input, filter, table, tr, td, i,searchCouponTable;
      searchCouponTable=document.getElementById("searchCouponTable").value;
      console.log(searchCouponTable);
      input = document.getElementById("searchCouponField").value;
      table = document.getElementById("couponTableWithData");
      tr = table.getElementsByTagName("tr");
      console.log("searchCouponPairs[searchCouponTable]",searchCouponPairs[searchCouponTable]);
      for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[searchCouponPairs[searchCouponTable]];
        if (td) {
          if (td.innerHTML.toLowerCase().indexOf(input.toLowerCase()) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }

    });
    var date_input=$('input[name="date"]');
    		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    		date_input.datepicker({
    			format: 'yyyy-mm-dd',
    			container: container,
    			todayHighlight: true,
    			autoclose: true,
    		});
  });
})();
