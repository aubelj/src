<?php 

namespace upReal\UserBundle\Services;

use upReal\UserBundle\Entity\Lists;
use Doctrine\ORM\EntityManager;

class URLists
{
    protected $em;

    public function __construct(EntityManager $em)
    {      
        $this->em = $em;
    }

	public function retrieveLists()
	{
		$em = $this->$em;

		$lists = $em->getRepository('URUserBundle:Lists')->findMineMin($this->getUser()->getId());

		return $lists;
	}

}