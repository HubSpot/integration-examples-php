<?php if (isset($paginator)  && $paginator->getPagesCount() > 1) { ?>
<div class="row pagination">
    <a href="<?= $paginator->getUrl(1)?>"><<</a>
    <a href="<?= $paginator->getUrl($paginator->getPrevPage())?>"><</a>
    <?php for ($i = $paginator->getStartPage(); $i <= $paginator->getEndPage(); $i++) { ?>
        <a href="<?=$paginator->getUrl($i)?>"<?php
         if ($i == $paginator->getPage()) {?> class="active"<?php } ?>><?=$i?></a>
    <?php } ?>
    <a href="<?= $paginator->getUrl($paginator->getNextPage())?>">></a>
    <a href="<?= $paginator->getUrl($paginator->getPagesCount())?>">>></a>
</div>
<?php } ?>
