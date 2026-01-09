<?php

declare(strict_types=1);
$this->addTab(
    'details',
    'Detalii',
    '/' . $this->controller . '/modules/item-form',
    ['action' => $this->item->getUpdateURL()],
    true
);
echo $this->load('/abstract/view', [
    'delete' => false,
]);
