<?php

namespace Gaufrette\Adapter;

use \CF_Container as RackspaceContainer,
    \CF_Authentication as RackspaceAuthentication,
    \CF_Connection as RackspaceConnection;

use Gaufrette\Adapter\RackspaceCloudfiles;

/**
 * Rackspace cloudfiles adapter (based on the default gaufrette rackspace adapter) that issues authentication and
 * initializes the container only when needed to.
 *
 * @package GaufretteBundle
 * @author  Luciano Mammino <lmammino@oryzone.com>
 */
class LazyRackspaceCloudfiles extends RackspaceCloudfiles
{
    /**
     * @var \CF_Authentication $authentication
     */
    protected $authentication;

    /**
     * @var string $containerName
     */
    protected $containerName;

    /**
     * @var bool $createContainer
     */
    protected $createContainer;

    /**
     * @var bool $initialized
     */
    protected $initialized = FALSE;

    /**
     * Constructor.
     * Creates a new Rackspace adapter starting from a rackspace authentication instance and a container name
     *
     * @param \CF_Authentication $authentication
     * @param string             $containerName
     * @param bool               $createContainer if <code>TRUE</code> will try to create the container if not existent. Default <code>FALSE</code>
     */
    public function __construct(RackspaceAuthentication $authentication, $containerName, $createContainer = FALSE)
    {
        $this->authentication = $authentication;
        $this->containerName = $containerName;
        $this->createContainer = $createContainer;
    }

    /**
     * Initializes the container
     */
    protected function initialize()
    {
        if (!$this->initialized) {
            if(!$this->authentication->authenticated())
                $this->authentication->authenticate();

            $conn = new RackspaceConnection($this->authentication);

            $container = NULL;
            if($this->createContainer)
                $this->container = $conn->create_container($this->containerName);
            else
                $this->container = $conn->get_container($this->containerName);

            $this->initialized = TRUE;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function read($key)
    {
        $this->initialize();

        return parent::read($key);
    }

    /**
     * {@inheritDoc}
     */
    public function write($key, $content, array $metadata = null)
    {
        $this->initialize();

        return parent::write($key, $content, $metadata);
    }

    /**
     * {@inheritDoc}
     */
    public function exists($key)
    {
        $this->initialize();

        return parent::exists($key);
    }

    /**
     * {@inheritDoc}
     */
    public function keys()
    {
        $this->initialize();

        return parent::keys();
    }

    /**
     * {@inheritDoc}
     */
    public function checksum($key)
    {
        $this->initialize();

        return parent::keys();
    }

    /**
     * {@inheritDoc}
     */
    public function delete($key)
    {
        $this->initialize();

        return parent::delete($key);
    }
}
