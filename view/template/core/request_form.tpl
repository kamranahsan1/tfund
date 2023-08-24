<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-manufacturer" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-manufacturer" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-4">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>

              <label class="col-sm-2 control-label" for="input-name"><?php echo $sentry_name; ?></label>
              <div class="col-sm-4">
                  <input type="text" name="sname" value="<?php echo $sname; ?>" placeholder="<?php echo $sentry_name; ?>" id="input-sname" class="form-control" />
		          <?php if ($error_sname) { ?>
                      <div class="text-danger"><?php echo $error_sname; ?></div>
		          <?php } ?>
              </div>
          </div>

            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_phone; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="Select Phone" id="input-phone" class="form-control phone" />
                </div>
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_email; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Select Email"
                           id="input-email" class="form-control email" />
                </div>
            </div>

            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_address; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Select Address" id="input-address" class="form-control address" />
                </div>
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_country; ?></label>
                <div class="col-sm-4">
                    <select name="country_id"  id="input-country_id" class="form-control country_id" >
                        <option value=""><?php echo '---Select Country---'; ?></option>
			            <?php if ($countries) { ?>
				            <?php foreach ($countries as $country){ ?>
					            <?php if($country['id'] == $country_id){ ?>
                                    <option value="<?php echo $country['id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
					            <?php }else{ ?>
                                    <option value="<?php echo $country['id']; ?>" ><?php echo $country['name']; ?></option>
					            <?php } ?>
				            <?php } ?>
			            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_region; ?></label>
                <div class="col-sm-4">
                    <select name="region_id"  id="input-region_id" class="form-control region_id" >
                        <option value=""><?php echo '---Select Country---'; ?></option>
                        <?php if ($regions) { ?>
                            <?php foreach ($regions as $region){ ?>
                                <?php if($region['region_id'] == $region_id){ ?>
                                    <option value="<?php echo $region['region_id']; ?>" selected="selected"><?php echo $region['name']; ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $region['region_id']; ?>" ><?php echo $region['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_area; ?></label>
                <div class="col-sm-4">
                    <select name="area_id"  id="input-area_id" class="form-control area_id" >
                        <option value=""><?php echo '---Select Area---'; ?></option>
			            <?php if ($areas) { ?>
				            <?php foreach ($areas as $area){ ?>
					            <?php if($area['id'] == $area_id){ ?>
                                    <option value="<?php echo $area['id']; ?>" selected="selected"><?php echo $area['name']; ?></option>
					            <?php }else{ ?>
                                    <option value="<?php echo $area['id']; ?>" ><?php echo $area['name']; ?></option>
					            <?php } ?>
				            <?php } ?>
			            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_currency; ?></label>
                <div class="col-sm-4">
                    <select name="currency_id"  id="input-currency_id" class="form-control currency_id" >
                        <option value=""><?php echo '---Select Currency---'; ?></option>
                        <?php if ($currencies) { ?>
                            <?php foreach ($currencies as $currency){ ?>
                                <?php if($currency['id'] == $currency_id){ ?>
                                    <option value="<?php echo $currency['id']; ?>" selected="selected"><?php echo $currency['name']; ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $currency['id']; ?>" ><?php echo $currency['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_amount; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="amount" value="<?php echo $amount; ?>" placeholder="Select Amount"
                           id="input-amount" class="form-control amount" />
                </div>
            </div>
            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-loan_id"><?php echo $entry_loan_id; ?></label>
                <div class="col-sm-4">
                    <select name="loan_id"  id="input-loan_id" class="form-control loan_id" >
                        <option value=""><?php echo '---Select Loan---'; ?></option>
                        <?php if ($loans) { ?>
                            <?php foreach ($loans as $loan){ ?>
                                <?php if($loan['id'] == $loan_id){ ?>
                                    <option value="<?php echo $loan['id']; ?>" selected="selected"><?php echo $loan['name']; ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $loan['id']; ?>" ><?php echo $loan['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label" for="input-product_id"><?php echo $entry_product_id; ?></label>
                <div class="col-sm-4">
                    <select name="product_id"  id="input-product_id" class="form-control product_id" >
                        <option value=""><?php echo '---Select Product---'; ?></option>
			            <?php if ($loans) { ?>
				            <?php foreach ($products as $product){ ?>
					            <?php if($product['id'] == $product_id){ ?>
                                    <option value="<?php echo $product['id']; ?>" selected="selected"><?php echo $product['name']; ?></option>
					            <?php }else{ ?>
                                    <option value="<?php echo $product['id']; ?>" ><?php echo $product['name']; ?></option>
					            <?php } ?>
				            <?php } ?>
			            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_fdate; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="fdate" value="<?php echo $fdate; ?>" placeholder="Select Date" id="input-fdate" class="form-control fdate" />
                </div>
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_tdate; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="tdate" value="<?php echo $tdate; ?>" placeholder="Select Date"
                           id="input-tdate" class="form-control tdate" />
                </div>
            </div>
            <div class="form-group  ">
                <!--<label class="col-sm-2 control-label" for="input-name"><?php /*echo $entry_doc_status; */?></label>
                <div class="col-sm-4">
                    <input type="text" name="doc_status" value="<?php /*echo $doc_status; */?>" placeholder="Select Doc Status" id="input-doc_status" class="form-control doc_status" />
                </div>-->
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_assign_to; ?></label>
                <div class="col-sm-4">
                    <select name="assign_to"  id="input-assign_to" class="form-control assign_to" >
                        <option value=""><?php echo '---Select User---'; ?></option>
			            <?php if ($users) { ?>
				            <?php foreach ($users as $user){ ?>
					            <?php if($user['user_id'] == $assign_to){ ?>
                                    <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['firstname'].' '.$user['lastname']; ?></option>
					            <?php }else{ ?>
                                    <option value="<?php echo $user['user_id']; ?>" ><?php echo $user['firstname'].' '.$user['lastname']; ?></option>
					            <?php } ?>
				            <?php } ?>
			            <?php } ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label" for="input-remarks"><?php echo $entry_remarks; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="remarks" value="<?php echo $remarks; ?>" placeholder="<?php echo $entry_remarks; ?>" id="input-remarks" class="form-control" />
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_fund_type; ?></label>
                <div class="col-sm-4">
                    <select name="fund_type_id"  id="input-fund_type_id" class="form-control fund_type_id" >
                        <option value=""><?php echo '---Select Funds---'; ?></option>
			            <?php if ($funds) { ?>
				            <?php foreach ($funds as $fund){ ?>
					            <?php if($fund['id'] == $fund_type_id){ ?>
                                    <option value="<?php echo $fund['id']; ?>" selected="selected"><?php echo $fund['name']; ?></option>
					            <?php }else{ ?>
                                    <option value="<?php echo $fund['id']; ?>" ><?php echo $fund['name']; ?></option>
					            <?php } ?>
				            <?php } ?>
			            <?php } ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label" for="input-status">Status</label>
                <div class="col-sm-4">
                    <select name="status" id="input-status" class="form-control">
			            <?php if ($status) { ?>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
			            <?php } else { ?>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <option value="1"><?php echo $text_enabled; ?></option>
			            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-image">Image</label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail" style="width: 100px; height: 100px;">
                        <img src="<?php echo $image; ?>" alt="" title="" 
                             data-placeholder="<?php echo $image; ?>"></a>
                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image">
                </div>
            </div>
            
            
         
        </form>
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
        function getDates() {
            $('.fdate').datetimepicker({
                autoclose: true,
                format: 'DD-MM-YYYY',

            });
            $('.tdate').datetimepicker({
                autoclose: true,
                format: 'DD-MM-YYYY',

            });
        }
        getDates();
    </script>
<?php echo $footer; ?>