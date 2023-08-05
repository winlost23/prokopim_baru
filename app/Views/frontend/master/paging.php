<?php $pager->setSurroundCount(2) ?>
<br />
<div class="pagination-box">
    <ul class="pagination-list">
        <?php if ($pager->hasPrevious()) : ?>
            <li><a href="<?= $pager->getFirst() ?>"><?= lang('Pager.first') ?></a></li>
            <li><a href="<?= $pager->getPrevious() ?>"><?= lang('Pager.previous') ?></a></li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li><a <?= $link['active'] ? 'class="active"' : '' ?> href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li><a href="<?= $pager->getNext() ?>"><?= lang('Pager.next') ?></a></li>
            <li><a href="<?= $pager->getLast() ?>"><?= lang('Pager.last') ?></a></li>
        <?php endif ?>
    </ul>
</div>