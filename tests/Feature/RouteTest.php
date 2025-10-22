<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /** @test */
    public function la_page_accueil_fonctionne_en_francais()
    {
        // Simule une visite sur la page d'accueil
        $response = $this->get('/');
        
        // Vérifie que la page répond avec succès (code 200)
        $response->assertStatus(200);
        
        // Vérifie qu'un texte spécifique est présent
        $response->assertSee('Space ');
    }

    /** @test */
public function la_page_accueil_en_anglais()
{
    // Définir la locale en anglais
    app()->setLocale('en');
    
    $response = $this->get('/');
    $response->assertStatus(200);
    
    // Vérifier du contenu en anglais
    $response->assertSee('So, you want to travel to'); // Texte anglais
    $response->assertSee('EXPLORE'); // Bouton en anglais
}
    
    /** @test */
    public function la_page_destination_fonctionne()
    {
        $response = $this->get('destination');
        $response->assertStatus(200);
    }
    
    /** @test */
    public function la_page_equipage_fonctionne()
    {
        $response = $this->get('equipage');
        $response->assertStatus(200);
    }
    
    /** @test */
    public function la_page_technologie_fonctionne()
    {
        $response = $this->get('technologie');
        $response->assertStatus(200);
    }
    
    /** @test */
    public function une_page_inexistante_retourne_404()
    {
        $response = $this->get('/page-qui-nexiste-pas');
        $response->assertStatus(404);
    }
    /** @test */
public function destination_en_francais()
{
    // Définir la locale en français
    app()->setLocale('fr');
    
    $response = $this->get('destination');
    $response->assertStatus(200);
    $response->assertSee('destination'); 
}
public function destination_en_anglais()
{
    // Définir la locale en français
    app()->setLocale('en');
    
    $response = $this->get('destination');
    $response->assertStatus(200);
    $response->assertSee('destination'); 
}

public function equipage_en_francais()
{
    // Définir la locale en français
    app()->setLocale('fr');
    
    $response = $this->get('equipage');
    $response->assertStatus(200);
    $response->assertSee('equipage'); 
}

public function equipage_en_anglais()
{
    // Définir la locale en français
    app()->setLocale('en');
    
    $response = $this->get('equipage');
    $response->assertStatus(200);
    $response->assertSee('equipage'); 
}

public function technologie_en_francais()
{
    // Définir la locale en français
    app()->setLocale('fr');
    
    $response = $this->get('technologie');
    $response->assertStatus(200);
    $response->assertSee('technologie'); 
}
public function technologie_en_anglais()
{
    // Définir la locale en anglais
    app()->setLocale('en');
    
    $response = $this->get('technologie');
    $response->assertStatus(200);
    $response->assertSee('technologie'); 
}



/** @test */
public function le_changement_de_langue_fonctionne()
{
    // Simuler un changement de langue via une route
    $response = $this->get('/lang/en');
    $response->assertRedirect(); // Vérifie la redirection
    $this->assertEquals('en', session('locale')); // Vérifie que la session est mise à jour
}
}