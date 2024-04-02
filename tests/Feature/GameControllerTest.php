<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameControllerTest extends TestCase
{
    /**
     * Test scoring for a normal word
     */
  
    public function testNormalwordScoring(): void 
    {
        $response = $this->postJson('/api/word', ['word' => 'hello']);
        $response->assertStatus(200)->assertJson(['score' => 4]);
    }

     /**
     * Test scoring for a palindrome word
     */

     public function testPalindromeWordScoring(): void 
     {
        $response = $this->postJson('/api/word', ['word' => 'level']);
        $response->assertStatus(200)->assertJson(['score' => 6]);
     }

      /**
     * Test scoring for an almost palindrome word
     */

     public function testAlmostPalindromeWordScoring(): void 
     {
        $response = $this->postJson('/api/word', ['word' => 'engage']);
        $response->assertStatus(200)->assertJson(['score' => 6]);
     }

      /**
     * Test scoring for a word not found in dictionary
     */

     public function testWordNotInDictionary(): void 
     {
        $response = $this->postJson('/api/word', ['word' => 'wqwqwqw']);
        $response->assertStatus(200)->assertJson(['error' => 'Word not found in dictionary']);
     }
    
}
