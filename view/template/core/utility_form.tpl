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
                            <label class="col-sm-2 control-label" for="input-sname"><?php echo $entry_sname; ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="sname" value="<?php echo $sname; ?>" placeholder="<?php echo $entry_sname; ?>" id="input-sname" class="form-control" />
		                        <?php if ($error_name) { ?>
                                    <div class="text-danger"><?php echo $error_sname; ?></div>
		                        <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-address"><?php echo $entry_address; ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" />
                                <?php if ($error_address) { ?>
                                    <div class="text-danger"><?php echo $error_address; ?></div>
                                <?php } ?>
                            </div>
                            <label class="col-sm-2 control-label" for="input-sname"><?php echo $entry_email; ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                                <?php if ($error_email) { ?>
                                    <div class="text-danger"><?php echo $error_email; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-sname"><?php echo $entry_phone; ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="<?php echo $entry_phone; ?>" id="input-phone" class="form-control" />
                                <?php if ($error_phone) { ?>
                                    <div class="text-danger"><?php echo $error_phone; ?></div>
                                <?php } ?>
                            </div>
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
                        </div>
                        <section style="border:1px solid lightgray" width="100%" border="0" cellpadding="5" cellspacing="0">
                            <h4>Add Projects:</h4>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_pname; ?></label>
                                <div class="col-sm-4">
                                    <input type="text" name="pname" value="<?php echo $pname; ?>" placeholder="<?php echo $entry_pname; ?>" id="input-pname" class="form-control" />
                                    <?php if ($error_pname) { ?>
                                        <div class="text-danger"><?php echo $error_pname; ?></div>
                                    <?php } ?>
                                </div>
                                <label class="col-sm-2 control-label" for="input-sname"><?php echo $entry_psname; ?></label>
                                <div class="col-sm-4">
                                    <input type="text" name="psname" value="<?php echo $psname; ?>" placeholder="<?php echo $entry_psname; ?>" id="input-psname" class="form-control" />
                                    <?php if ($error_psname) { ?>
                                        <div class="text-danger"><?php echo $error_psname; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sname"><?php echo $entry_pdetail; ?></label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="pdetail" value="<?php echo $pdetail; ?>"  id="input-pdetail" class="form-control" rows="4"><?php echo $pdetail; ?> </textarea>
                                    <?php if ($error_pdetail) { ?>
                                        <div class="text-danger"><?php echo $error_pdetail; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                            <div class="col-sm-2">
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
                            <label class="col-sm-2 control-label" for="input-sname"><?php echo $entry_remarks; ?></label>
                            <div class="col-sm-6">
                                <input type="text" name="remarks" value="<?php echo $remarks; ?>" placeholder="<?php echo $entry_remarks; ?>" id="input-remarks" class="form-control" />
                                <?php if ($error_remarks) { ?>
                                    <div class="text-danger"><?php echo $error_remarks; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php echo $footer; ?>