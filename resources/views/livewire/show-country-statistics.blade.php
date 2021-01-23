<select
    wire:model="country"
    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    @foreach($countries as $country)
        <option value="{{ $country }}">{{ $country }}</option>
    @endforeach
</select>

<hr class="p-1">

<div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
    <x-column name="Population" value="{{ $stats['population'] ?? '-' }}"></x-column>
    <x-column name="Country" value="{{ $stats['country'] ?? '-' }}"></x-column>
    <x-column name="Continent" value="{{ $stats['continent'] ?? '-' }}"></x-column>
    <x-column name="New Cases" value="{{ $stats['cases']['new'] ?? '-' }}"></x-column>
    <x-column name="Active Cases" value="{{ $stats['cases']['active'] ?? '-' }}"></x-column>
    <x-column name="Critical Cases" value="{{ $stats['cases']['critical'] ?? '-' }}"></x-column>
    <x-column name="Recovered" value="{{ $stats['cases']['recovered'] ?? '-' }}"></x-column>
    <x-column name="Total Cases" value="{{ $stats['cases']['total'] ?? '-' }}"></x-column>
    <x-column name="New Deaths" value="{{ $stats['deaths']['new'] ?? '-' }}"></x-column>
    <x-column name="Total Deaths" value="{{ $stats['deaths']['total'] ?? '-' }}"></x-column>
    <x-column name="Day" value="{{ $stats['day'] ?? '-' }}"></x-column>
</div>
