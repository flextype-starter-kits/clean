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
use Twig\TwigFilter;

class FiltersTwigExtension extends AbstractExtension
{
    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array
     */
    public function getFilters() : array
    {
        return [
            new TwigFilter('shortcode', [$this, 'shortcode']),
            new TwigFilter('markdown', [$this, 'markdown']),
        ];
    }

    public function shortcode($value): string
    {
        return !empty($value) ? parsers()->shortcodes()->process($value) : '';
    }

    public function markdown($value): string
    {
        return !empty($value) ? parsers()->markdown()->parse($value) : '';
    }
}
