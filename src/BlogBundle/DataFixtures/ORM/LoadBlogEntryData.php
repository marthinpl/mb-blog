<?php
namespace BlogBundle\DataFixtures\ORM;

use BlogBundle\Entity\BlogEntry;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBlogEntryData extends AbstractFixture  implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach (range(0, 15) as $number) {
            $blogEntry = new BlogEntry();
            $blogEntry->setName('XYZ'.rand(900, 5000));
            $blogEntry->setContent('Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem');
            $blogEntry->setIsActive(true);
            $blogEntry->addCategory($this->getReference($number % 3 ? 'general-category' : 'street-photo'));
            $manager->persist($blogEntry);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}