<?php echo $header; ?><?php echo $column_left; ?>


<div class="row">
    <div class="col-lg-6">
        <div class="page1-heading">
            <h2>Settings</h2>
            <p><?php echo date('D, d M,Y'); ?></p>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="page1-rating">
            <div class="page1-rating-img">
                <img src="<?php echo $image; ?>">
            </div>
            <div class="page1-rating-content">
                <h2><?php echo $firstname; ?></h2>
                <p><img src="view/img/star.png">4,75</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="last-slide-item">
            <div class="last-slidedp">
                <img src="view/img/profile.png">
            </div>
            <div class="last-slide-form">
                <div class="last-slide-form-rental">
                    <h2>Rental %</h2>
                    <input type="text" name="rent_per" id="rent_per" placeholder="48%" value="<?php echo $rent_per; ?>">
                </div>
                <div class="last-slide-form-address">
                    <h2>Company Address</h2>
                    <input type="text" name="address" id="address" placeholder="157 Liebig St, Victoria" value="<?php echo $address; ?>">
                </div>
                <div class="last-slide-form-number">
                    <h2>Company Phone Number</h2>
                    <input type="text" name="contact" id="contact" placeholder="123456789" value="<?php echo $contact; ?>">
                </div>
                <div class="last-slide-form-btn">
                    <button  id="button-invoice">Submit</button>
                </div>
            </div>
        </div>
    </div >
</div>


<script type="text/javascript">
    $(document).delegate('#button-invoice', 'click', function() {
        $.ajax({
            url: 'index.php?route=rent/company/updateCompany&token=<?php echo $token; ?>&contact='+$("#contact").val()+'&rent_per='+$("#rent_per").val()+'&address='+$("#address").val(),
            dataType: 'json',
            beforeSend: function() {
                $('#button-invoice').button('loading');
            },
            complete: function() {
                $('#button-invoice').button('reset');
            },
            success: function(json) {
                $('.alert-dismissible').remove();

                if (json['company_id']) {
                    /*$('#invoice').html(json['invoice_no']);*/
                }
            },
        });
    });
</script>

<?php echo $footer; ?>