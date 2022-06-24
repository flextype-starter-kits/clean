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
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = Command::SUCCESS;
        
        filesystem()->directory(ROOT_DIR . '/' . registry()->get('plugins.sitemap.settings.sitemap_path'))->ensureExists(0755, true);

        $saveResult = filesystem()->file(ROOT_DIR . '/' . registry()->get('plugins.sitemap.settings.sitemap_path') . '/sitemap.xml')->put((new Sitemap())->fetch());

        if ($saveResult) {
            $output->write(
                renderToString(
                    div('Success: Sitemap successfully generated.', 
                        'bg-success px-2 py-1')
                )
            );
            $result = Command::SUCCESS;
        } else {
            $output->write(
                renderToString(
                    div('Failure: Sitemap was not found generated.', 
                        'bg-danger px-2 py-1')
                )
            );
            $result = Command::FAILURE;
        }

        return $result;
    }
}