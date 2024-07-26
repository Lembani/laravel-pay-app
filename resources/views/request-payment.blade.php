<!DOCTYPE html>
<html>
<head>
    <title>Request Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Request Payment</h2>
        @if (isset($response))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                <strong>Success!</strong> {{ json_encode($response) }}
            </div>
        @elseif (isset($error))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <strong>Error!</strong> {{ $error }}
            </div>
        @endif
        <form method="POST" action="/request-payment">
            @csrf
            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Amount:</label>
                <input type="number" id="amount" name="amount" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('amount') }}">
                @error('amount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Request Payment</button>
            </div>
        </form>
    </div>
</body>
</html>
