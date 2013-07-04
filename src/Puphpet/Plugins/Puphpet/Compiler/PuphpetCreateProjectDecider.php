<?php

namespace Puphpet\Plugins\Puphpet\Compiler;

use Puphpet\Domain\Compiler\DeciderInterface;
use Puphpet\Domain\Configuration\PropertyAccessProvider;

/**
 * Decides if Puphpet project should be cloned (not as easy without a solid domain model)
 */
class PuphpetCreateProjectDecider implements DeciderInterface
{
    /**
     * @var PropertyAccessProvider
     */
    private $provider;

    /**
     * @var string
     */
    private $editionIdentifier;

    /**
     * @param PropertyAccessProvider $provider
     * @param string                 $editionIdentifier
     */
    public function __construct(PropertyAccessProvider $provider, $editionIdentifier = 'puphpet')
    {
        $this->provider = $provider;
        $this->editionIdentifier = $editionIdentifier;
    }

    /**
     * @param array $configuration
     *
     * @return bool
     */
    public function supports(array &$configuration)
    {
        $propertyAccess = $this->provider->provide();
        if ($this->editionIdentifier == $propertyAccess->getValue($configuration, '[project][edition]')) {
            return true;
        }

        return false;
    }
}
