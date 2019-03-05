<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Elasticsearch6\Model;

use Magento\Framework\Search\EngineResolverInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\AdvancedSearch\Model\Client\ClientResolver;

/**
 * Elasticsearch6 config model
 */
class Config extends \Magento\Elasticsearch\Model\Config
{
    /**
     * Search engine name
     */
    private const ENGINE_NAME_6 = 'elasticsearch6';

    /**
     * @var EngineResolverInterface
     */
    private $engineResolver;

    /**
     * Constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param ClientResolver|null $clientResolver
     * @param EngineResolverInterface|null $engineResolver
     * @param string|null $prefix
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\AdvancedSearch\Model\Client\ClientResolver $clientResolver = null,
        \Magento\Framework\Search\EngineResolverInterface $engineResolver = null,
        $prefix = null
    ) {
        parent::__construct($scopeConfig, $clientResolver, $engineResolver, $prefix);
        $this->engineResolver = $engineResolver ?: ObjectManager::getInstance()->get(EngineResolverInterface::class);
    }

    /**
     * Return true if third party search engine is used
     *
     * @return bool
     * @since 100.1.0
     */
    public function isElasticsearchEnabled()
    {
        return in_array($this->engineResolver->getCurrentSearchEngine(), [self::ENGINE_NAME_6]);
    }
}
