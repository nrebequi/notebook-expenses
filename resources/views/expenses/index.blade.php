<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Expenses') }}
            </h2>
            <a href="{{ route('expenses.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                {{ __('Create New') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-alerts />

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spender</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost Center</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($expenses as $expense)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $expense->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $expense->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $expense->expenseType->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $expense->costCenter->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $expense->invoice }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($expense->amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('expenses.show', $expense) }}" 
                                            class="inline-flex px-2 py-1 rounded-md text-white bg-gray-500 hover:bg-gray-700 mr-2">
                                            View
                                        </a>
                                        <a href="{{ route('expenses.edit', $expense) }}" 
                                            style="display: inline-flex; padding: 0.25rem 0.5rem; border-radius: 0.375rem; color: white; background-color: rgb(99 102 241); margin-right: 0.5rem;">
                                            Edit
                                        </a>
                                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                style="display: inline-flex; padding: 0.25rem 0.5rem; border-radius: 0.375rem; color: white; background-color: rgb(239 68 68);"
                                                onclick="return confirm('Are you sure you want to delete this expense?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No expenses found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>