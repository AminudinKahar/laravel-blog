<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{

    public function testHomePageIsWorkingCorrectly()
    {
        //act
        $response = $this->get('/');

        //assert
        $response->assertSeeText('Welcome to Laravel Blog Post!');
        $response->assertSeeText('This is the content of the main page');
    }

    public function testContactPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact Page');
        $response->assertSeeText('This is the contact page');
    }
}
