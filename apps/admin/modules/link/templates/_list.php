<div class="helper"><?php echo __('Déplacer les éléments pour les trier.'); ?></div>

<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table cellspacing="0">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
          <?php include_partial('link/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="5">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('link/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody id="sortable">
        <?php foreach ($pager->getResults() as $i => $link): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>" rel="<?php echo $link->getId(); ?>">
            <?php include_partial('link/list_td_batch_actions', array('link' => $link, 'helper' => $helper)) ?>
            <?php include_partial('link/list_td_tabular', array('link' => $link)) ?>
            <?php include_partial('link/list_td_actions', array('link' => $link, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}

$('#sortable').sortable({
	axis: 'y',
	stop: function() {
		var counter = 0;
		var done = 0;

		$('#sf_admin_header').html('<div class="notice"><?php echo __('Mise à jour en cours…'); ?></div>');

		$('#sortable > tr').each(function(i) {
			counter = i+1;

			$('<div>').load('<?php echo url_for('@link_sort'); ?>?id='+$(this).attr('rel')+'&rank='+(i+1), function() {
				if(++done == counter) {
					$('#sf_admin_header').html('<div class="notice"><?php echo __('Mise à jour effectuée'); ?></div>');
				}
			});
		});
	}
});
/* ]]> */
</script>
