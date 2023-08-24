<?php echo $header; ?><?php echo $column_left; ?>


<div class="row">
    <div class="col-lg-6">
        <div class="page1-heading">
            <h2>Driver (<?php echo count($drivers); ?>)</h2>
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
    <div class="col-lg-6">
    <div class="col-lg-3">
        <div class="slide2-seacrh">
            <input type="text" placeholder="Search" name="search" id="search">
            <input type="hidden" name="parent_id" id="parent_id">
            <img style="margin-left: 285px !important; margin-top: -60px !important;" src="view/img/ic_zoom_out_24px.png" id="button-filter">
            <br>
        </div>
    </div>
        <div class="col-lg-3">
        <div class="slide2-activecustomer">
            <input type="text" placeholder="Active Customer">
            <img src="view/img/ic_arrow_drop_down_circle_24px.png">
        </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="customer-btn">
            <a href="<?php echo $insert; ?>"><img src="view/img/ic_person_add_24px.png"> ADD NEW DRIVER</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="slide2-table-main">
            <table class="slide2-table">
                <tr>
                    <th>Driver Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Created at</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($drivers as $customer) { ?>
                <tr>
                    <td><?php echo $customer['fname'].'-'.$customer['lname']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['contact']; ?></td>
                    <td><?php echo $customer['date_added']; ?></td>
                    <td><img src="view/img/on-button.png"></td>
                    <td><a href="<?php echo $customer['edit']; ?>"> <img src="view/img/Group9781.png"></a>
                    <a href="<?php echo $customer['delete']; ?>"> <img src="view/img/Group9783.png"></a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-item">
        <span class="close">&times;</span>
        <div class="modal-heading">
            <img src="view/img/invite.png">
            <h2>Add Customer</h2>
        </div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-manufacturer" class="form-horizontal">
        <div class="modal-form">
            <p>First Name</p><input type="text" name="fname" value="<?php echo $fname; ?>"><br>
            <p>Last Name</p><input type="text" name="lname" value="<?php echo $lname; ?>"><br>
            <p>Email Address</p><input type="text" name="email" value="<?php echo $email; ?>"><br>
            <p>Contact Number</p><input type="text" name="contact" value="<?php echo $contact; ?>"><br>
            <p>Address</p><input type="text" name="address" value="<?php echo $address; ?>"><br>
        </div>

            <button class="modal-btn" type="submit">save</button>
        </form>
    </div>

</div>


<script type="text/javascript">
    $('input[name=\'search\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=rent/driver/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['customer_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'search\']').val(item['label']);
            $('input[name=\'parent_id\']').val(item['value']);
        }
    });


    $('#button-filter').on('click', function() {
        var url = '';
        var filter_search = $('input[name=\'search\']').val();
        if (filter_search !== '') {
            url += '&filter_search=' + encodeURIComponent(filter_search);
        }
        var filter_status = $('input[name=\'pstatus\']').val();
        if (filter_status !== '') {
            url += '&filter_status=' + encodeURIComponent(filter_status);
        }

        location = 'index.php?route=rent/driver&token=<?php echo $token; ?>' + url;
    });
</script>

<?php echo $footer; ?>