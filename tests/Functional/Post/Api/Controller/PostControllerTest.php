<?php

declare(strict_types=1);

namespace App\Tests\Functional\Post\Api\Controller;

use App\Tests\Cases\JwtApiTestCase;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @internal
 */
class PostControllerTest extends JwtApiTestCase
{
    private string $baseUrl = '/api/post';

    /**
     * @dataProvider getPostListTestCases
     */
    public function testItReturnsPostList(
        string $url,
        string $responseFile,
        int $responseCode = Response::HTTP_OK
    ): void {
        $response = $this->authorizedRequest(Request::METHOD_GET, $url);

        $this->assertResponse($response, $responseFile, $responseCode);
    }

    public function getPostListTestCases(): Generator
    {
        yield 'test it returns post list' => [
            'url' => $this->baseUrl,
            'responseFile' => 'post_list.json',
        ];
        yield 'test it paginates post list' => [
            'url' => sprintf('%s?limit=1&page=2', $this->baseUrl),
            'responseFile' => 'post_paginated_list.json',
        ];
    }

    protected static function getFixtures(): array
    {
        return ['Post/Api/DataFixtures'];
    }
}
