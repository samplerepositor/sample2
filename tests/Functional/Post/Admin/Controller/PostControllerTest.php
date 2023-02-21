<?php

declare(strict_types=1);

namespace App\Tests\Functional\Post\Admin\Controller;

use App\Tests\Cases\JwtApiTestCase;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostControllerTest extends JwtApiTestCase
{
    private string $baseUrl = '/admin/post';

    /**
     * @dataProvider createPostTestCases
     */
    public function testItCreatesPost(
        array $postData,
        string $responseFile = '',
        int $responseCode = Response::HTTP_NO_CONTENT
    ): void {
        $response = $this->authorizedRequest(
            Request::METHOD_POST,
            $this->baseUrl,
            $postData,
        );

        $this->assertResponse($response, $responseFile, $responseCode);
    }

    public function createPostTestCases(): Generator
    {
        yield 'test it creates post' => [
            'postData' => [
                'title' => 'title',
                'category' => 'NEWS',
                'body' => 'body',
                'published_at_from' => '2023-02-21 00:00:00',
                'published_at_to' => '2024-02-21 23:59:59',
            ],
            'responseFile' => 'create_post_ok.json',
        ];
        yield 'test it validates required data' => [
            'postData' => [
                'title' => '',
                'category' => '',
                'body' => '',
                'published_at_from' => '',
                'published_at_to' => '',
            ],
            'responseFile' => 'create_post_failed_required.json',
            'responseCode' => 400,
        ];
    }

    protected static function getFixtures(): array
    {
        return ['Post/Admin/DataFixtures'];
    }
}
