<?php

namespace UrlShortenerBundle\Controller;

use Mremi\UrlShortener\Model\LinkInterface;
use Mremi\UrlShortenerBundle\Doctrine\LinkManager;
use Mremi\UrlShortenerBundle\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UrlShortenerBundle\Services\ShortLinkService;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        /** @var LinkManager $linkManager */
//        $linkManager = $this->get('mremi_url_shortener.link_manager');
//        /** @var LinkInterface $shortened */
//        $shortened = $linkManager->findOneByProviderAndLongUrl('bitly', 'http://www.15min.lt');
//        dump( array( $shortened->getShortUrl(), $shortened->getLongUrl() ) );

        /** @var ShortLinkService $shortLinkService */
        $shortLinkService = $this->get('url_shortener.shortlinkservice');

        dump( $shortLinkService->getShortUrl('bitly', 'http://www.15min.lt') ); exit;

        return $this->render('UrlShortenerBundle:Default:index.html.twig');
    }
}
