<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowCountryStatistics extends Component
{
    public $country = 'Israel';
    protected $queryString = [
        'country' => ['except' => ''],
    ];
    public $statistics;

    public function mount()
    {
        $this->statistics = $this->getCountryStats();
    }

    public function updatedCountry($value)
    {
        $this->country = $value;
        $this->statistics = $this->getCountryStats();
    }

    public function render()
    {
        return view('livewire.show-country-statistics', [
            'countries' => $this->getCountries(),
        ]);
    }

    public function getCountries()
    {
        // add cache
        $headers = [
            'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
            'x-rapidapi-key' => config('app.rapid_api_key'),
            'useQueryString' => true,
        ];
        $response = Http::withHeaders($headers)->get('https://covid-193.p.rapidapi.com/countries');
        return $response->json()['response'];
    }

    protected function getCountryStats()
    {
        // add cache
        $headers = [
            'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
            'x-rapidapi-key' => config('app.rapid_api_key')
        ];
        $response = Http::withHeaders($headers)->get('https://covid-193.p.rapidapi.com/statistics');
        return collect($response->json()['response'])->firstWhere('country', $this->country);
    }
}
