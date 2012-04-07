<?php if(!empty($menus)): ?>
	<div id="menu">
		<?php foreach($menus as $k => $v): ?>
			<div id="sub_menu">
				<h2><?php echo __($k); ?></h2>
				
				<ul>
					<?php foreach($v['items'] as $item): if(!$sf_user->hasPermission($item['permissions'])) continue; ?>
						<li class="<?php echo preg_match('`^'.preg_quote(url_for($item['route'])).'`', $_SERVER['REQUEST_URI']) ? 'active' : ''; ?>">
							<?php if(isset($item['icon'])): ?>
								<?php $img = image_tag($item['icon'], array(
									'title' => __($item['title']),
									'alt' => __($item['title'])
								)); ?>
							<?php else: ?>
								<?php $img = image_tag('/images/dashboard/menu_default.png', array(
									'title' => __($item['title']),
									'alt' => __($item['title'])
								)); ?>
							<?php endif; ?>

							<?php echo link_to($img.__($item['title']), $item['route']); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
