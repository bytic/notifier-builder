<?php
declare(strict_types=1);


use ByTIC\NotifierBuilder\Templates\Models\Template;

/** @var Template[] $templates */
$templates = $this->templates;

$templatesRepository = NotifierBuilderModels::templates();
?>

<?php
if (count($templates) < 1): ?>
    <?= $this->Messages()->info($templatesRepository->getMessage('dnx')); ?>
    <?php
    return; ?>
<?php
endif; ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th><?= translator()->trans('parent'); ?></th>
        <th><?= translator()->trans('channel'); ?></th>
        <th><?= translator()->trans('subject'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($templates as $template): ?>
        <tr>
            <td>
                [<?= $template->getParentType(); ?>: <?= $template->getParentId(); ?>]
            </td>
            <td>
                <?= $template->getChannel(); ?>
            </td>
            <td>
                <a href="<?= $template->getURL(); ?>">
                    <?= $template->getSubject(); ?>
                </a>
            </td>
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>
