<?php

namespace UrlShortenerBundle\Services;


use Doctrine\ORM\EntityManager;
use Mremi\UrlShortener\Model\LinkInterface;
use Mremi\UrlShortener\Model\LinkManager;
use UrlShortenerBundle\Entity\ShortLink;

Class ShortLinkService {

    /** @var  LinkManager */
    private $linkManager;

    /** @var  EntityManager */
    private $entityManager;

    public function setLinkManager(LinkManager $linkManager) {
        $this->linkManager = $linkManager;
    }

    public function setEntityManager( EntityManager $em ) {
        $this->entityManager = $em;
    }

    public function getShortUrl( $type = 'bitly', $url = 'http://www.google.com' )
    {
        $shortLink = null;
        /** @var ShortLink $link */
        if( $shortLink = $this->tryGetShortLinkDB($type, $url) )
        {
            return $shortLink;
        } else {
            /** @var LinkInterface $shortened */
            $shortened = $this->linkManager->findOneByProviderAndLongUrl($type, $url);
            $shortUrl = $shortened->getShortUrl();

            $shortLink = new ShortLink();
            $shortLink->setType($type);
            $shortLink->setLongUrl($url);
            $shortLink->setShortUrl($shortUrl);

            $this->entityManager->persist($shortLink);
            $this->entityManager->flush();

        }

        return $shortLink;

    }


    /**
     * Tries to get link from databse
     *
     * @param string $type
     * @param string $url
     * @return ShortLink | null
     */
    public function tryGetShortLinkDB($type, $longUrl) {

        $shortLink = $this->entityManager->getRepository('UrlShortenerBundle:ShortLink')->findOneBy(
            array(
                'type' => $type,
                'longUrl' => $longUrl
            )
        );

        return $shortLink;
    }

}