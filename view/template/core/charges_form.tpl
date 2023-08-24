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
                <label class="col-sm-2 control-label" for="input-name"><?php echo 'Charge Type'; ?></label>
                <div class="col-sm-4">
                    <select name="charge_type_id" id="input-charge_type_id" class="form-control charge_type_id">
			            <?php if ($charges_types) { ?>
                            <option value=""><?php echo '---Select Charge Type---'; ?></option>
				            <?php foreach ($charges_types as $charge){ ?>
					            <?php if($charge['type_id'] == $charge_type_id){ ?>
                                    <option value="<?php echo $charge['type_id'];?>" selected="selected"><?php echo $charge['name']; ?></option>
					            <?php } else { ?>
                                    <option value="<?php echo $charge['type_id'];?>"><?php echo $charge['name']; ?></option>
					            <?php } ?>
				            <?php } ?>
			            <?php } ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label" for="input-charge_amount"><?php echo 'Amount'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="charge_amount" value="<?php echo $charge_amount; ?>" placeholder="Enter Charges Amount" id="input-charge_amount" class="form-control charge_amount" />
                </div>
            </div>
            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo 'Charge Options'; ?></label>
                <div class="col-sm-4">
                    <select name="charge_option_id" id="input-charge_option_id" class="form-control charge_option_id">
				        <?php if ($charge_options) { ?>
                            <option value=""><?php echo '---Select Charge Options---'; ?></option>
					        <?php foreach ($charge_options as $charge_option){ ?>
						        <?php if($charge_option['option_id'] == $charge_option_id){ ?>
                                    <option value="<?php echo $charge_option['option_id'];?>" selected="selected"><?php echo $charge_option['name']; ?></option>
						        <?php } else { ?>
                                    <option value="<?php echo $charge_option['option_id'];?>"><?php echo $charge_option['name']; ?></option>
						        <?php } ?>
					        <?php } ?>
				        <?php } ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label" for="input-currency_id"><?php echo 'Currency:'; ?></label>
                <div class="col-sm-4">
                    <select name="currency_id" id="input-currency_id" class="form-control currency_id">
			            <?php if ($currencies) { ?>
                            <option value=""><?php echo '---Select Currency Type---'; ?></option>
				            <?php foreach ($currencies as $currency){ ?>
					            <?php if($currency['currency_id'] == $currency_id){ ?>
                                    <option value="<?php echo $currency['currency_id'];?>" selected="selected"><?php echo $currency['title']; ?></option>
					            <?php } else { ?>
                                    <option value="<?php echo $currency['currency_id'];?>"><?php echo $currency['title']; ?></option>
					            <?php } ?>
				            <?php } ?>
			            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label" for="input-penalty"><?php echo 'Penalty'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="penalty" value="<?php echo $penalty; ?>" placeholder="<?php echo 'Enter Penalty'; ?>" id="input-penalty" class="form-control" />
                </div>

                <label class="col-sm-2 control-label" for="input-override"><?php echo 'Override'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="override" value="<?php echo $override; ?>" placeholder="<?php echo $override; ?>" id="input-override" class="form-control" />
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label" for="input-remarks"><?php echo $entry_remarks; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="remarks" value="<?php echo $remarks; ?>" placeholder="<?php echo $entry_remarks; ?>" id="input-remarks" class="form-control" />
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
        </form>
      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>