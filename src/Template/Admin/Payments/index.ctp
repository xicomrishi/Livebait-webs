<section class="content-header">
    <h1><?php echo __("Manage Payments"); ?>
        
    </h1>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?= $this->Html->css('https://use.fontawesome.com/releases/v5.0.6/js/all.js',['defer'=>true]) ?>
<div class="clearfix"></div>
<section class="content-header">
  <?=$this->Form->create('search',['type'=>'get']);?>
      <div class="box-primary well">
        <div class="box-body">
              <div class="col-sm-3">
                <div class="form-group">
                  <?=$this->Form->input('date_from',['class'=>'form-control date','id'=>'from','value'=>@$search['date_from']]);?>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <?=$this->Form->input('date_to',['class'=>'form-control date','id'=>'to','value'=>@$search['date_to']]);?>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group" style="margin-top:20px;">
                 <button type="submit" class="btn btn-primary">Search</button><?=$this->Html->link('Reset',['action'=>'index'],['class'=>'btn btn-default']);?>
                </div>
              </div>
        </div>
        <div class="search-footer">
            <label></label>
            <label></label>
        </div>
      </div>
  <?=$this->Form->end();?>
  <div class="rightside" style="float:right;padding:20px 70px;">
  <?php $this->Html->link($this->Html->image('if_19_1555772.png',['alt'=>'Download']),['controller'=>'reports','action'=>'requestexport.csv'],['escape'=>false]) ?>
  </div>
</section> 

<div class="users index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col"><?= __("#") ?></th>
                <th scope="col"><?= __("User") ?></th>
                <th scope="col"><?= __("Plan") ?></th>
                <th scope="col"><?= __("Device") ?></th>
                <th scope="col"><?= __("Amount") ?></th>
                <th scope="col"><?= __("Date") ?></th>
                
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)) { ?>
                    <?php $i = $this->Paginator->counter("{{start}}"); foreach ($results as $result):
                    //print "<pre>";print_r($ReportSpams);exit;
                    ?>
                        <tr>
                            <td><?= h(@$i++) ?></td>
                            <td><?= h(@$result["user"]['name']) ?></td>
                            <td><?= h(@$result["plan"]['name']) ?></td>
                            <td><?=  $result['device'] == "A" ? "Android" : "IOS"  ?></td>                           
                            <td>$<?= $result["amount"] ?></td>
                            <td><?= $result["modified"]->format('M d, Y') ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr><td colspan="8">No record found.</td></tr>

                <?php } ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<script>
  $( function() {
    $( ".date" ).datepicker({dateFormat: 'M d, yy',maxDate:'0'});
  
    var dateFormat = "M d, yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate(dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>