<?php echo $header; ?><?php echo $column_left; ?>


<div class="row">
    <div class="col-lg-6">
        <div class="page1-heading">
            <h2>Customer (<?php echo $tcustomers; ?>)</h2>
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

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-item">
        <span class="close"><a href="<?php echo $cancel; ?>">x</a></span>
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
                <p>Status</p>
                <select  name="status" class="dropdown">
                    <option value="1" <?php if($status==1){ ?> selected="selected" <?php } ?>>Enabled</option>
                    <option value="2" <?php if($status==2){ ?> selected="selected"<?php } ?>>Disabled</option>
                </select>
                <br>
                <p>Sort Order</p><input type="text" name="sort_order" value="<?php echo $sort_order; ?>"><br>
            </div>

            <button class="modal-btn" type="submit">save</button>
        </form>
    </div>

</div>


<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    modal.style.display = "block";

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
        }
    }
</script>
<?php echo $footer; ?>