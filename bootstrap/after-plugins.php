<?php 

/**
 * Anything that should be executed after plugins initialization.
 */

/**
 * Add pagination pages for static site generator. 
 */
emitter()->addListener('onStaticSiteAfterInitialized', static function (): void {    

    $blogID          = 'blog';
    $blogPostsLimit  = entries()->fetch($blogID)->get('posts_limit');
    $blogPostsCount  = entries()->fetch($blogID, ['collection' => true])->where('visibility', 'nin', ['draft', 'hidden'])->count();
    $blogPostsPages  = (int) ceil(($blogPostsCount / $blogPostsLimit));

    for ($i=1; $i < $blogPostsPages + 1; $i++) { 
        $items[] = ['title' => 'Page ' . $i, 'template' => 'blog', 'id' => 'blog/pages/' . $i, 'page' => $i];
    }

    registry()->set('plugins.site.static.entries', collection(registry()->get('plugins.site.static.entries'))->merge($items));
});
