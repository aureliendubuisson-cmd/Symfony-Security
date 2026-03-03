<?php

namespace App\Service;

use League\CommonMark\CommonMarkConverter;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    private CommonMarkConverter $markdownConverter;

    public function __construct(
        private readonly CacheInterface $cache,
        private readonly bool                    $isDebug,
        private readonly LoggerInterface         $mdLogger
    ) {
        // On instancie directement le parseur de la librairie League
        $this->markdownConverter = new CommonMarkConverter();
    }

    public function parse(string $source): string
    {
        if (stripos($source, 'cat') !== false) {
            $this->mdLogger->info('Meow!');
        }

        if ($this->isDebug) {
            return $this->markdownConverter->convert($source)->getContent();
        }

        return $this->cache->get('markdown_' . md5($source), function () use ($source) {
            // La méthode a changé : ce n'est plus transformMarkdown()
            return $this->markdownConverter->convert($source)->getContent();
        });
    }
}