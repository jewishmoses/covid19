<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_is_ok()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSeeLivewire('show-country-statistics');
    }

    public function test_default_country_is_israel()
    {
        Livewire::test('show-country-statistics')
            ->assertSet('country', 'Israel');
    }

    public function test_redirect_on_country_change_is_working()
    {
        Livewire::test('show-country-statistics')
            ->set('country', 'USA')
            ->call('updatedCountry')
            ->assertRedirect();
    }

    public function test_can_not_enter_fake_country()
    {

    }

    public function test_stats_are_being_cached()
    {

    }

    public function test_stats_are_displayed()
    {
         $stats = $this->getStats();

         $this->get('/')
            ->assertSee($stats['continent'])
            ->assertSee($stats['country'])
            ->assertSee($stats['population'])
            ->assertSee($stats['cases']['new'])
            ->assertSee($stats['cases']['active'])
            ->assertSee($stats['cases']['critical'])
            ->assertSee($stats['cases']['recovered'])
            ->assertSee($stats['deaths']['new'])
            ->assertSee($stats['deaths']['total'])
            ->assertSee($stats['day']);
    }

    protected function getStats()
    {
        $headers = [
            'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
            'x-rapidapi-key' => config('app.rapid_api_key')
        ];

        $response = Http::withHeaders($headers)
            ->get('https://covid-193.p.rapidapi.com/statistics')
            ->json()['response'];

        return collect($response)
            ->firstWhere('country', 'Israel');
    }
}
