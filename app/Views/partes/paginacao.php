<?= $pager->links('default', 'bootstrap_full') ?>

<div class="text-center mt-3 mb-4">
  <?php if ($totalRecords > 0) : ?>
    Exibindo <strong><?= $firstItem ?></strong> a <strong><?= $lastItem ?></strong> de <strong><?= $totalRecords ?></strong> registros.
  <?php else : ?>
    Nenhum registro encontrado.
  <?php endif; ?>
</div>