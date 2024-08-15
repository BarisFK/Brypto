@extends('layouts.app')

@section('title', 'Cards')

@section('contents')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-3 gap-4">
    @foreach ($cards as $card)
        <div
            class="bg-gradient-to-r from-green-500 to-green-800 hover:from-green-400 hover:to-green-600 text-white p-4 rounded-lg shadow-lg flex flex-col items-start justify-between h-48 w-96 relative">

            <div class="absolute top-2 right-2 flex space-x-2"> 
                <button class="text-white hover:text-gray-300 focus:outline-none"
                    onclick="toggleCardNumber('{{ $card->id }}')">
                    <i class="bi bi-eye"></i>
                </button>

                <button class="text-white hover:text-red-500 focus:outline-none"
                    onclick="confirmDelete('{{ $card->id }}', '{{ route('cardsDelete', $card->id) }}')">
                    <i class="bi bi-trash"></i>
                </button>
            </div>

            <div class="flex items-center">
                <i class="bi bi-bank"></i>
                <span class="font-mono text-lg tracking-widest ml-3" id="card-number-{{ $card->id }}">
                    {{$card->title}}
                </span>
            </div>
            <div class="flex items-center w-full">
                <div class="flex items-center">
                    <span class="font-mono text-lg tracking-widest" id="card-number-{{ $card->id }}">
                        {{ Str::mask($card->card_no, '*', 4, 12) }}
                    </span>
                    <button class="ml-2 bi bi-clipboard text-white hover:text-gray-300 hidden"
                        id="copy-icon-{{ $card->id }}" onclick="copyCardNumber('{{ $card->card_no }}')"></button>
                </div>

                <div class="ml-auto">
                    <span id="cvv-{{ $card->id }}" class="hidden">{{ $card->cvv }}</span>
                    <span>{{ Str::mask($card->card_cvv, '*', 1, 2) }}</span>
                </div>
            </div>

            <div class="flex justify-between w-full mt-4 text-sm">
                <div>
                    <span class="block font-semibold uppercase">Card Holder</span>
                    <span class="text-sm">{{ $card->card_owner }}</span>
                </div>
                <div class="text-right">
                    <span class="block font-semibold uppercase">Expires</span>
                    <span>{{ $card->expiry_month }}/{{ $card->expiry_year }}</span>
                </div>
            </div>
        </div>
        <form id="delete-form-{{ $card->id }}" action="{{ route('cardsDelete', $card->id) }}" method="POST"
            style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
    <script>
        function toggleCardNumber(cardId) {
            const cardNumberSpan = document.getElementById(`card-number-${cardId}`);
            const copyIcon = document.getElementById(`copy-icon-${cardId}`);
            const isMasked = cardNumberSpan.textContent.includes('*');

            if (isMasked) {
                // Show the card number
                @foreach ($cards as $c)
                    if ('{{ $c->id }}' === cardId) {
                        cardNumberSpan.textContent = '{{ $c->card_no }}';
                    }
                @endforeach
                copyIcon.classList.remove('hidden');
            } else {
                // Mask the card number
                @foreach ($cards as $c)
                    if ('{{ $c->id }}' === cardId) {
                        cardNumberSpan.textContent = '{{ Str::mask($c->card_no, '*', 4, 12) }}';
                    }
                @endforeach
                copyIcon.classList.add('hidden');
            }
        }

        function copyCardNumber(cardNumber) {
            navigator.clipboard.writeText(cardNumber).then(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Card number copied!',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
            });
        }
        function confirmDelete(cardId, deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${cardId}`).submit();
                    Swal.fire({
                        toast: true,
                        position: 'bottom-start',
                        icon: 'success',
                        title: 'Card deleted!',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                    });
                }
            });
        }
    </script>


    <div class="bg-green-600 hover:bg-green-500 text-white p-6 rounded-lg flex items-center justify-center text-5xl font-semibold h-48 w-96 cursor-pointer"
        data-modal-target="cardModal">
        +
    </div>

    <div id="cardModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>

            <div
                class="inline-block align-bottom bg-white rounded-lg px-6 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-semibold">Add New Card</h2>
                    <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('cardsAdd') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="cardTitle" class="block text-sm font-medium text-gray-700">Card Title</label>
                        <input type="text" id="cardTitle" name="title" class="mt-1 p-2 border rounded-md w-full"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="cardOwner" class="block text-sm font-medium text-gray-700">Card Owner</label>
                            <input type="text" id="cardOwner" name="card_owner"
                                class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="cardNo" class="block text-sm font-medium text-gray-700">Card Number</label>
                            <input type="text" id="cardNo" name="card_no" class="mt-1 p-2 border rounded-md w-full"
                                inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number"
                                placeholder="xxxx xxxx xxxx xxxx" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <div>
                            <label for="cardCvv" class="block text-sm font-medium text-gray-700">CVV</label>
                            <input type="text" id="cardCvv" name="card_cvv" class="mt-1 p-2 border rounded-md w-full"
                                inputmode="numeric" pattern="[0-9]{3,4}" autocomplete="cc-csc" required>
                        </div>
                        <div>
                            <label for="expiryMonth" class="block text-sm font-medium text-gray-700">Expiry
                                Month</label>
                            <input type="text" id="expiryMonth" name="expiry_month"
                                class="mt-1 p-2 border rounded-md w-full" inputmode="numeric" pattern="[0-9]{2}"
                                placeholder="MM" required>
                        </div>
                        <div>
                            <label for="expiryYear" class="block text-sm font-medium text-gray-700">Expiry Year</label>
                            <input type="text" id="expiryYear" name="expiry_year"
                                class="mt-1 p-2 border rounded-md w-full" inputmode="numeric" pattern="[0-9]{2,4}"
                                placeholder="YY" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Add Card
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    const modalTrigger = document.querySelector('[data-modal-target="cardModal"]');
    const modal = document.getElementById('cardModal');
    const modalOverlay = document.querySelector('.fixed.inset-0.bg-gray-500'); // Select the overlay

    modalTrigger.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    function closeModal() {
        modal.classList.add('hidden');
    }

    modalOverlay.addEventListener('click', closeModal); // Close on overlay click
</script>
@endsection