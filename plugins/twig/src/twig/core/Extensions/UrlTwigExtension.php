<?php

declare(strict_types=1);

 /**
 * Flextype - Hybrid Content Management System with the freedom of a headless CMS 
 * and with the full functionality of a traditional CMS!
 * 
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Flextype\Plugin\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UrlTwigExtension extends AbstractExtension
{
    /**
     * Callback for twig.
     *
     * @return array
     */
    public function getFunctions() : array
    {
        return [
            new TwigFunction('urlFor', 'urlFor'),
            new TwigFunction('fullUrlFor', 'fullUrlFor'),
            new TwigFunction('getBasePath', 'getBasePath'),
            new TwigFunction('getBaseUrl', 'getBaseUrl'),
            new TwigFunction('getCurrentUrl', 'getCurrentUrl'),
            new TwigFunction('getAbsoluteUrl', 'getAbsoluteUrl'),
            new TwigFunction('getUriString', 'getUriString'),
            new TwigFunction('redirect', 'redirect'),
            new TwigFunction('getProjectUrl', 'getProjectUrl')
        ];
    }
}
