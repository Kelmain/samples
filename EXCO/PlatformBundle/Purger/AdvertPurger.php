<?php
/**
 * Created by PhpStorm.
 * User: Armin
 * Date: 17/04/2017
 * Time: 19:48
 */

namespace EXCO\PlatformBundle\Purger;
use Doctrine\ORM\EntityManagerInterface;

class AdvertPurger
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function purge($days)
    {
        $advertRepository      = $this->em->getRepository('EXCOPlatformBundle:Advert');
        $advertSkillRepository = $this->em->getRepository('EXCOPlatformBundle:AdvertSkill');

        $date = new \Datetime($days.' days ago');

        $listAdverts = $advertRepository->getAdvertsBefore($date);

        foreach ($listAdverts as $advert) {

            $advertSkills = $advertSkillRepository->findBy(array('advert' => $advert));

            foreach ($advertSkills as $advertSkill) {
                $this->em->remove($advertSkill);
            }

            $this->em->remove($advert);
        }

        $this->em->flush();
    }
}