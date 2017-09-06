<?php

/*
 * This file is part of the TestVagrant Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Comment;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCommentData
 */
class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    private $contents = [
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in eros et felis commodo placerat in vel odio. Suspendisse posuere eros a mauris tincidunt facilisis. Nulla facilisi. Fusce nec viverra eros. Morbi congue, tellus nec convallis iaculis, quam leo lacinia ipsum, id aliquam quam sem vel nibh. Aliquam tortor eros, elementum interdum convallis at, pellentesque quis quam. Proin elementum ex iaculis nisl ornare, nec tempor dolor auctor. Sed eget faucibus metus, ut rutrum sapien. Aenean porttitor bibendum accumsan. Nunc sed nisi nec felis fringilla iaculis. Aliquam lobortis vitae lorem non luctus. Pellentesque arcu enim, hendrerit id lacus non, fermentum pharetra neque.',
        'Sed ornare nisi varius, imperdiet ex ac, facilisis metus. Sed molestie lorem ante, id faucibus tellus ornare sed. Duis interdum ipsum id tempor rutrum. Duis congue lorem at felis vestibulum, ac ultrices sapien bibendum. Vivamus mollis mollis mi. Phasellus accumsan mollis porttitor. Sed nec nisi pretium, iaculis metus ac, vulputate dolor. Nullam viverra quam elementum ligula placerat, a dapibus est auctor.',
        'Nam placerat id turpis non mattis. Sed nunc nisl, blandit in porttitor dignissim, convallis sed quam. Mauris semper tortor quis risus tempor vehicula. Donec at pharetra dui. Proin imperdiet neque nec diam cursus aliquam. Proin convallis orci nulla, ac interdum purus placerat eget. Integer id ipsum risus. Suspendisse id tempus felis, at mattis erat. Pellentesque maximus diam id dictum semper. Integer at feugiat purus, ac pretium est. Pellentesque sollicitudin, erat a commodo mattis, ante eros venenatis risus, vitae maximus eros lectus at arcu. Maecenas sapien libero, ornare sit amet purus sit amet, aliquam finibus lorem. Vivamus interdum sapien a pharetra imperdiet.',
        'Nulla eleifend tortor nec tellus vulputate, a molestie dolor efficitur. Aenean ultrices luctus nulla, non sagittis sapien imperdiet ut. Integer maximus tortor sapien, eget tincidunt purus tempor iaculis. Cras porttitor, odio vitae tincidunt tincidunt, nunc velit ullamcorper lorem, quis gravida lectus odio eu lacus. In euismod magna dolor, molestie fringilla quam fermentum non. Praesent nec auctor nisi. Pellentesque sodales nulla at magna pharetra, et molestie mauris auctor. Phasellus ac dignissim massa, vitae varius massa.',
        'Fusce ultricies sem nisi, eget vestibulum est lobortis non. Aliquam interdum mauris a dictum aliquet. Integer sit amet elit lacus. Vivamus augue magna, efficitur eget erat a, placerat semper nisi. Suspendisse potenti. Vestibulum magna orci, sollicitudin sit amet lectus vitae, tincidunt mollis odio. Aliquam eu tincidunt dolor, ut ornare ex.',
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 30; $i++) {
            /** @var User $user */
            $user    = $this->getReference('user-'.rand(1, 20));
            $comment = new Comment();
            $comment
                ->setUser($user)
                ->setStatus(array_rand(Comment::getAvailableStatus()))
                ->setContent(array_rand($this->contents));

            $manager->persist($comment);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
