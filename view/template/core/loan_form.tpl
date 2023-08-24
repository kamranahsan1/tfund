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



            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name"><?php echo 'Region'; ?></label>
                <div class="col-sm-4">
                    <select name="region_id"  id="input-region_id" class="form-control region_id" >
                        <option value=""><?php echo '---Select Region---'; ?></option>
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

                <label class="col-sm-2 control-label" for="input-area_id"><?php echo 'City'; ?></label>
                <div class="col-sm-4">
                    <select name="area_id"  id="input-area_id" class="form-control area_id" >
                        <option value=""><?php echo '---Select City/Area---'; ?></option>
				        <?php if ($areas) { ?>
					        <?php foreach ($areas as $area){ ?>
						        <?php if($area['area_id'] == $area_id){ ?>
                                    <option value="<?php echo $area['area_id']; ?>" selected="selected"><?php echo $area['name']; ?></option>
						        <?php }else{ ?>
                                    <option value="<?php echo $area['area_id']; ?>" ><?php echo $area['name']; ?></option>
						        <?php } ?>
					        <?php } ?>
				        <?php } ?>
                    </select>
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
           <!-- <section style="border:1px solid lightgray" width="100%" border="0" cellpadding="5" cellspacing="0">
                <h4>Add Projects:</h4>
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name"><?php /*echo $entry_name; */?></label>
                    <div class="col-sm-4">
                        <input type="text" name="name" value="<?php /*echo $name; */?>" placeholder="<?php /*echo $entry_name; */?>" id="input-name" class="form-control" />
			            <?php /*if ($error_name) { */?>
                            <div class="text-danger"><?php /*echo $error_name; */?></div>
			            <?php /*} */?>
                    </div>

                    <label class="col-sm-2 control-label" for="input-name"><?php /*echo $sentry_name; */?></label>
                    <div class="col-sm-4">
                        <input type="text" name="sname" value="<?php /*echo $sname; */?>" placeholder="<?php /*echo $sentry_name; */?>" id="input-sname" class="form-control" />
			            <?php /*if ($error_sname) { */?>
                            <div class="text-danger"><?php /*echo $error_sname; */?></div>
			            <?php /*} */?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-sname"><?php /*echo $entry_pdetail; */?></label>
                    <div class="col-sm-10">
                        <textarea type="text" name="pdetail" value="<?php /*echo $pdetail; */?>"  id="input-pdetail" class="form-control" rows="4"><?php /*echo $pdetail; */?> </textarea>
                    </div>
                </div>
            </section>-->
            <section style="border:1px solid lightgray" width="100%" border="0" cellpadding="5" cellspacing="0">
                <h4>Terms:</h4>
                <div class="form-group required">
                    <label class="col-sm-1 control-label" for="input-pamount"><?php echo 'Principle Amt'; ?></label>
                    <div class="col-sm-3">
                        <input type="text" name="pamount" value="<?php echo $pamount; ?>" placeholder="<?php echo 'Principle Amount'; ?>" id="input-pamount" class="form-control" />
                    </div>
                    <label class="col-sm-1 control-label" for="input-source_id"><?php echo 'Source'; ?></label>
                    <div class="col-sm-3">
                        <select name="source_id"  id="input-source_id" class="form-control source_id" >
                            <option value=""><?php echo '---Select Source---'; ?></option>
			                <?php if ($sources) { ?>
				                <?php foreach ($sources as $source){ ?>
					                <?php if($source['id'] == $source_id){ ?>
                                        <option value="<?php echo $source['id']; ?>" selected="selected"><?php echo $source['name']; ?></option>
					                <?php }else{ ?>
                                        <option value="<?php echo $source['id']; ?>" ><?php echo $source['name']; ?></option>
					                <?php } ?>
				                <?php } ?>
			                <?php } ?>
                        </select>
                    </div>
                    <label class="col-sm-1 control-label" for="input-loan_type_id"><?php echo 'Loan Type'; ?></label>
                    <div class="col-sm-3">
                        <select name="loan_type_id"  id="input-loan_type_id" class="form-control loan_type_id" >
                            <option value=""><?php echo '---Select Source---'; ?></option>
			                <?php if ($loan_types) { ?>
				                <?php foreach ($loan_types as $loan_type){ ?>
					                <?php if($loan_type['id'] == $loan_type_id){ ?>
                                        <option value="<?php echo $loan_type['id']; ?>" selected="selected"><?php echo $loan_type['name']; ?></option>
					                <?php }else{ ?>
                                        <option value="<?php echo $loan_type['id']; ?>" ><?php echo $loan_type['name']; ?></option>
					                <?php } ?>
				                <?php } ?>
			                <?php } ?>
                        </select>
                    </div>
                </div>



                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-repayment_freq"><?php echo 'Repayment Frequency'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="repayment_freq" value="<?php echo $repayment_freq; ?>" placeholder="<?php echo 'Repayment Frequency'; ?>" id="input-repayment_freq" class="form-control" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-interest_percent"><?php echo 'Interest Rate (% Per month):'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="interest_percent" value="<?php echo $interest_percent; ?>" placeholder="<?php echo 'Interest Rate (% Per month):'; ?>" id="input-interest_percent" class="form-control" />
                    </div>
                </div>


                <div class="form-group  ">
                    <label class="col-sm-2 control-label" for="input-name"><?php echo 'Duration'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="duration" value="<?php echo $duration; ?>" placeholder="Enter Duration" id="input-duration" class="form-control duration" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-name"><?php echo 'Type: Months/Quarterly:'; ?></label>
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
                <div class="form-group  ">
                    <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_fmonth; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="fmonth" value="<?php echo $fmonth; ?>" placeholder="Select Month" id="input-fmonth" class="form-control fmonth" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_tmonth; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="tmonth" value="<?php echo $tmonth; ?>" placeholder="Select Month"
                               id="input-tmonth" class="form-control tmonth" />
                    </div>
                </div>
            </section>


            <section style="border:1px solid lightgray" width="100%" border="0" cellpadding="5" cellspacing="0">
                <h4>Settings:</h4>
            <div class="form-group  ">
                <label class="col-sm-2 control-label" for="input-name"><?php echo 'Loan Officer:'; ?></label>
                <div class="col-sm-4">
                    <select name="user_id" id="input-user_id" class="form-control user_id">
				        <?php if ($users) { ?>
                            <option value=""><?php echo '---Select Duration Type---'; ?></option>
					        <?php foreach ($users as $user){ ?>
						        <?php if($user['user_id'] == $user_id){ ?>
                                    <option value="<?php echo $user['user_id'];?>" selected="selected"><?php echo $user['firstname'].' '.$user['lastname']; ?></option>
						        <?php } else { ?>
                                    <option value="<?php echo $user['user_id'];?>"><?php echo $user['firstname'].' '.$user['lastname']; ?></option>
						        <?php } ?>
					        <?php } ?>
				        <?php } ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label" for="input-loan_purpose"><?php echo 'Loan Purpose'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="loan_purpose" value="<?php echo $loan_purpose; ?>" placeholder="Loan Purpose" id="input-loan_purpose" class="form-control loan_purpose" />
                </div>
            </div>

                <div class="form-group  ">
                    <label class="col-sm-2 control-label" for="input-name"><?php echo 'Expected First Repayment Date:'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="exp_date" value="<?php echo $exp_date; ?>" placeholder="Expected First Repayment Date" id="input-exp_date" class="form-control exp_date" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-charges"><?php echo 'Loan Charges'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="charges" value="<?php echo $charges; ?>" placeholder="Loan Charges" id="input-charges" class="form-control charges" />
                    </div>
                </div>
            </section>
        </form>
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
       
            $('.fmonth').datetimepicker({
                autoclose: true,
                format: 'MM-YYYY',

            });
            $('.tmonth').datetimepicker({
                autoclose: true,
                format: 'MM-YYYY',

            });
            $('.exp_date').datetimepicker({
                autoclose: true,
                format: 'DD-MM-YYYY',

            });
        
    </script>
<?php echo $footer; ?>