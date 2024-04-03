<?php

namespace Tests\Unit;

use App\Http\Controllers\GameController;
use Tests\TestCase;

class NewGameControllerTest extends TestCase
{
    public function testDictionaryWordFound(): void 
    {
        $controller = new GameController();
        $this->assertTrue($controller->dictionary('hello'));
    }

    public function testDictionaryWordNotFound(): void 
    {
        $controller = new GameController();
        $this->assertFalse($controller->dictionary('wqwqwqw'));
    }

    public function testIsPalindrome(): void 
    {
        $controller = new GameController();
        $this->assertTrue($controller->isPalindrome('level'));
        $this->assertFalse($controller->isPalindrome('hello'));
    }

    public function testIsAlmostPalindrome(): void 
    {
        $controller = new GameController();
        $this->assertTrue($controller->isAlmostPalindrome('engage'));
        $this->assertFalse($controller->isAlmostPalindrome('hello'));
    }

    public function testScore(): void 
    {
        $controller = new GameController();
        $request = new \Illuminate\Http\Request();
        $request->merge(['word' => 'hello']);

        $response = $controller->score($request);
        $this->assertEquals(4, $response->getData()->score);
    }
}
