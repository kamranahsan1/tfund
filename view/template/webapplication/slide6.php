<?php include_once 'header.php';?>


<section class="page1 page2">
	<div class="page1-sidebar">
		<ul>
			<li><a href="http://localhost/webapplication/slide1.php"><img src="img/ic_view_list_24px.png"></a></li>
			<li><a href="http://localhost/webapplication/slide2.php"><img src="img/ic_group_24px.png"></a></li>
			<li><a href="http://localhost/webapplication/slide3.php"><img src="img/Group9810.png"></a></li>
			<li><a href="http://localhost/webapplication/slide4.php"><img src="img/ic_directions_car_24px.png"></a></li>
			<li class="active"><a href="http://localhost/webapplication/slide6.php"><img src="img/ic_pin_drop_24px.png"></a></li>
			<li><a href="http://localhost/webapplication/slide7.php"><img src="img/Group9720.png"></a></li>
		</ul>
	</div>
	<div class="page1-right">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="page1-heading">
						<h2>Locations</h2>
						<p>Mon, 16 Nov’19</p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="page1-rating">
						<div class="page1-rating-img">
							<img src="img/Group30.png">
						</div>
						<div class="page1-rating-content">
							<h2>Azar Nemanli</h2>
							<p><img src="img/star.png">4,75</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="slide2-seacrh">
						<input type="text" placeholder="Search">
						<img src="img/ic_zoom_out_24px.png">
					</div>
					<!-- <div class="slide2-activecustomer">
						<input type="text" placeholder="Active Customer">
						<img src="img/ic_arrow_drop_down_circle_24px.png">
					</div> -->
				</div>
				<div class="col-lg-6">
					<div class="customer-btn">
						<a id="myBtn" href="javascript:;"><img src="img/ic_person_add_24px.png"> ADD NEW LOCATION</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="slide2-table-main">
					<table class="slide2-table slide6-table">
					  <tr>
					    <th>Location</th>
					    <th>Created at</th>
					    <th>Status</th>
					    <th>Action</th>
					  </tr>
					  <tr>
					    <td>Action</td>
					    <td>7/7/2023</td>
					    <td><img src="img/on-button.png"></td>
					    <td><img src="img/Group9781.png"> <img src="img/Group9783.png"></td>
					  </tr>
					  <tr>
					    <td>Action</td>
					    <td>7/7/2023</td>
					    <td><img src="img/on-button.png"></td>
					    <td><img src="img/Group9781.png"> <img src="img/Group9783.png"></td>
					  </tr>
					  <tr>
					    <td>Action</td>
					    <td>7/7/2023</td>
					    <td><img src="img/on-button.png"></td>
					    <td><img src="img/Group9781.png"> <img src="img/Group9783.png"></td>
					  </tr>
					   <tr>
					    <td>Action</td>
					    <td>7/7/2023</td>
					    <td><img src="img/on-button.png"></td>
					    <td><img src="img/Group9781.png"> <img src="img/Group9783.png"></td>
					  </tr>
					   <tr>
					    <td>Action</td>
					    <td>7/7/2023</td>
					    <td><img src="img/on-button.png"></td>
					    <td><img src="img/Group9781.png"> <img src="img/Group9783.png"></td>
					  </tr>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- The Modal -->
<div id="myModal" class="modal modal-location">

  <!-- Modal content -->
  <div class="modal-item">
    <span class="close">&times;</span>
    <div class="modal-heading">
    	<img src="img/ic_edit_location_24px.png">
    	<h2>Add Location</h2>
    </div>
    <div class="modal-form modal-location-form">
    	<input type="text" name="name" placeholder="Location"><br>
    	<button class="modal-btn" type="submit">save</button>
    </div>
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
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<?php include_once 'footer.php';?>
