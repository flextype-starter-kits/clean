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

namespace Flextype\Plugin\Sitemap\Console\Commands\Sitemap;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Flextype\Plugin\Sitemap\Sitemap;
use function Thermage\div;
use function Thermage\renderToString;

class SitemapGenerateCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('sitemap:generate');
        $this->setDescription('Generate sitemap.');
        $this->addOption('sitemap-path', null, InputOption::VALUE_REQUIRED, 'Destination for generated static sitemap file (without trailing and without starting slash)');
        $this->addOption('site-url', null, InputOption::VALUE_REQUIRED, 'Sit url (without trailing slash).');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = Command::SUCCESS;
       
        $sitemapPath = $input->getOption('sitemap-path') ? $input->getOption('sitemap-path') : registry()->get('plugins.sitemap.settings.static.sitemap_path');

        $staticSitemapPath = ROOT_DIR . '/' . $sitemapPath;
        
        if ($input->getOption('site-url')) {
            registry()->set('flextype.settings.base_url', $input->getOption('site-url'));
            registry()->set('flextype.settings.base_path', '');
        } else {
            registry()->set('flextype.settings.base_url', registry()->get('plugins.sitemap.settings.static.site_url'));
            registry()->set('flextype.settings.base_path', '');
        }

        $saveResult = filesystem()->file($staticSitemapPath . '/sitemap.xml')->put((new Sitemap())->fetch());

        if ($saveResult) {
            $output->write(
                renderToString(
                    div('Sitemap ' . strings($sitemapPath . '/sitemap.xml')->reduceSlashes()->trim('/') . ' generated successfully.', 
                        'color-success px-2 py-1')
                )
            );
            $result = Command::SUCCESS;
        } else {
            $output->write(
                renderToString(
                    div('Sitemap was not generated.', 
                        'color-danger px-2 py-1')
                )
            );
            $result = Command::FAILURE;
        }

        return $result;
    }
}