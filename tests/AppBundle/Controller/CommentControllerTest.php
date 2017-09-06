<?php

/*
 * This file is part of the TestVagrant Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CommentControllerTest
 */
class CommentControllerTest extends WebTestCase
{
    /**
     * TEST get Api Comments
     */
    public function testGetComments()
    {
        $client = static::createClient();

        /** @var Response $response */
        $client->request('GET', '/api/comments');
        $response = $client->getResponse();
        $this->assertSame('application/json', $response->headers->get('Content-Type'));

        /** @var Comment[]|ArrayCollection $contentResponse */
        $contentResponse = json_decode($response->getContent(), true);
        $comments = $contentResponse['comments'];
        $this->assertInternalType('array', $comments);

        foreach ($comments as $comment) {
            $this->assertInternalType('array', $comment, 'test');
            $this->assertEquals(3, count($comment));
            $this->assertArrayHasKey('content', $comment);
            $this->assertArrayHasKey('lastNameUser', $comment);
            $this->assertArrayHasKey('firstNameUser', $comment);
        }
    }
}