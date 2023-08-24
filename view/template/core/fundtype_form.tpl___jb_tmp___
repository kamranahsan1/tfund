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
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_duration; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="duration" value="<?php echo $duration; ?>" placeholder="Enter Duration" id="input-duration" class="form-control duration" />
                </div>
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_duration_type; ?></label>
                <div class="col-sm-4">
                <select name="duration_type" id="input-duration_type" class="form-control duration_type">
		            <?php if ($duration_types) { ?>
                        <option value=""><?php echo '---Select Duration Type---'; ?></option>
                        <?php foreach ($duration_types as $duration_type){ ?>
                            <?php if($duration_type['id'] == $duration_type_id){ ?>
                        <option value="<?php echo $duration_type['id'];?>" selected="selected"><?php echo $duration_type['name']; ?></option>
		            <?php } else { ?>
                        <option value="<?php echo $duration_type['id'];?>"><?php echo $duration_type['name']; ?></option>
		            <?php } ?>
		            <?php } ?>
		            <?php } ?>
                </select>
            </div>
            </div>
            

            <div class="form-group ">
                <label class="col-sm-2 control-label" for="input-remarks"><?php echo $entry_remarks; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="remarks" value="<?php echo $remarks; ?>" placeholder="<?php echo $entry_remarks; ?>" id="input-remarks" class="form-control" />

                </div>
            </div>
          <div class="form-group hidden" >
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Status</label>
                <div class="col-sm-10">
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