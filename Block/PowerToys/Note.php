<?php
declare(strict_types=1);

namespace Jajuma\PotNote\Block\PowerToys;

use Jajuma\PowerToys\Block\PowerToys\QuickAction;

class Note extends QuickAction
{
    const XML_PATH_ENABLE = 'power_toys/pot_note/is_enabled';

    public function isEnable(): bool
    {
        return $this->_scopeConfig->isSetFlag(self::XML_PATH_ENABLE);
    }
}