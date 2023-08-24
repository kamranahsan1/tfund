<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-bar-chart"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
          <div class="well">
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="control-label" for="input-date-start"><?php echo $filter_fdate; ?></label>
                          <div class="input-group date">
                              <input type="text" name="filter_fdate" value="<?php echo $filter_fdate; ?>" placeholder="<?php echo $filter_fdate; ?>" data-format="YYYY-MM-DD" id="input-date-start" class="form-control" />
                              <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="input-date-end"><?php echo $filter_tdate; ?></label>
                          <div class="input-group date">
                              <input type="text" name="filter_tdate" value="<?php echo $filter_tdate; ?>" placeholder="<?php echo $filter_tdate; ?>" data-format="YYYY-MM-DD" id="input-date-end" class="form-control" />
                              <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="control-label" for="input-group"><?php echo 'Source'; ?></label>
                          <select name="filter_source_id" id="input-group" class="form-control">
                              <option value="">--Select Source---</option>
						      <?php foreach ($sources as $source) { ?>
							      <?php if ($source['id'] == $filter_source_id) { ?>
                                      <option value="<?php echo $project['id']; ?>" selected="selected"><?php echo $source['name']; ?></option>
							      <?php } else { ?>
                                      <option value="<?php echo $source['id']; ?>"><?php echo $source['name']; ?></option>
							      <?php } ?>
						      <?php } ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="input-group"><?php echo 'Region'; ?></label>
                          <select name="filter_region_id" id="input-group" class="form-control">
                              <option value="">--Select Region---</option>
						      <?php foreach ($regions as $region) { ?>
							      <?php if ($region['region_id'] == $filter_region_id) { ?>
                                      <option value="<?php echo $region['region_id']; ?>" selected="selected"><?php echo $region['name']; ?></option>
							      <?php } else { ?>
                                      <option value="<?php echo $region['region_id']; ?>"><?php echo $region['name']; ?></option>
							      <?php } ?>
						      <?php } ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="control-label" for="input-group"><?php echo 'Loan Type'; ?></label>
                          <select name="filter_type_id" id="input-group" class="form-control">
                              <option value="">--Select Type---</option>
						      <?php foreach ($loan_types as $loan_type) { ?>
							      <?php if ($loan_type['id'] == $filter_type_id) { ?>
                                      <option value="<?php echo $loan_type['id']; ?>" selected="selected"><?php echo $loan_type['name']; ?></option>
							      <?php } else { ?>
                                      <option value="<?php echo $loan_type['id']; ?>"><?php echo $loan_type['name']; ?></option>
							      <?php } ?>
						      <?php } ?>
                          </select>
                      </div>
                      <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                  </div>
              </div>
          </div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td class="text-center"><?php echo 'Sr'; ?></td>
                <td class="text-center"><?php echo $column_added_date; ?></td>
                <td class="text-center"><?php echo $column_fund_name; ?></td>
                <td class="text-center"><?php echo $column_fund_amount; ?></td>
                <td class="text-center"><?php echo $column_subfund_name; ?></td>
                <td class="text-center"><?php echo $column_subfund_amount; ?></td>
                <td class="text-center"><?php echo $column_obj; ?></td>
                <td class="text-center"><?php echo $column_project; ?></td>
                <td class="text-center"><?php echo $column_ftype_amount; ?></td>
                <td class="text-center"><?php echo $column_ftype_tax_rate; ?></td>
                <td class="text-center"><?php echo $column_ftype_tax_amount; ?></td>
                <td class="text-center"><?php echo $column_ftype_total; ?></td>
                <td class="text-center"><?php echo $column_stype_amount; ?></td>
                <td class="text-center"><?php echo $column_stype_tax_rate; ?></td>
                <td class="text-center"><?php echo $column_stype_tax_amount; ?></td>
                <td class="text-center"><?php echo $column_stype_total; ?></td>
                <td class="text-center"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php if ($loans) { ?>
	              <?php $i=0 ; ?>
              <?php foreach ($loans as $loan) { ?>
		              <?php $i++ ; ?>
              <tr>
                <td class="text-center"><?php  echo $i;?> </td>
                <td class="text-center"><?php  echo $loan['pdetail'];?> </td>
                <td class="text-left"><?php  echo number_format($loan['pamount'],2); ?>  </td>
                <td class="text-right"><?php echo $loan['fmonth']; ?>    </td>
                <td class="text-left"><?php echo $loan['tmonth']; ?>  </td>
                <td class="text-right"><?php echo number_format($loan['fund_amount'],2); ?>       </td>
                <td class="text-left"><?php echo $loan['repayment_freq']; ?>     </td>
                <td class="text-left"><?php  echo $loan['interest_percent'];?> </td>
                <td class="text-left"><?php  echo $loan['duration'];?> </td>
                <td class="text-left"><?php  echo $loan['region_name'];?> </td>
                <td class="text-left"><?php  echo $loan['source_name'];?> </td>
                <td class="text-left"><?php  echo $loan['fund_type_name'];?> </td>
               <!-- <td class="text-right"><?php /* echo $loan['fund_released_amount']; */?>  </td>-->
                <td class="text-right"><?php echo number_format($loan['charges'],2); ?>    </td>
                <td class="text-right"><?php echo $loan['date_added']; ?>  </td>
                <td class="text-right"><?php echo $loan['exp_date']; ?>       </td>
                <td class="text-right"><?php echo $loan['loan_purpose']; ?>     </td>
                <td class="text-right"><?php  echo $loan['status'];?> </td>
              </tr>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=report/sale_order&token=<?php echo $token; ?>';
	
	var filter_date_start = $('input[name=\'filter_fdate\']').val();
	if (filter_date_start) {
		url += '&filter_fdate=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_tdate\']').val();
	if (filter_date_end) {
		url += '&filter_tdate=' + encodeURIComponent(filter_date_end);
	}

    var filter_group = $('select[name=\'filter_source_id\']').val();
    if (filter_group) {
        url += '&filter_source_id=' + encodeURIComponent(filter_group);
    }

    var filter_group = $('select[name=\'filter_region_id\']').val();
    if (filter_group) {
        url += '&filter_region_id=' + encodeURIComponent(filter_group);
    }

    var filter_group = $('select[name=\'filter_type_id\']').val();
    if (filter_group) {
        url += '&filter_type_id=' + encodeURIComponent(filter_group);
    }
    
 
	location = url;
});
//--></script> 
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>
<?php echo $footer; ?>