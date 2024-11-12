<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Expense') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('expenses.update', $expense) }}">
                        @csrf
                        @method('PUT')

                        <!-- Date -->
                        <div class="mb-4">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" class="block mt-1 w-48" 
                                type="date" 
                                name="date" 
                                :value="old('date', $expense->date)" 
                                required 
                                autofocus />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <!-- Expense Type -->
                        <div class="mb-4">
                            <x-input-label for="expense_type_id" :value="__('Expense Type')" />
                            <select id="expense_type_id" 
                                name="expense_type_id" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Expense Type</option>
                                @foreach($expenseTypes as $type)
                                    <option value="{{ $type->id }}" 
                                        {{ (old('expense_type_id', $expense->expense_type_id) == $type->id) ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('expense_type_id')" class="mt-2" />
                        </div>

                        <!-- Cost Center -->
                        <div class="mb-4">
                            <x-input-label for="cost_center_id" :value="__('Cost Center')" />
                            <select id="cost_center_id" 
                                name="cost_center_id" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Cost Center</option>
                                @foreach($costCenters as $center)
                                    <option value="{{ $center->id }}" 
                                        {{ (old('cost_center_id', $expense->cost_center_id) == $center->id) ? 'selected' : '' }}>
                                        {{ $center->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('cost_center_id')" class="mt-2" />
                        </div>

                        <!-- Invoice -->
                        <div class="mb-4">
                            <x-input-label for="invoice" :value="__('Invoice')" />
                            <x-text-input id="invoice" class="block mt-1 w-full" 
                                type="text" 
                                name="invoice" 
                                :value="old('invoice', $expense->invoice)" 
                                required 
                                maxlength="20" />
                            <x-input-error :messages="$errors->get('invoice')" class="mt-2" />
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" class="block mt-1 w-48" 
                                type="text" 
                                name="amount" 
                                :value="old('amount', number_format($expense->amount, 2, '.', ','))" 
                                required 
                                inputmode="numeric"
                                placeholder="0.00" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" 
                                name="notes" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                rows="4">{{ old('notes', $expense->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('expenses.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const amountInput = document.getElementById('amount');
            IMask(amountInput, {
                mask: Number,
                scale: 2,
                thousandsSeparator: ',',
                padFractionalZeros: true,
                normalizeZeros: true,
                radix: '.',
                mapToRadix: ['.', ',']
            });
        });
    </script>
    @endpush

</x-app-layout>