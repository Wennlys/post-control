<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Model\User;
use Source\Model\Article;
use Source\Model\UserDAOImpl;
use Source\Model\ArticleDAOImpl;
use Source\App\Services\UserService;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class ArticleUpdateAction
{
    private ArticleService $articleService;
    private UserService $userService;

    public function __construct()
    {
        $userDao = new UserDAOImpl();
        $this->userService = new UserService($userDao);
        $articleDao = new ArticleDAOImpl();
        $this->articleService = new ArticleService($articleDao);
    }

    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        [
            'id' => $id,
            'user_id' => $userId,
            'title' => $title,
            'body' => $body,
            'slug' => $slug,
            'published' => $published,
            'tags' => $tags
        ] = (array) json_decode((string) $request->getBody());

        $user = new User();
        $user->setId($userId);

        if (!$this->userService->show($user)['success']) {
            return new JsonResponse(['message' => 'User not found.'], 404);
        }

        $article = new Article();
        $article->setId($id);
        $article->setUserId($userId);
        $article->setTittle($title);
        $article->setBody($body);
        $article->setSlug($slug);
        $article->setPublished($published);
        $article->setTags($tags);

        $response = $this->articleService->update($article);

        return new JsonResponse($response);
    }
}
