<?php


namespace Gaufrette\Adapter\OpenCloud;

/**
 * Interface for the object store factory
 *
 * @package Gaufrette
 * @author Luciano Mammino <lmammino@oryzone.com>
 */
interface ObjectStoreFactoryInterface
{
    /**
     * Instantiates and return the object store
     *
     * @return \OpenCloud\ObjectStore
     */
    public function create();
}