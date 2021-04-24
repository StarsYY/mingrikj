<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <ul class="am-pagination am-pagination-right">
			<?php echo $presenter->render(); ?>
	</ul>
<?php endif; ?>
