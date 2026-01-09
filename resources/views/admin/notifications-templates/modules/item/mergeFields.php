<?php
declare(strict_types=1);
foreach ($this->nMergeFields as $type => $fields) { ?>
    <p>
        <?php
        foreach ($fields as $field) { ?>
            {{<?= $field; ?>}}<br/>
        <?php
        } ?>
    </p>
    <hr/>
<?php
} ?>
