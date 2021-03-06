<html>

     <head>

        <title>
        Contact page
        </title>

         <link rel="stylesheet" href="css/bootstrap.min.css"/>
         <link rel="stylesheet" href="css/site.css"/>
         <link rel="stylesheet" href="css/menu-one.css"/>
         <link rel="stylesheet" href="css/menu-two.css"/>

         <script src="js/jquery-2.1.1.min.js"></script>
         <script src="js/bootstrap.js"></script>

         

         <script type="text/javascript">
             $(document).ready(function() {
                 $("#submit_btn").click(function() {

                     var proceed = true;
                     //simple validation at client's end
                     //loop through each field and we simply change border color to red for invalid fields
                     $("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
                         $(this).css('border-color','');
                         if(!$.trim($(this).val())){ //if this field is empty
                             $(this).css('border-color','red'); //change border color to red
                             proceed = false; //set do not proceed flag
                         }
                         //check invalid email
                         var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                         if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                             $(this).css('border-color','red'); //change border color to red
                             proceed = false; //set do not proceed flag
                         }
                     });

                     if(proceed) //everything looks good! proceed...
                     {
                         //get input field values data to be sent to server
                         post_data = {
                             'user_name'		: $('input[name=name]').val(),
                             'user_email'	: $('input[name=email]').val(),
                             'country_code'	: $('input[name=phone1]').val(),
                             'phone_number'	: $('input[name=phone2]').val(),
                             'subject'		: $('select[name=subject]').val(),
                             'msg'			: $('textarea[name=message]').val()
                         };

                         //Ajax post data to server
                         $.post('contact_me.php', post_data, function(response){
                             if(response.type == 'error'){ //load json data from server and output message
                                 output = '<div class="error">'+response.text+'</div>';
                             }else{
                                 output = '<div class="success">'+response.text+'</div>';
                                 //reset values in all input fields
                                 $("#contact_form  input[required=true], #contact_form textarea[required=true]").val('');
                                 $("#contact_form #contact_body").slideUp(); //hide form after success
                             }
                             $("#contact_form #contact_results").hide().html(output).slideDown();
                         }, 'json');
                     }
                 });

                 //reset previously set border colors and hide all message on .keyup()
                 $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() {
                     $(this).css('border-color','');
                     $("#result").slideUp();
                 });
             });
         </script>

    </head>

    <body>
        <div id="page">
            <header>
                <div id="menu" class="navbar navbar-default navbar-fixed-top">
                    <img src="img/book-small.png" class="logo-margin" alt=""/>
                    <div class="click-nav pull-right margine">
                        <ul class="no-js">
                            <li>
                                <a class="clicker"><img src="img/i-1.png" alt="Icon">MENU</a>
                                <ul>
                                    <li><a href="#"><img src="img/i-2.png" alt="Icon">HOME</a></li>
                                    <li><a href="#"><img src="img/i-3.png" alt="Icon">ABOUT</a></li>
                                    <li><a href="#"><img src="img/i-5.png" alt="Icon">HELP</a></li>

                                </ul>
                            </li>
                        </ul>

                    </div>

                </div>
            </header>



                    <div>
                        <form action="" method="post" class="elegant-aero">
                            <h1 class="text-center">Contact Form
                                <span>Please fill all the texts in the fields.</span>
                            </h1>
                            <label>
                                <span>Your Name :</span>
                                <input required="true" id="name" type="text" name="name" placeholder="Your Full Name" />
                            </label>

                            <label>
                                <span>Your Email :</span>
                                <input required="true" id="email" type="email" name="email" placeholder="Valid Email Address" />
                            </label>

                            <label>
                                <span>Message :</span>
                                <textarea id="message" name="message" placeholder="Your Message to Us"></textarea>
                            </label>

                            <label>
                                <span>&nbsp;</span>
                                <input id="submit_btn" type="button" class="button btn" value="Send" />
                            </label>
                        </form>
                    </div>

                </div>


        </div>








    </body>
</html>