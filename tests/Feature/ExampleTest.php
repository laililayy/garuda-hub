<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_homepage_redirects_to_projects(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('projects.index'));
    }
}