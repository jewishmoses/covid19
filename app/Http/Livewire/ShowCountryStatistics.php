<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowCountryStatistics extends Component
{
    public $country = 'Israel';
    public $stats;
    protected $countries;

    protected $queryString = [
        'country' => ['except' => ''],
    ];

    public function mount()
    {
        $this->countries = $this->getCountries();

        if(!in_array($this->country, $this->countries)) {
            return redirect()->route('home');
        }

        $this->stats = $this->getCountryStats();
    }

    protected function getCountryStats()
    {
        $statistics = Cache::remember('statistics', now()->addDay(), function () {

            $headers = [
                'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
                'x-rapidapi-key' => config('app.rapid_api_key')
            ];

            return Http::withHeaders($headers)
                ->get('https://covid-193.p.rapidapi.com/statistics')
                ->json()['response'];
        });

        return collect($statistics)
            ->firstWhere('country', $this->country);
    }

    public function updatedCountry()
    {
        return redirect()->route('home', ['country' => $this->country]);
    }

    public function render()
    {
        return view('livewire.show-country-statistics', [
            'countries' => $this->countries,
        ]);
    }

    protected function getCountries()
    {
        return Cache::remember('countries', now()->addDay(), function () {

            $headers = [
                'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
                'x-rapidapi-key' => config('app.rapid_api_key'),
                'useQueryString' => true,
            ];

            $response = Http::withHeaders($headers)
                ->get('https://covid-193.p.rapidapi.com/countries');

            return $response->json()['response'];

        });
    }
}
