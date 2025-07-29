
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dispach" style="background-image: url('/storage/logo/');backdrop-filter: blur(10px);">
        <div>
            {{ $logo }}
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <style>
    .dispach {
            background-image: url('/storage/fond/logo.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            backdrop-filter: blur(10px);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: black;
            margin: 0; /* Supprime toute marge qui pourrait être présente par défaut */
        }
    </style>