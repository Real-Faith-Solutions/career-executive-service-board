<script src="https://cdn.tailwindcss.com"></script>
{{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<style type="text/tailwindcss">
    @layer utilities {
        .btn {
            @apply items-center py-2 px-4 uppercase tracking-widest text-sm hover:opacity-80 rounded;
        }
        .btn-primary {
            @apply bg-blue-500 text-white;
        }
        .btn-secondary {
            @apply bg-transparent text-slate-500 border border-slate-500;
        }
        .btn-danger {
            @apply bg-red-500 text-white;
        }
        label {
            @apply block mb-2 text-sm font-medium text-gray-900;
        }
        input, select, textarea {
            @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5;
        }
        input[type="checkbox"] {
            @apply ml-2 text-sm font-medium text-gray-900;
        }
        .card {
            @apply overflow-hidden shadow-sm rounded-lg p-6 text-slate-500 mb-3;
        }

        input.invalid {
            @apply rounded w-full text-red-700 focus:outline-none border-b-4 border-red-300 focus:border-purple-600 transition duration-500 px-3 pb-3
        rounded w-full text-red-700 focus:outline-none border-b-4 border-red-300 focus:border-purple-600 transition duration-500 px-3 pb-3;
        }
        span.invalid {
            @apply text-red-500 text-sm;
        }
        sup{
            @apply text-red-500;
        }
        span.success{
            @apply bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded;
        }
        span.danger{
            @apply bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded;
        }
    }
</style>