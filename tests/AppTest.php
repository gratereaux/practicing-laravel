<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Hola Mundo!');
    }

    public function testAdminLoginAccess(){

        $credentials = ['username' => 'jose', 
                        'password' => '11121980',
                        '_token' => csrf_token()];

        $response = $this->call('POST', '/admin/login', $credentials);
        //$this->assertEquals(302, $response->getStatusCode());
        $this->assertResponseStatus(302);
        $this->visit('/admin/practicantes')->see('Listado de practicantes');
    

    }

    public function testPublicApi_Categories(){

        $categories = json_decode($this->call('GET', '/api/categories')->getContent());

        $this->assertResponseOk();
        $this->assertObjectHasAttribute('name', $categories[0]);
    }

    public function testPrivateApi_NotLogin_Practicantes(){

        $response = $this->call('GET', '/api/practicantes');
        $this->assertResponseStatus(401);
    }
}
