<?php

namespace Tests\Feature;

use Tests\TestCase;


class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorkingCorrectly()
    {
        $response = $this->get('/');

        $response->assertSeeText('Hello from home.');
    }
    
    public function testContactPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');
        $response->assertSeeText('Hello from contact.');
    }
}
