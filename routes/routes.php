<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Flextype\Plugin\Site\Site;
use function Flextype\app;
use function Flextype\getUriString;
use function Flextype\getBasePath;
use function Glowy\Strings\strings;

/**
 * Blog pages route.
 */
app()->get('/blog/pages/{page}', function (Request $request, Response $response, $page) {
    $data = [
                'uri' => strings(getUriString())->replace(getBasePath(), '')->toString(), 
                'page' => $page, 
                'http_status_code' => 200, 
                'query' => $request->getQueryParams(),
                'id' => strings(getUriString())->replace(getBasePath(), '')->trim('/')->toString(),
                'template' => 'blog'
            ];

    $response = (new Site())->renderResponse($response, $data);
    return $response;
})->setName('blog-pages');