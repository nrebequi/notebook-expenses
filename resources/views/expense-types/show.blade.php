<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Expense Type Details') }}
            </h2>
            <a href="{{ route('expense-types.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
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
                            {{ $expenseType->code }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Name') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expenseType->name }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Created At') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expenseType->created_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('expense-types.edit', $expenseType) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 mr-2">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('expense-types.destroy', $expenseType) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this expense type?')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>