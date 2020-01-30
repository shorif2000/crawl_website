<?php
declare(strict_types=1);

namespace App\Command;

use App\Applications\Services\Files\File;
use App\Applications\Services\Containers\Meta;
use App\Applications\Services\Converters\HtmlConverter;
use App\Applications\Services\Converters\JsonConverter;
use App\Applications\Services\ResourceManagers\Reader;
use App\Applications\Services\ResourceManagers\Writer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

class DomCrawlerCommand extends Command
{
    protected static $defaultName = 'app:dom-crawler';


    protected function configure()
    {
        $this
            ->setDescription('Capture products off Videx')
            ->addArgument('url', InputArgument::REQUIRED, 'url of Videx')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $url = $input->getArgument('url');
        
        if (preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$url) !== 1) {
            $io->error('Not a valid URL');
            return 1;
        }
        
        $jsonFile = 'output/videx.json';
        $io->note(sprintf('You passed an url of Videx: %s', $url));

        $metaContainer = new Meta();
        $metaContainer->addMeta(new Reader(new File($url), new HtmlConverter(), $io));
        $metaContainer->sortByPrice();
        $metaContainer->saveMeta(new Writer(new File($jsonFile, new Filesystem()), new JsonConverter()));
        $io->success('Json File is in ~/'.$jsonFile);


        return 0;
    }
}
