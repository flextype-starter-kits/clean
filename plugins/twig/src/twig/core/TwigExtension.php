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

namespace Flextype\Plugin\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'slim';
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('urlFor', [TwigRuntimeExtension::class, 'urlFor']),
            new TwigFunction('fullUrlFor', [TwigRuntimeExtension::class, 'fullUrlFor']),
            new TwigFunction('isCurrentUrl', [TwigRuntimeExtension::class, 'isCurrentUrl']),
            new TwigFunction('currentUrl', [TwigRuntimeExtension::class, 'getCurrentUrl']),
            new TwigFunction('getUri', [TwigRuntimeExtension::class, 'getUri']),
            new TwigFunction('getBaseUrl', [TwigRuntimeExtension::class, 'getBaseUrl']),
            new TwigFunction('getBasePath', [TwigRuntimeExtension::class, 'getBasePath']),
            new TwigFunction('getAbsoluteUrl', [TwigRuntimeExtension::class, 'getAbsoluteUrl']),
        ];
    }
}
