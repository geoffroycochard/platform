<?php

namespace Oro\Bundle\ApiBundle\Processor;

use Oro\Component\ChainProcessor\ActionProcessor;
use Oro\Component\ChainProcessor\ProcessorBag;
use Oro\Bundle\ApiBundle\Processor\GetList\GetListContext;
use Oro\Bundle\ApiBundle\Provider\ConfigProvider;

class GetListProcessor extends ActionProcessor
{
    /** @var ConfigProvider */
    protected $configProvider;

    /**
     * @param ProcessorBag   $processorBag
     * @param string         $action
     * @param ConfigProvider $configProvider
     */
    public function __construct(ProcessorBag $processorBag, $action, ConfigProvider $configProvider)
    {
        parent::__construct($processorBag, $action);
        $this->configProvider = $configProvider;
    }

    /**
     * {@inheritdoc}
     */
    protected function createContextObject()
    {
        return new GetListContext($this->configProvider);
    }
}
