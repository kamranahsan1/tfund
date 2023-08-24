<?php echo $header; ?><?php echo $column_left; ?>
    <div id="content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right"><a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_insert; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-fund').submit() : false;"><i class="fa fa-trash-o"></i></button>
                </div>
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
			<?php if ($success) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
			<?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-fund">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-left"><?php if ($sort == 'name') { ?>
                                            <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
										<?php } else { ?>
                                            <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
										<?php } ?></td>



                                    <td class="text-left"><?php if ($sort == 'sname') { ?>
                                            <a href="<?php echo $sort_sname; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sname; ?></a>
										<?php } else { ?>
                                            <a href="<?php echo $sort_sname; ?>"><?php echo $column_sname; ?></a>
										<?php } ?></td>
                                    
                                    <td class="text-left"><?php if ($sort == 'charge_type_id') { ?>
                                            <a href="<?php echo $sort_charge_type_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Charge Type'; ?></a>
										<?php } else { ?>
                                            <a href="<?php echo $sort_charge_type_id; ?>"><?php echo 'Charge Type'; ?></a>
										<?php } ?></td>
                                    <td class="text-left"><?php if ($sort == 'charge_amount') { ?>
                                            <a href="<?php echo $sort_charge_amount; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Amount'; ?></a>
		                                <?php } else { ?>
                                            <a href="<?php echo $sort_charge_amount; ?>"><?php echo 'Amount'; ?></a>
		                                <?php } ?></td>
                                    <td class="text-left"><?php if ($sort == 'charge_option_id') { ?>
                                            <a href="<?php echo $sort_charge_option_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Charge Option'; ?></a>
		                                <?php } else { ?>
                                            <a href="<?php echo $sort_charge_option_id; ?>"><?php echo 'Charge Option'; ?></a>
		                                <?php } ?></td>
                                    <td class="text-left"><?php if ($sort == 'penalty') { ?>
                                            <a href="<?php echo $sort_penalty; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Penalty'; ?></a>
		                                <?php } else { ?>
                                            <a href="<?php echo $sort_penalty; ?>"><?php echo 'Penalty'; ?></a>
		                                <?php } ?></td>
                                    <td class="text-left"><?php if ($sort == 'added_date') { ?>
                                            <a href="<?php echo $sort_added_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Date'; ?></a>
		                                <?php } else { ?>
                                            <a href="<?php echo $sort_added_date; ?>"><?php echo 'Date'; ?></a>
		                                <?php } ?></td>
                                    <td class="text-left"><?php if ($sort == 'status') { ?>
                                            <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
										<?php } else { ?>
                                            <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
										<?php } ?></td>
                                    <td class="text-right"><?php echo $column_action; ?></td>

                                </tr>
                                </thead>
                                <tbody>
								<?php if ($charges) { ?>
									<?php foreach ($charges as $charge) { ?>
                                        <tr>
                                            <td class="text-center"><?php if (in_array($charge['charges_id'], $selected)) { ?>
                                                    <input type="checkbox" name="selected[]" value="<?php echo $charge['charges_id']; ?>" checked="checked" />
												<?php } else { ?>
                                                    <input type="checkbox" name="selected[]" value="<?php echo $charge['charges_id']; ?>" />
												<?php } ?></td>
                                            <td class="text-left"><?php echo $charge['name']; ?></td>
                                            <td class="text-left"><?php echo $charge['sname']; ?></td>
                                            <td class="text-left"><?php echo $charge['type_name']; ?></td>
                                            <td class="text-left"><?php echo $charge['charge_amount']; ?></td>
                                            <td class="text-left"><?php echo $charge['option_name']; ?></td>
                                            <td class="text-left"><?php echo $charge['penalty']; ?></td>
                                            <td class="text-left"><?php echo $charge['date_added']; ?></td>
											<?php if($charge['status'] == 1){ ; ?>
                                                <td class="text-left"><?php echo 'Active'; ?></td>
											<?php }else{ ; ?>
                                                <td class="text-left"><?php echo 'Deactive'; ?></td>
											<?php } ; ?>
                                            <td class="text-right"><a href="<?php echo $charge['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                        </tr>
									<?php } ?>
								<?php } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
                                    </tr>
								<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $footer; ?>