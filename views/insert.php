 <br />
 <h1>Insert A New Client</h1>
 <br />

 <div class="alert alert-success" role="alert"></div>
 
 <form id="insert-client">
<!-- <form id="insertClient" action="--><?//= SITE_ROOT ?><!--/client/store" method="get">-->
     <input type="hidden" id="token" name="token" value="aeb2267d17e8a93624cc5b34b7e238bceecdf2f1" />
     <div class="form-group">
         <label for="first-name">First name * (required)</label>
         <input type="text" class="form-control required-field" id="first-name" name="first_name" placeholder="Your first name..." />
         <div class="feedback" id="feedback-first-name"></div>
     </div>
     <div class="form-group">
         <label for="last-name">Last name * (required)</label>
         <input type="text" class="form-control required-field" id="last-name" name="last_name" placeholder="Your last name..." />
         <div class="feedback" id="feedback-last-name"></div>
     </div>
     <div class="form-group">
         <label for="street">Street/Number * (required)</label>
         <input type="text" class="form-control required-field" id="street" name="street" placeholder="Enter your street..." />
         <div class="feedback" id="feedback-street"></div>
     </div>
     <div class="form-group">
         <label for="postal">Postal code * (required)</label>
         <input type="text" class="form-control required-field" id="postal" name="postal" placeholder="Enter the postal code..." />
         <div class="feedback" id="feedback-postal"></div>
     </div>
     <div class="form-group">
         <label for="city">City * (required)</label>
         <input type="text" class="form-control required-field" id="city" name="city" placeholder="Enter your city..." />
         <div class="feedback" id="feedback-city"></div>
     </div>
     <div class="form-group">
         <label for="country">Country</label>
         <input type="text" class="form-control required-field" id="country" name="country" value="Germany" readonly />
         <div class="feedback" id="feedback-country"></div>
     </div>
     <button type="submit" class="btn btn-primary btn-submit">Insert</button>
 </form>

 <script type="text/javascript">
     $(document).ready(function($) {

         var $body = $("body"),
             $alert = $('.alert'),
             $message = $('#message'),
             $feedback = $('.feedback'),
             $requiredField = $('.required-field'),
             $formInsert = $('#insert-client'),
             $country = $('#country');

         $country.css('cursor', 'not-allowed');
         $alert.html('').removeClass('alert-success alert-danger').hide();
         $message.html('');

         /**
          * Form submit
          */
         $body.on("click", ".btn-submit", function(e) {

             e.preventDefault();
             $feedback.html('');
             $requiredField.css('border-color', '#d9d9d9');
             $alert.html('').removeClass('alert-success alert-danger').hide();

             /**
              * Ajax request after form submit
              */
             call_ajax();
         });

         /**
          * Call ajax function
          */
         function call_ajax(method = "GET", url = "https://interview.performance-technologies.de/api/address", api_adderss = true) {
             $.ajax({

                 type: method,
                 url: url,
                 data: $formInsert.serialize(),
                 dataType: 'json',
                 success: function(response) {
                     console.log('success');

                     if(api_adderss) {
                         call_ajax("POST", "<?= SITE_ROOT ?>/client/store", false)
                     } else {
                         if(response.success == true){
                             $formInsert[0].reset();
                             $alert.html(response.message).addClass("alert-success").show();
                         } else if(response.error !== undefined) {
                             $.each(response.error, function(k, v) {
                                 $('#feedback-'+k.replace('_', '-')).html('* '+v[0]).css('color', '#F90A0A');
                                 $('#'+k.replace('_', '-')).css('border-color', '#F90A0A');
                             });
                         } else {
                             $alert.html(response.message).addClass("alert-danger").show();
                         }

                         setTimeout(function(){
                             $alert.fadeOut();
                         }, 5000);
                     }
                 },
                 error: function(response){
                     console.log('error');

                     if (response.responseJSON !== undefined && response.responseJSON.error) {
                         $.each(response.responseJSON.error, function(k, v) {
                             $('#feedback-'+k.replace('_', '-')).html('* '+v[0]).css('color', '#F90A0A');
                             $('#'+k.replace('_', '-')).css('border-color', '#F90A0A');
                         });
                     } else {
                         $alert.html('Something is wrong.').addClass("alert-danger").show();
                     }
                 }
             });
         }
     });
 </script>