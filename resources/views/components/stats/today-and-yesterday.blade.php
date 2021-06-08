<div class="mt-6">
    <div class="relative">
        <dl class="rounded bg-white shadow sm:grid sm:grid-cols-2">
            <div class="flex flex-col border-b border-gray-100 px-6 text-center sm:border-0 sm:border-r" style="padding: 60px 24px !important">
                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                    Total Opens
                </dt>
                <dd class="order-1 text-5xl font-extrabold text-600" style="color: #ee6401 !important">
                    {{ is_numeric(optional($data['total_opens'])['total_count']) ? number_format($data['total_opens']['total_count']) : 0}}
                </dd>
            </div>
            <div class="flex flex-col border-t border-b border-gray-100 px-6 text-center sm:border-0 sm:border-l sm:border-r" style="padding: 60px 24px !important">
                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                    Unique Opens
                </dt>
                <dd class="order-1 text-5xl font-extrabold text-600" style="color: #ee6401 !important">
                    {{is_numeric(optional($data['total_opens'])['unique_count']) ? number_format($data['total_opens']['unique_count']) : 0}}
                </dd>
            </div>
        </dl>
    </div>
    <div class="mt-6 p-6 rounded bg-white shadow">
        <h3 class="order-1 text-xl font-extrabold text-cool-gray-600 text-center mb-3">
            Brand Opens
        </h3>
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="BrandSortBy('name')" :direction="$brand_sort_field === 'name' ? $brand_sort_direction : null"><span style="font-size: 14px !important; font-weight: bolder !important;">Name</span></x-table.heading>
                <x-table.heading sortable wire:click="BrandSortBy('total_count')" :direction="$brand_sort_field === 'total_count' ? $brand_sort_direction : null"><span style="font-size: 14px !important; font-weight: bolder !important;">Total Opens</span></x-table.heading>
                <x-table.heading sortable wire:click="BrandSortBy('unique_count')" :direction="$brand_sort_field === 'unique_count' ? $brand_sort_direction : null"><span style="font-size: 14px !important; font-weight: bolder !important;">Unique Opens</span></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($data['brand_opens'] as $brand_open)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $brand_open['id'] }}">
                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <p class="text-cool-gray-600">
                                    {{ $brand_open['name'] }}
                                </p>
                            </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <p class="text-cool-gray-600">
                                    {{ is_numeric($brand_open['total_count']) ? number_format($brand_open['total_count']) : 0 }}
                                </p>
                            </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <p class="text-cool-gray-600">
                                    {{ is_numeric($brand_open['unique_count']) ? number_format($brand_open['unique_count']) : 0 }}
                                </p>
                            </span>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>
    <div class="mt-6 p-6 rounded bg-white shadow">
        <h3 class="order-1 text-xl font-extrabold text-cool-gray-600 text-center">
            Contact List Opens
        </h3>
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="ContactListSortBy('name')" :direction="$contact_list_sort_field === 'name' ? $contact_list_sort_direction : null"><span style="font-size: 14px !important; font-weight: bolder !important;">Name</span></x-table.heading>
                <x-table.heading sortable wire:click="ContactListSortBy('total_count')" :direction="$contact_list_sort_field === 'total_count' ? $contact_list_sort_direction : null"><span style="font-size: 14px !important; font-weight: bolder !important;">Total Opens</span></x-table.heading>
                <x-table.heading sortable wire:click="ContactListSortBy('unique_count')" :direction="$contact_list_sort_field === 'unique_count' ? $contact_list_sort_direction : null"><span style="font-size: 14px !important; font-weight: bolder !important;">Unique Opens</span></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($data['contact_list_opens'] as $contact_list_open)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $contact_list_open['id'] }}">
                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <p class="text-cool-gray-600">
                                    {{ $contact_list_open['name'] }}
                                </p>
                            </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <p class="text-cool-gray-600">
                                    {{ is_numeric($contact_list_open['total_count']) ? number_format($contact_list_open['total_count']) : 0 }}
                                </p>
                            </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <p class="text-cool-gray-600">
                                    {{ is_numeric($contact_list_open['unique_count']) ? number_format($contact_list_open['unique_count']) : 0 }}
                                </p>
                            </span>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>
</div>
