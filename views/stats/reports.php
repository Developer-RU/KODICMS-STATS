<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <h3><?php echo __('Creating_reports'); ?></h3>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row-fluid">

    <div class="span4">
        <div class="widget">
            
            <div class="widget-header">
                <?php echo __('Keep_stats_filter'); ?>
            </div>
            

            <form method="post" accept-charset="utf-8">
                <div class="">
                    <div class="widget-content">
                        	
                        <div class="control-group">
                            <label class="control-label"><?php echo __('Activity_interval_filter_date'); ?></label><hr>
                            <div class="controls">
                                <input type="date_from" name="start_date" value="<?php if(!empty($post['start_date'])) echo $post['start_date']; else echo date('Y-m-d'); ?>" class="datepicker"> - 	
                                <input type="date_to" name="stop_date" value="<?php if(!empty($post['stop_date'])) echo $post['stop_date']; else echo date('Y-m-d'); ?>" class="datepicker">    
                            </div>
                        </div>
                        
                        <br>
                        <div class="control-group">
                            <label class="control-label"><?php echo __('Activity_interval_filter_time'); ?></label><hr>
                            <div class="controls">
                                <input type="text" name="start_time" value="<?php if(!empty($post['start_time'])) echo $post['start_time']; else echo '00:00:00'; ?>" class="timepicker"> - 	
                                <input type="text" name="stop_time" value="<?php if(!empty($post['stop_time'])) echo $post['stop_time']; else echo date("H:i:s"); ?>" class="timepicker">    
                            </div>
                        </div>

                                               <div class="control-group">
                            <hr>
                            <div class="controls">
                                <label class=""><input type="checkbox" name="filter" value="1"> <?php echo __('Activity_interval_filter_users'); ?></label>   
                            </div>
                        </div>


                        <div class="" style="margin-bottom: 0; padding: 10px 0px;">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo __('Keep_stats'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
            
         </div>
    </div>

    <div class="span8">
        <div class="widget">
            <div class="widget-header">
                <?php echo __('Activity_filter'); ?>: 
            </div>
            <div class="widget-content">
                <div id="graph_hourse" class="chart-holder-300" style="height: 330px; padding: 0px; position: relative;"></div>
            </div>
        </div>
    </div>
    
</div>

<div id="reloadStatus">
    <?php if (!empty($hourses)) : ?>
        <pre id="hourses" class="prettyprint linenums" style="display: none;">
                                                                        			Morris.Area({
                                                                        			  element: 'graph_hourse',
                                                                        			  data: [
            <?php foreach ($hourses as $key): ?>
                                                                                                                                                					{x: '<?php echo $key['hour']; ?>', y: <?php echo $key['user']; ?>, w: <?php echo $key['view']; ?>},
            <?php endforeach; ?>
                                                                        			  ],
                                                                        			  xkey: 'x',
                                                                        			  ykeys: ['y', 'w'],
                                                                        			  labels: ['<?php echo __('Users'); ?>', '<?php echo __('Views_count'); ?>']
                                                                        			});
        </pre>
    <?php endif; ?>
    <?php if (!empty($browsers)) : ?>
        <pre id="browsers" class="prettyprint linenums" style="display: none;">
                                                                        			Morris.Donut({
                                                                        			  element: 'graph_browsers',
                                                                        			  data: [
            <?php foreach ($browsers as $key => $value): ?>
                                                                                                                                                					{value: <?php echo $value; ?>, label: '<?php echo $key; ?>'},
            <?php endforeach; ?>
                                                                        			  ],
                                                                        			  //backgroundColor: '#999',
                                                                        			  labelColor: '#666',
                                                                        			  colors: [
                                                                        				'#2f4354',
                                                                        				'#D52626',
                                                                        				'rgb(37, 119, 181)',
                                                                        				'#CCCCCC'
                                                                        			  ],
                                                                        			  formatter: function (x) { return x + "%"}
                                                                        			});
        </pre>
    <?php endif; ?>
</div>

<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.5.1.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.5.1.min.js"></script>

<script type="text/javascript">
    $(function() {
        eval($('#hourses').text());
        eval($('#browsers').text());
        prettyPrint();
    });
</script>