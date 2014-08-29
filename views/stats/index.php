<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <h3><?php echo __('Activity_graphs'); ?></h3>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row-fluid">
    <div class="span4">					
        <div class="widget">
            <div class="widget-header">
                <?php echo __('Popular_browsers'); ?>
            </div>
            <div class="widget-content">
                <div id="graph_browsers" class="chart-holder-300" style="height: 330px; padding: 0px; position: relative;"></div>
            </div>
        </div>
    </div>

    <div class="span8">
        <div class="widget">
            <div class="widget-header">
                <?php echo __('Hourly_Activity'); ?>
            </div>
            <div class="widget-content">
                <div id="graph_hourse" class="chart-holder-300" style="height: 330px; padding: 0px; position: relative;"></div>
            </div>
        </div>
    </div>

</div>

<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.5.1.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.5.1.min.js"></script>

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
            				'#CCCCCC',
            				'#CC345C',
            				'#8C345C'
            			  ],
            			  formatter: function (x) { return x + "%"}
            			});
        </pre>
    <?php endif; ?>
</div>

<script type="text/javascript">
    $(function() {
        eval($('#hourses').text());
        eval($('#browsers').text());
        prettyPrint();
    });
</script>