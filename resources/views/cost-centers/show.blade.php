<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cost Center Details') }}
            </h2>
            <a href="{{ route('cost-centers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Code') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $costCenter->code }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Name') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $costCenter->name }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Created At') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $costCenter->created_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('cost-centers.edit', $costCenter) }}" 
                            class="inline-flex px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 mr-2">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('cost-centers.destroy', $costCenter) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                                onclick="return confirm('Are you sure you want to delete this cost center?')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>