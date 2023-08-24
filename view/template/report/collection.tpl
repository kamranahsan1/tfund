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
                                    <label class="control-label"
                                           for="input-date-start"><?php echo $filter_fdate; ?></label>
                                    <div class="input-group date">
                                        <input type="text" name="filter_fdate" value="<?php echo $filter_fdate; ?>"
                                               placeholder="<?php echo $filter_fdate; ?>" data-format="YYYY-MM-DD"
                                               id="input-date-start" class="form-control"/>
                                        <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"
                                           for="input-date-end"><?php echo $filter_tdate; ?></label>
                                    <div class="input-group date">
                                        <input type="text" name="filter_tdate" value="<?php echo $filter_tdate; ?>"
                                               placeholder="<?php echo $filter_tdate; ?>" data-format="YYYY-MM-DD"
                                               id="input-date-end" class="form-control"/>
                                        <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="input-group"><?php echo 'Region'; ?></label>
                                    <select name="filter_region_id" id="input-group" class="form-control">
                                        <option value="">--Select Region---</option>
										<?php foreach ($regions as $region) { ?>
											<?php if ($region['region_id'] == $filter_region_id) { ?>
                                                <option value="<?php echo $region['region_id']; ?>"
                                                        selected="selected"><?php echo $region['name']; ?></option>
											<?php } else { ?>
                                                <option value="<?php echo $region['region_id']; ?>"><?php echo $region['name']; ?></option>
											<?php } ?>
										<?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-group"><?php echo 'Area'; ?></label>
                                    <select name="filter_area_id" id="input-group" class="form-control">
                                        <option value="">--Select Area---</option>
										<?php foreach ($areas as $area) { ?>
											<?php if ($area['area_id'] == $filter_area_id) { ?>
                                                <option value="<?php echo $area['area_id']; ?>"
                                                        selected="selected"><?php echo $area['name']; ?></option>
											<?php } else { ?>
                                                <option value="<?php echo $area['area_id']; ?>"><?php echo $area['name']; ?></option>
											<?php } ?>
										<?php } ?>
                                    </select>
                                    <div class="form-group">
                                        <label class="control-label" for="input-group"><?php echo 'Request'; ?></label>
                                        <select name="filter_request_id" id="input-group" class="form-control">
                                            <option value="">--Select Request---</option>
											<?php foreach ($requests as $request) { ?>
												<?php if ($request['id'] == $filter_request_id) { ?>
                                                    <option value="<?php echo $request['id']; ?>"
                                                            selected="selected"><?php echo $request['name']; ?></option>
												<?php } else { ?>
                                                    <option value="<?php echo $request['id']; ?>"><?php echo $request['name']; ?></option>
												<?php } ?>
											<?php } ?>
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i
                                        class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td class="text-center"><?php echo 'Sr'; ?></td>
                                <td class="text-center"><?php echo $column_request_name; ?></td>
                                <td class="text-center"><?php echo $column_region_name; ?></td>
                                <td class="text-center"><?php echo $column_city_name; ?></td>
                                <td class="text-center"><?php echo $column_loan_approval_date; ?></td>
                                <td class="text-center"><?php echo $column_pdetail; ?></td>
                                <td class="text-center"><?php echo $column_loan_amount; ?></td>
                                <td class="text-center"><?php echo $column_collected_amount; ?></td>
                                <td class="text-center"><?php echo $column_added_date; ?></td>
                                <td class="text-center"><?php echo $column_status; ?></td>
                            </tr>
                            </thead>
                            <tbody>
							<?php if ($collections) { ?>
								<?php $i = 0; ?>
								<?php foreach ($collections as $collection) { ?>
									<?php $i++; ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?> </td>
                                        <td class="text-center"><?php echo $collection['request_name']; ?> </td>
                                        <td class="text-center"><?php echo $collection['region_name']; ?> </td>
                                        <td class="text-center"><?php echo $collection['city_name']; ?> </td>
                                        <td class="text-center"><?php echo $collection['loan_approval_date']; ?> </td>
                                        <td class="text-center"><?php echo $collection['pdetail']; ?> </td>
                                        <td class="text-left"><?php echo number_format($collection['loan_amount'], 2); ?>  </td>
                                        <td class="text-left"><?php echo number_format($collection['collected_amount'], 2); ?>  </td>
                                        <td class="text-right"><?php echo $collection['date_added']; ?>     </td>
                                        <td class="text-right"><?php echo $collection['status']; ?> </td>
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
            $('#button-filter').on('click', function () {
                url = 'index.php?route=report/collection&token=<?php echo $token; ?>';

                var filter_date_start = $('input[name=\'filter_fdate\']').val();
                if (filter_date_start) {
                    url += '&filter_fdate=' + encodeURIComponent(filter_date_start);
                }

                var filter_date_end = $('input[name=\'filter_tdate\']').val();
                if (filter_date_end) {
                    url += '&filter_tdate=' + encodeURIComponent(filter_date_end);
                }

                var filter_group = $('select[name=\'filter_request_id\']').val();
                if (filter_group) {
                    url += '&filter_request_id=' + encodeURIComponent(filter_group);
                }

                var filter_group = $('select[name=\'filter_region_id\']').val();
                if (filter_group) {
                    url += '&filter_region_id=' + encodeURIComponent(filter_group);
                }

                var filter_group = $('select[name=\'filter_area_id\']').val();
                if (filter_group) {
                    url += '&filter_area_id=' + encodeURIComponent(filter_group);
                }


                location = url;
            });
            //--></script>
        <script type="text/javascript"><!--
            $('.date').datetimepicker({
                pickTime: false,
                defaultDate: ''
            });
            //--></script>
    </div>
<?php echo $footer; ?>