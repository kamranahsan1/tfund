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
            <div class="form-group ">
                <label class="col-sm-2 control-label" for="input-remarks"><?php echo $entry_remarks; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="remarks" value="<?php echo $remarks; ?>" placeholder="<?php echo $entry_remarks; ?>" id="input-remarks" class="form-control" />
                </div>
                <label class="col-sm-2 control-label" for="input-fund_amount"><?php echo 'Fund'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="fund_amount" value="<?php echo $fund_amount; ?>" placeholder="<?php echo 'Fund Amount'; ?>" id="input-fund_amount" class="form-control" />
                </div>
            </div>

            <div class="form-group ">
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
                <label class="col-sm-2 control-label" for="input-decimal_places"><?php echo 'Decimal Places'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="decimal_places" value="<?php echo $decimal_places; ?>" placeholder="<?php echo 'Decimal Places'; ?>" id="input-decimal_places" class="form-control" />
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label" for="input-def_principal"><?php echo 'Default Principle'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="def_principal" value="<?php echo $def_principal; ?>" placeholder="<?php echo 'Default Principle'; ?>" id="input-def_principal" class="form-control" />
                </div>
                <label class="col-sm-2 control-label" for="input-min_principle"><?php echo 'Minimum Principle'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="min_principle" value="<?php echo $min_principle; ?>" placeholder="<?php echo 'Minimum Principle'; ?>" id="input-min_principle" class="form-control" />
                </div>
            </div>

            <div class="form-group ">
                <label class="col-sm-2 control-label" for="input-max_principle"><?php echo 'Maximum Principal'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="max_principle" value="<?php echo $max_principle; ?>" placeholder="<?php echo 'Maximum Principal'; ?>" id="input-max_principle" class="form-control" />
                </div>
                <label class="col-sm-2 control-label" for="input-rep_freq"><?php echo 'Repayment Frequency'; ?></label>
                <div class="col-sm-4">
                    <input type="text" name="rep_freq" value="<?php echo $rep_freq; ?>" placeholder="<?php echo 'Repayment Frequency'; ?>" id="input-rep_freq" class="form-control" />
                </div>
            </div>
            
            
            <section style="border:1px solid lightgray" width="100%" border="0" cellpadding="5" cellspacing="0">
                <h4>Type:</h4>
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-def_interest_rate"><?php echo 'Default Interest Rate'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="def_interest_rate" value="<?php echo $def_interest_rate; ?>" placeholder="<?php echo 'Default Interest Rate'; ?>" id="input-def_interest_rate" class="form-control" />
                    </div>

                    <label class="col-sm-2 control-label" for="input-name"><?php echo 'Minimum Interest Rate'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="min_interest_rate" value="<?php echo $min_interest_rate; ?>" placeholder="<?php echo 'Minimum Interest Rate'; ?>" id="input-min_interest_rate" class="form-control" />
                    </div>
                </div>
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-max_interest_rate"><?php echo 'Maximum Interest Rate'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="max_interest_rate" value="<?php echo $max_interest_rate; ?>" placeholder="<?php echo 'Maximum Interest Rate'; ?>" id="input-max_interest_rate" class="form-control" />
                    </div>

                    <label class="col-sm-2 control-label" for="input-name"><?php echo 'Per: Month/Year'; ?></label>
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
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-grace_pamount"><?php echo 'Grace On Principal Amount'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="grace_pamount" value="<?php echo $grace_pamount; ?>" placeholder="<?php echo 'Grace On Principal Amount'; ?>" id="input-grace_pamount" class="form-control" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-grace_interest_amount"><?php echo 'Grace On Interest Amount'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="grace_interest_amount" value="<?php echo $grace_interest_amount; ?>" placeholder="<?php echo 'Grace On Interest Amount'; ?>" id="input-grace_interest_amount" class="form-control" />
                    </div>
                </div>
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-grace_interest_charges"><?php echo 'Grace On Interest Charged'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="grace_interest_charges" value="<?php echo $grace_interest_charges; ?>" placeholder="<?php echo 'Grace On Interest Charged'; ?>" id="input-grace_interest_charges" class="form-control" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-interest_method"><?php echo 'Interest Methodology:'; ?></label>
                    <div class="col-sm-4">
                        <select name="interest_method_id" id="input-interest_method_id" class="form-control interest_method_id">
			                <?php if ($interest_methods) { ?>
                                <option value=""><?php echo '---Select Interest Methodology---'; ?></option>
				                <?php foreach ($interest_methods as $interest_method){ ?>
					                <?php if($interest_method['method_id'] == $interest_method_id){ ?>
                                        <option value="<?php echo $interest_method['method_id'];?>" selected="selected"><?php echo $interest_method['name']; ?></option>
					                <?php } else { ?>
                                        <option value="<?php echo $interest_method['method_id'];?>"><?php echo $interest_method['name']; ?></option>
					                <?php } ?>
				                <?php } ?>
			                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-amort_method"><?php echo 'Amortization Method:'; ?></label>
                    <div class="col-sm-4">
                        <select name="amort_method_id" id="input-amort_method_id" class="form-control amort_method_id">
			                <?php if ($amortizations) { ?>
                                <option value=""><?php echo '---Select Amortization Method---'; ?></option>
				                <?php foreach ($amortizations as $amortization){ ?>
					                <?php if($amortization['method_id'] == $amort_method_id){ ?>
                                        <option value="<?php echo $amortization['method_id'];?>" selected="selected"><?php echo $amortization['name']; ?></option>
					                <?php } else { ?>
                                        <option value="<?php echo $amortization['method_id'];?>"><?php echo $amortization['name']; ?></option>
					                <?php } ?>
				                <?php } ?>
			                <?php } ?>
                        </select>
                    </div>
                    <label class="col-sm-2 control-label" for="input-loan_processing_id"><?php echo 'Loan Processing Strategy:'; ?></label>
                    <div class="col-sm-4">
                        <select name="loan_processing_id" id="input-loan_processing_id" class="form-control loan_processing_id">
				            <?php if ($loan_processings) { ?>
                                <option value=""><?php echo '---Select Loan Processing Strategy---'; ?></option>
					            <?php foreach ($loan_processings as $loan_processing){ ?>
						            <?php if($loan_processing['strategy_id'] == $loan_processing_id){ ?>
                                        <option value="<?php echo $loan_processing['strategy_id'];?>" selected="selected"><?php echo $loan_processing['name']; ?></option>
						            <?php } else { ?>
                                        <option value="<?php echo $loan_processing['strategy_id'];?>"><?php echo $loan_processing['name']; ?></option>
						            <?php } ?>
					            <?php } ?>
				            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-charges"><?php echo 'Charges'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="charges" value="<?php echo $charges; ?>" placeholder="<?php echo 'Charges'; ?>" id="input-charges" class="form-control" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-credit_check"><?php echo 'Credit Check'; ?></label>
                    <div class="col-sm-4">
                        <input type="checkbox" name="credit_check" value="<?php echo $credit_check; ?>" placeholder="<?php echo 'Credit Check'; ?>" id="input-credit_check" class="form-control" />
                    </div>
                </div>
            </section>
                
            
            <section style="border:1px solid lightgray" width="100%" border="0" cellpadding="5" cellspacing="0">
                <h4>Accounting:</h4>
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-accounting_rule_id"><?php echo 'Accounting Rule:'; ?></label>
                    <div class="col-sm-4">
                        <select name="accounting_rule_id" id="input-accounting_rule_id" class="form-control accounting_rule_id">
			                <?php if ($accounting_rules) { ?>
                                <option value=""><?php echo '---Select Accounting Rule---'; ?></option>
				                <?php foreach ($accounting_rules as $accounting_rule){ ?>
					                <?php if($accounting_rule['rule_id'] == $accounting_rule_id){ ?>
                                        <option value="<?php echo $accounting_rule['rule_id'];?>" selected="selected"><?php echo $accounting_rule['name']; ?></option>
					                <?php } else { ?>
                                        <option value="<?php echo $accounting_rule['rule_id'];?>"><?php echo $accounting_rule['name']; ?></option>
					                <?php } ?>
				                <?php } ?>
			                <?php } ?>
                        </select>
                    </div>
                    
                    <label class="col-sm-2 control-label" for="input-fund_source"><?php echo 'Fund Sources'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="fund_source" value="<?php echo $fund_source; ?>" placeholder="<?php echo 'fund_source'; ?>" id="input-fund_source" class="form-control" />
                    </div>
                </div>


                <div class="form-group  ">
                    <label class="col-sm-2 control-label" for="input-loan_portfolio"><?php echo 'Loan Portfolio'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="loan_portfolio" value="<?php echo $loan_portfolio; ?>" placeholder="Loan Portfolio" id="input-loan_portfolio" class="form-control loan_portfolio" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-overpayment"><?php echo 'Overpayment:'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="overpayment" value="<?php echo $overpayment; ?>" placeholder="Enter Overpayment" id="input-overpayment" class="form-control overpayment" />
                    </div>
                </div>

                <div class="form-group  ">
                    <label class="col-sm-2 control-label" for="input-susp_income"><?php echo 'Suspended Income'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="susp_income" value="<?php echo $susp_income; ?>" placeholder="Loan Portfolio" id="input-susp_income" class="form-control susp_income" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-income_from_interest"><?php echo 'Income From Interest:'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="income_from_interest" value="<?php echo $income_from_interest; ?>" placeholder="Income From Interest" id="input-income_from_interest" class="form-control income_from_interest" />
                    </div>
                </div>

                <div class="form-group  ">
                    <label class="col-sm-2 control-label" for="input-income_from_penalty"><?php echo 'Income From Penalty'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="income_from_penalty" value="<?php echo $income_from_penalty; ?>" placeholder="Loan Penalty" id="input-income_from_penalty" class="form-control income_from_penalty" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-income_from_fess"><?php echo 'Income From Fess:'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="income_from_fess" value="<?php echo $income_from_fess; ?>" placeholder="Income From Fess" id="input-income_from_fess" class="form-control income_from_fess" />
                    </div>
                </div>

                <div class="form-group  ">
                    <label class="col-sm-2 control-label" for="input-income_from_recovery"><?php echo 'Income From Recovery'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="income_from_recovery" value="<?php echo $income_from_recovery; ?>" placeholder="Income From Recovery" id="input-income_from_recovery" class="form-control income_from_recovery" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-loss_off"><?php echo 'Losses Written Off:'; ?></label>
                    <div class="col-sm-4">
                        <input type="text" name="loss_off" value="<?php echo $loss_off; ?>" placeholder="Losses Written Off" id="input-loss_off" class="form-control loss" />
                    </div>
                </div>
                <div class="form-group  ">
                    <label class="col-sm-2 control-label" for="input-interest_off"><?php echo 'Interest Written Off'; ?></label>
                    <div class="col-sm-2">
                        <input type="text" name="interest_off" value="<?php echo $interest_off; ?>" placeholder="Interest Written Off" id="input-interest_off" class="form-control interest_off" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-auto_disburse"><?php echo 'Auto Disburse:'; ?></label>
                    <div class="col-sm-2">
                        <input type="text" name="auto_disburse" value="<?php echo $auto_disburse; ?>" placeholder="Losses Written Off" id="input-auto_disburse" class="form-control auto_disburse" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-status">Status</label>
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