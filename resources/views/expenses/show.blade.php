<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Expense Details') }}
            </h2>
            <a href="{{ route('expenses.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
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
                            {{ __('Date') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expense->date }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Spender') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expense->user->name }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Expense Type') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expense->expenseType->name }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Cost Center') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expense->costCenter->name }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Invoice') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expense->invoice }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Amount') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            ${{ number_format($expense->amount, 2) }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Notes') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expense->notes ?? 'No notes available' }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Created At') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $expense->created_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('expenses.edit', $expense) }}" 
                            class="inline-flex px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 mr-2">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                                onclick="return confirm('Are you sure you want to delete this expense?')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>