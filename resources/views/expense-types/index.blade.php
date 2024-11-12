<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Expense Types') }}
            </h2>
            <a href="{{ route('expense-types.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                {{ __('Create New') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-alerts />
                <!--
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($expenseTypes as $expenseType)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $expenseType->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $expenseType->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                    <!-- start -->
                                    <a href="{{ route('expense-types.show', $expenseType) }}" 
                                        class="inline-flex px-2 py-1 rounded-md text-white bg-gray-500 hover:bg-gray-700 mr-2">
                                        View
                                    </a>
                                    <a href="{{ route('expense-types.edit', $expenseType) }}" 
                                        style="display: inline-flex; padding: 0.25rem 0.5rem; border-radius: 0.375rem; color: white; background-color: rgb(99 102 241); margin-right: 0.5rem;">
                                        Edit
                                    </a>
                                    <form action="{{ route('expense-types.destroy', $expenseType) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            style="display: inline-flex; padding: 0.25rem 0.5rem; border-radius: 0.375rem; color: white; background-color: rgb(239 68 68);"
                                            onclick="return confirm('Are you sure you want to delete this expense type?')">
                                            Delete
                                        </button>
                                    </form>
                                    <!-- end -->

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        No expense types found
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