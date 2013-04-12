<?php

namespace Gaufrette\Adapter\OpenCloud;

/**
 * Implementation of the object store factory
 *
 * @package Gaufrette
 * @author Luciano Mammino <lmammino@oryzone.com>
 */
class ObjectStoreFactory implements ObjectStoreFactoryInterface
{
    /**
     * @var \OpenCloud\OpenStack $connection
     */
    protected $connection;

    /**
     * @var string $serviceName
     */
    protected $serviceName;

    /**
     * @var string $region
     */
    protected $region;

    /**
     * @var string $urlType
     */
    protected $urlType;

    /**
     * Constructor
     *
     * @param \OpenCloud\OpenStack $connection
     * @param string $serviceName
     * @param string $region
     * @param string $urlType
     */
    public function __construct(\OpenCloud\OpenStack $connection, $serviceName = 'cloudFiles', $region = 'DFW', $urlType = 'publicURL')
    {
        $this->connection = $connection;
        $this->serviceName = $serviceName;
        $this->region = $region;
        $this->urlType = $urlType;
    }


    /**
     * {@inheritDoc}
     */
    public function create()
    {
        return $this->connection->ObjectStore($this->serviceName, $this->region, $this->urlType);
    }
}