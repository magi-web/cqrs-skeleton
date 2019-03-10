<?php
/**
 * Created by PhpStorm.
 * User: ptipe
 * Date: 09/03/2019
 * Time: 23:15
 */

namespace App\Core\Infrastructure\Controller\Web;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/", name="home_page")
     */
    public function number($max = 100)
    {
        $number = random_int(0, $max);

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }
}