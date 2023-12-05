<?php declare(strict_types=1);
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\PotNote\Magewire;

use Magewirephp\Magewire\Component;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\ResourceConnection;

class Note extends Component
{
    const XML_PATH_POT_NOTE = 'power_toys/pot_note/note';

    public $note = '';

    public $messagePotNote = '';

    private $resourceConnection;

    private $configWriter;

    public function __construct(
        ResourceConnection $resourceConnection,
        WriterInterface $configWriter
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->configWriter = $configWriter;
    }

    public function mount(): void
    {
        $connection = $this->resourceConnection->getConnection();
        $table = $connection->getTableName('core_config_data');
        $query = "SELECT * FROM `" . $table . "` WHERE `path` = '" . self::XML_PATH_POT_NOTE . "'";
        $result = $connection->fetchRow($query);
        $this->note = isset($result['value']) ? $result['value'] : '';
        parent::mount();
    }

    public function saveNote()
    {
       $this->configWriter->save(self::XML_PATH_POT_NOTE, $this->note);
       $this->note = $this->note;
       $this->messagePotNote = 'Note has been saved successfully.';
    }
}
