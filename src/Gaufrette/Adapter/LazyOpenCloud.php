<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter\OpenCloud\ObjectStoreFactoryInterface;

/**
 * OpenCloud adapter
 *
 * @package Gaufrette
 * @author  Luciano Mammino <lmammino@oryzone.com>
 */
class LazyOpenCloud extends OpenCloud
{
    /**
     * @var OpenCloud\ObjectStoreFactoryInterface $objectStoreFactory
     */
    protected $objectStoreFactory;

    /**
     * Constructor
     *
     * @param ObjectStoreFactoryInterface $objectStoreFactory
     * @param string $containerName
     * @param bool $createContainer
     * @param bool $detectContentType
     */
    public function __construct(ObjectStoreFactoryInterface $objectStoreFactory, $containerName,
                                $createContainer = false, $detectContentType = true)
    {
        $this->objectStoreFactory = $objectStoreFactory;
        $this->containerName = $containerName;
        $this->createContainer = $createContainer;
        $this->detectContentType = $detectContentType;
    }

    /**
     * {@inheritDoc}
     */
    protected function initialize()
    {
        if(!$this->objectStore instanceof \OpenCloud\ObjectStore) {
            $this->objectStore = $this->objectStoreFactory->create();
        }

        parent::initialize();
    }

}