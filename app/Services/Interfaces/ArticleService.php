<?php


namespace App\Services\Interfaces;


use App\Models\Article;

interface ArticleService
{
    public function createArticle($data);
    public function increaseArticleView(Article $article);
}
