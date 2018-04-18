<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables\Source\Commands;

use Doctrine\DBAL\Connection;
use Shopware\Components\Plugin\ConfigReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExportSettingsCommand extends Command
{
    /**
     * @var ConfigReader
     */
    private $configReader;

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(ConfigReader $configReader, Connection $connection)
    {
        parent::__construct();
        $this->configReader = $configReader;
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('shopware-blog:export:settings');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $plugins = $this->connection
            ->fetchAll(
                'SELECT name FROM s_core_plugins
                           WHERE name != \'PluginManager\' 
                           AND capability_enable = 1'
            );
        $shopIds = $this->connection
            ->fetchAll('SELECT id FROM s_core_shops');

        $config = [];
        foreach ($plugins as $plugin) {
            foreach ($shopIds as $shopId) {
                $pluginConfig = $this->configReader->getByPluginName($plugin['name']);
                if ($pluginConfig) {
                    $config['plugins'][(int) $shopId['id']][$plugin['name']] = $pluginConfig;
                }
            }
        }

        file_put_contents(
            __DIR__ . '/../../plugins_config.php',
            '<?php' . "\n\n" . var_export($config, true) . ';',
            LOCK_EX
        );
    }
}
