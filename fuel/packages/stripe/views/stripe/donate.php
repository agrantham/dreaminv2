<!--Example View Only-->
<?php echo \Security::js_fetch_token(); ?>

<form action="<?php echo Uri::create('stripe/charge'); ?>" method="post"> 
    <label for="email">Email: </label>
    <input type="email" name="email" placeholder="me@example.com" size="25" class="email"/>
    <label for="email"> *</label>
    <br />
    <label for="amount">Amount:  $</label>
    <input type="text" name="amount" placeholder="100.00" size="10" class="amount"/>

    <br />
    <button id="customButton">NAME OF BUTTON</button>

    

    <br /><br />

    <label for="email">* Used for sending the receipt</label>
</form>

<script src="https://checkout.stripe.com/v2/checkout.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $('#customButton').click(function(){
        
        // Ensure no fields are selected
        $('#customButton').focus();
        // round to prevent floating point math issues
        var raw_amount = $('.amount').val() * 100;
        var amount = raw_amount.toFixed();
        
        var token = function(res){
            var email = $('.email').val();

            $.post('/stripe/charge.json', { 
                token_id: res.id , 
                amount: $('.amount').val() * 100,  //convert to cents
                email: $('.email').val(),
                post_csrf_token: fuel_csrf_token() // Optional CSRF token generation. Change config file to remove check.
                // tempalte: 'path/to/template',   // Emial tempalte can be overwritten using this optional value.
                // subject: 'thank you!',          // Emial subject can be overwitten using this optional value.
                // description: 'new description'  // Emial description can be overwritten using this optional value.
                }, 
                function(data){
                    if(data.email_success == false)
                    {
                        // There was an error sending the email but payment was process correctly
                        alert('Payment was proccessed but there was a problem sending the email. Order ID: ' + data.order_id);
                    }
                    else
                    {
                        // Payment and sending the email where successful 
                        alert('SUCCESS! Order ID: ' + data.order_id); 
                    }
            })
            .error(function(data){
        
                // A 40X error was thrown, deal with it!
                alert('Error: ' + data.responseText); 
            });
        };

        StripeCheckout.open({
            key:         <?php echo '\''.$publishable_key.'\''; ?>,
            address:     true,
            description: $('.email').val,
            amount:      $('.amount').val() * 100, //converts to cents
            name:        'FILL IN NAME HERE',
            panelLabel:  'FILL IN TRANSACTION REASON',
            token:       token
        });
        return false;
    });
</script>