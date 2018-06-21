<?php

namespace Magenta\Bundle\SWarrantyAdminBundle\Twig;

use Magenta\Bundle\SWarrantyModelBundle\Entity\Media\Media;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MagentaTwigExtension extends AbstractExtension {
	/** @var ContainerInterface $container */
	private $container;
	
	public function __construct(ContainerInterface $c) {
		$this->container = $c;
	}
	
	public function getFilters() {
		return array(
			new TwigFilter('privateMediumUrl', array( $this, 'privateMediumUrl' )),
		);
	}
	
	public function privateMediumUrl($mediumId, $format = 'admin') {
		$c = $this->container;
		
		return $c->get('sonata.media.manager.media')->generatePrivateUrl($mediumId, $format);
	}
}
