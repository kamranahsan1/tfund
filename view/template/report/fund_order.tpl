<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo $export; ?>" data-toggle="tooltip" title="<?php echo $button_export; ?>" class="btn btn-success"><i class="fa fa-download"></i></a>
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
                    <select name="filter_project_id" id="input-group" class="form-control">
                        <option value="">--Select Source---</option>
			            <?php foreach ($sources as $source) { ?>
				            <?php if ($source['id'] == $filter_project_id) { ?>
                                <option value="<?php echo $project['id']; ?>" selected="selected"><?php echo $source['name']; ?></option>
				            <?php } else { ?>
                                <option value="<?php echo $source['id']; ?>"><?php echo $source['name']; ?></option>
				            <?php } ?>
			            <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="input-group"><?php echo 'Region'; ?></label>
                    <select name="filter_subfund_id" id="input-group" class="form-control">
                        <option value="">--Select Region---</option>
			            <?php foreach ($regions as $region) { ?>
				            <?php if ($region['region_id'] == $filter_subfund_id) { ?>
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
                <select name="filter_obj_id" id="input-group" class="form-control">
                    <option value="">--Select Type---</option>
                  <?php foreach ($loan_types as $loan_type) { ?>
                  <?php if ($loan_type['id'] == $filter_obj_id) { ?>
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
              <?php if(false){ ?>
            <thead>
              <tr>
                <td class="text-center">No</td>
                <td class="text-center">Narration</td>
                <td class="text-center">Amount</td>
              </tr>
            </thead>

    <?php }else{ ?>
                  <thead>
                  <?php  foreach ($display as $displayArr){ ?>
                  <tr>
                      <td class="text-center" colspan="3"><?php echo $displayArr['company_name']; ?></td>
                  </tr>
                      <tr>
                          <td class="text-center" colspan="3"><?php echo $displayArr['project_name']; ?></td>
                      </tr>
                  <?php } ?>
                  <tr>
                      <td class="text-center">No</td>
                      <td class="text-center">Narration</td>
                      <td class="text-center">Amount</td>

                  </tr>
                  </thead>
             <?php  foreach ($display as $displayArr){ ?>
    <tr>
        <td class="text-right" colspan="3"><?php echo $displayArr['upper_parent'];; ?></td>
        <td class="text-right" hidden><?php echo $displayArr['total'] . ' USD' ?></td>
    </tr>
             <?php foreach ($displayArr['children'] as $child){ ?>
    <tr>
        <td class="text-center" colspan="1"><?php echo  $child['sr_no']; ?></td>
        <td class="text-left"><?php echo  $child['narration']; ?></td>
        <td class="text-right"> <?php echo   $child['total'] .' USD' ; ?> </td>
    </tr>
             <?php } ?>
      <tr>
        <td class="text-center" colspan="2"></td>
        <td class="text-right">SUM <?php echo $displayArr['total'] . ' USD' ?></td>
        </tr>







    <?php } ?>
    <?php } ?>
          </table>
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

    var filter_group = $('select[name=\'filter_fund_id\']').val();
    if (filter_group) {
        url += '&filter_fund_id=' + encodeURIComponent(filter_group);
    }

    var filter_group = $('select[name=\'filter_subfund_id\']').val();
    if (filter_group) {
        url += '&filter_subfund_id=' + encodeURIComponent(filter_group);
    }

    var filter_group = $('select[name=\'filter_obj_id\']').val();
    if (filter_group) {
        url += '&filter_obj_id=' + encodeURIComponent(filter_group);
    }
	
		
	var filter_group = $('select[name=\'filter_project_id\']').val();
	if (filter_group) {
		url += '&filter_project_id=' + encodeURIComponent(filter_group);
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