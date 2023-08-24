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
            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_request_id; ?></label>
                <div class="col-sm-4">
                <select name="request_id" id="input-request_id" class="form-control request_id">
		            <?php if ($requests) { ?>
                        <option value=""><?php echo '---Select Request---'; ?></option>
                        <?php foreach ($requests as $request){ ?>
                            <?php if($request['id'] == $request_id){ ?>
                        <option value="<?php echo $request['id'];?>" selected="selected"><?php echo $request['name']; ?></option>
		            <?php } else { ?>
                        <option value="<?php echo $request['id'];?>"><?php echo $request['name']; ?></option>
		            <?php } ?>
		            <?php } ?>
		            <?php } ?>
                </select>
            </div>
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_amount; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="amount" value="<?php echo $amount; ?>" placeholder="Enter Amount" id="input-amount" class="form-control amount" />
                </div>
            </div>


            <div class="form-group ">
                <label class="col-sm-2 control-label" for="input-ucode"><?php echo $entry_ucode; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="ucode" value="<?php echo $ucode; ?>" placeholder="<?php echo $entry_ucode; ?>" id="input-ucode" class="form-control" />

                </div>
                <label class="col-sm-2 control-label" for="input-ent_date"><?php echo $entry_ent_date; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="ent_date" value="<?php echo $ent_date; ?>" placeholder="<?php echo $entry_ent_date; ?>" id="input-ent_date" class="form-control ent_date" />

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
    <script type="text/javascript">
        $('.ent_date').datetimepicker({
            autoclose: true,
            format: 'DD-MM-YYYY',

        });
    </script>
<?php echo $footer; ?>