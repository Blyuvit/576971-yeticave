<?php if ($pagesqty > 1): ?>
	<ul class="pagination-list">	
		<li class="pagination-item pagination-item-prev"><a>Назад</a></li>
		<?php foreach ($pages as $value): ?>
			<li class="pagination-item <?php if ($value == $page) echo 'pagination-item-active'; ?>"><a href="/?page=<?=$value;?>"><?=$value ?></a></li>
		<?php endforeach; ?>
		<li class="pagination-item pagination-item-next"><a>Вперед</a></li>		
	</ul>
<?php endif; ?>