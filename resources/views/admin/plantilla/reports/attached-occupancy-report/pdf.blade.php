<!DOCTYPE html>
<html>

<head>
    <title>
        {{ $motherDepartmentAgency->acronym }}.pdf
    </title>

    {{-- custom css --}}
    <style>
        @font-face {
            font-family: "Busorama";
            src: url('{{ public_path(' fonts/busorama.ttf') }}');
            font-weight: normal;
            font-style: normal;
            font-stretch: normal;
        }

        .busorama {
            font-family: 'Busorama';
        }

        @page {
            margin-top: 75px;
            padding-bottom: 100px;
        }

        .pagenum:before {
            content: counter(page);
        }

        .page-break-always {
            page-break-after: always;
            margin-top: 160px;
        }

        footer {
            position: fixed;
            bottom: -40px;
            /* Adjust this value as needed */
            width: 100%;
            text-align: center;
            font-size: 10px;
        }


        section {
            padding: 10%;

        }

        .front-page {
            border-top: 8px solid #3b82f6;
            border-right: 8px solid grey;
            border-bottom: 8px solid #ef4444;
            border-left: 8px solid #eab308;
            width: auto;
            height: 80%;

        }

        .flex {
            display: flex;
            flex-direction: row;
            justify-content: center;
            /* Horizontally center items */
            align-items: center;
            /* Vertically center items */
        }

        .algerian {
            font-family: 'Algerian';
        }

        .font-arial-black {
            font-family: Arial;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .bold {
            font-weight: bold;
        }

        .p-5 {
            padding: 5%;
        }

        .pb-5 {
            padding-bottom: 5%;
        }

        .pb-3 {
            padding-bottom: 3%;
        }

        .p-10 {
            padding: 10%;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .w-100 {
            width: 100%;
        }

        .m-10 {
            margin: 10%
        }

        .mt-10 {
            margin-top: 10%
        }

        .mb-10 {
            margin-bottom: 10%
        }

        .mb-3 {
            margin-bottom: 3%
        }

        .mb-5 {
            margin-bottom: 5%
        }

        header {
            margin-bottom: 5%;
            margin-top: -7%;
        }

        .text-blue {
            color: #1F4E79;
        }

        .text-red {
            color: red;
        }

        .bg-blue {
            background: #1F4E79;
            color: #fff;
        }

        .bg-cyan {
            background: #93c5fd;
        }

        .bg-yellow {
            background: #fde047;
        }

        .bg-red {
            background: #fda4af;
            color: #000;
        }

        .bg-green {
            background: #bbf7d0;
            color: #000;
        }

        .italic {
            font-style: italic;
        }

        .pl-5 {
            padding-left: 5%;
        }

        .pl-10 {
            padding-left: 20%;
        }

        .pl-15 {
            padding-left: 30%;
        }

        td {
            border: 4px solid #fff;
            padding: 0 0 15px 5px;
        }
    </style>
    <style>
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, sans-serif;
            font-feature-settings: normal
        }

        body {
            margin: 0;
            line-height: inherit;
            font-size: small;
            counter-reset: page;
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::-webkit-backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .relative {
            position: relative
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .mx-6 {
            margin-left: 1.5rem;
            margin-right: 1.5rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-16 {
            margin-top: 4rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .mr-1 {
            margin-right: 0.25rem
        }

        .flex {
            display: flex
        }

        .inline-flex {
            display: inline-flex
        }

        .grid {
            display: grid
        }

        .h-16 {
            height: 4rem
        }

        .h-7 {
            height: 1.75rem
        }

        .h-6 {
            height: 1.5rem
        }

        .h-5 {
            height: 1.25rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-auto {
            width: auto
        }

        .w-16 {
            width: 4rem
        }

        .w-7 {
            width: 1.75rem
        }

        .w-6 {
            width: 1.5rem
        }

        .w-5 {
            width: 1.25rem
        }

        .max-w-7xl {
            max-width: 80rem
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .scale-100 {
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .gap-6 {
            gap: 1.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .self-center {
            align-self: center
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-full {
            border-radius: 9999px
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-red-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(254 242 242 / var(--tw-bg-opacity))
        }

        .bg-dots-darker {
            background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")
        }

        .from-gray-700\/50 {
            --tw-gradient-from: rgb(55 65 81 / 0.5);
            --tw-gradient-to: rgb(55 65 81 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-transparent {
            --tw-gradient-to: rgb(0 0 0 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to)
        }

        .bg-center {
            background-position: center
        }

        .stroke-red-500 {
            stroke: #ef4444
        }

        .stroke-gray-400 {
            stroke: #9ca3af
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .font-semibold {
            font-weight: 600
        }

        .leading-relaxed {
            line-height: 1.625
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-2xl {
            --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-gray-500\/20 {
            --tw-shadow-color: rgb(107 114 128 / 0.2);
            --tw-shadow: var(--tw-shadow-colored)
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .selection\:bg-red-500 *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-red-500::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-gray-900:hover {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .hover\:text-gray-700:hover {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .focus\:rounded-sm:focus {
            border-radius: 0.125rem
        }

        .focus\:outline:focus {
            outline-style: solid
        }

        .focus\:outline-2:focus {
            outline-width: 2px
        }

        .focus\:outline-red-500:focus {
            outline-color: #ef4444
        }

        .group:hover .group-hover\:stroke-gray-600 {
            stroke: #4b5563
        }

        @media (prefers-reduced-motion: no-preference) {
            .motion-safe\:hover\:scale-\[1\.01\]:hover {
                --tw-scale-x: 1.01;
                --tw-scale-y: 1.01;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity))
            }

            .dark\:bg-gray-800\/50 {
                background-color: rgb(31 41 55 / 0.5)
            }

            .dark\:bg-red-800\/20 {
                background-color: rgb(153 27 27 / 0.2)
            }

            .dark\:bg-dots-lighter {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")
            }

            .dark\:bg-gradient-to-bl {
                background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
            }

            .dark\:stroke-gray-600 {
                stroke: #4b5563
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:shadow-none {
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .dark\:ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .dark\:ring-inset {
                --tw-ring-inset: inset
            }

            .dark\:ring-white\/5 {
                --tw-ring-color: rgb(255 255 255 / 0.05)
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .group:hover .dark\:group-hover\:stroke-gray-400 {
                stroke: #9ca3af
            }
        }

        @media (min-width: 640px) {
            .sm\:fixed {
                position: fixed
            }

            .sm\:top-0 {
                top: 0px
            }

            .sm\:right-0 {
                right: 0px
            }

            .sm\:ml-0 {
                margin-left: 0px
            }

            .sm\:flex {
                display: flex
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-center {
                justify-content: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-8 {
                padding: 2rem
            }
        }
    </style>



</head>

<body>
    <table class="mb-3" width="100%">
        <td colspan="6">
            <h1 class="bold" style="font-size:12px">Career Executive Service Occupancy Report</h1>
            <div class="text-blue">
                <span class="bold uppercase">
                    {{ $motherDepartmentAgency->title }}
                </span>
                <span>(Attached)</span>
            </div>
            <h1 class="bold" style="font-size:12px">
                data as of
                {{ \Carbon\Carbon::parse($motherDepartmentAgency->lastupd_dt)->format('d F Y') }}
            </h1>
        </td>

        <td colspan="6" style="text-align: right">
            <h1 class="uppercase busorama text-blue" style="font-size: 18px;">CAREER EXECUTIVE SERVICE BOARD</h1>
            <h1 style="font-size: 9px">No. 3 Marcelino St., Holy Spirit Drive, Diliman, Quezon City 1127</h1>
            <h1 style="font-size: 9px">Tel. 8951-4981 to 88 Fax. 8931-5732 www.cesboard.gov.ph</h1>
        </td>
        <td colspan="1">
            <img src="{{ public_path('images/assets/branding.png') }}" width="70px" />
        </td>
    </table>

    <footer>
        <table width="100%">
            <tr>
                <td class="bold">
                    Date Printed {{ $currentDate }}
                </td>
                <td colspan="5">
                    CESB IIS-Generated Report |NOTE: Data from this report were sourced from the CES plantilla submitted
                    by the Agency.
                </td>

                <td>
                    <table>
                        <tr>
                            <td>Legend:</td>
                            <td>
                                <p
                                    style="border:1px solid gray; background:yellow; width:auto; padding: 5px;margin-bottom:2px">
                                </p>
                                <p style="border:1px solid gray; background:#84A1C6; width:auto; padding: 5px"></p>
                                <!-- <p style="border:1px solid gray; background:#84A1C6; width:auto">.</p> -->
                            </td>
                            <td>
                                <p>- Non-CES Eligible</p>
                                <p>- Vacant CES Position</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <div class="">Page <span class="pagenum"></span></div>
                </td>
            </tr>
        </table>
    </footer>

    <table width="100%" style="padding:10px; margin-bottom:10px">
        <thead>
            <tr style="font-size: 11px;">
                <th>AGENCY / POSITION</th>
                <th>SG</th>
                <th>ITEM NO.</th>
                <th>APPOINTEE</th>
                <th>APPOINTMENT DATE</th>
                <th>REMARKS</th>
                <th>OCCUPANT</th>
                <th>APPOINTMENT DATE</th>
                <th>REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalCount = 0;
            @endphp

            @foreach ($office as $officeDatas)
            @php
            $filteredPlanPositions = $officeDatas->planPosition
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1);
            @endphp


            @if($filteredPlanPositions->isNotEmpty())

            <tr style="font-size:11px">
                <td colspan="9" style="padding: 0 0;">
                    <h1 class="text-blue bold">
                        {{ $officeDatas->title }} ({{ $officeDatas->agencyLocation->departmentAgency->title ?? '' }})
                        {{-- data as of {{ $currentDate }} --}}
                    </h1>
                </td>
            </tr>

            @php
            $currentPosDefault = null;
            $count = 0;
            @endphp

            @foreach($planPosition as $planPositionDatas)
            @if($officeDatas->officeid == $planPositionDatas->officeid)

            @if($planPositionDatas->pos_default !== $currentPosDefault)
            {{-- @if($currentPosDefault !== null)
            <tr class="bold italic" style="font-size:11px">
                <td>
                    <h1>
                        {{ $currentPosDefault }}: {{ $count }}
                    </h1>
                </td>
            </tr>
            @endif --}}

            @php
            $currentPosDefault = $planPositionDatas->pos_default;
            $count = 1;
            @endphp

            @else

            @php
            $count++;
            @endphp

            @endif

            <tr style="font-size:11px;background:#e5e7eb;">
                <td>
                    <h1>
                        {{ $planPositionDatas->pos_default }}
                        <br />


                        @if($planPositionDatas->planAppointee
                        ->where('is_appointee', 1)
                        ->first()
                        ->planPosition
                        ->pos_suffix ?? '')


                        ({{ optional($planPositionDatas->planAppointee
                        ->where('is_appointee', 1)
                        ->first())
                        ->planPosition
                        ->pos_suffix ?? ''
                        }})
                        @endif


                    </h1>
                </td>
                <td>
                    <h1>
                        {{ $planPositionDatas->corp_sg }}
                    </h1>
                </td>
                <td>
                    <h1>
                        {{ $planPositionDatas->item_no }}
                    </h1>
                </td>
                <td style="
                                        @php
                                            $selectedAppointee = $planPositionDatas->planAppointee
                                                ->where('is_appointee', 1)
                                                ->first();

                                            if ($selectedAppointee &&
                                                $selectedAppointee->personalData &&
                                                $selectedAppointee->personalData->cesStatus &&
                                                (
                                                    Str::contains($selectedAppointee->personalData->cesStatus->description, '-') ||
                                                    Str::contains($selectedAppointee->personalData->cesStatus->description, 'CSEE')
                                                )
                                            ) {
                                                echo 'background: yellow;';
                                            }

                                            if(!$selectedAppointee){
                                                echo 'background: #84A1C6;';
                                                // if this executes I want to print 'VACANT with this background color'
                                            }
                                        @endphp
                                    ">

                    @if(!$selectedAppointee)
                    <h1>VACANT</h1>
                    @endif

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 1)
                    ->first())
                    ->personalData
                    ->lastname ?? ''
                    }}

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 1)
                    ->first())
                    ->personalData
                    ->firstname ?? ''
                    }}

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 1)
                    ->first())
                    ->personalData
                    ->name_extension ?? ''
                    }}

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 1)
                    ->first())
                    ->personalData
                    ->middlename ?? ''
                    }}

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 1)
                    ->first())
                    ->personalData
                    ->cesStatus->description ?? ''
                    }}

                </td>

                <td>
                    @php
                    $selectedAppointee = $planPositionDatas->planAppointee
                    ->where('is_appointee', 1)
                    ->first();
                    @endphp

                    @if($selectedAppointee->appt_date ?? '')
                    {{ \Carbon\Carbon::parse($selectedAppointee->appt_date)->format('d/m/Y') }}
                    @endif

                </td>
                <td>{{ $planPositionDatas->remarks ?? ''}}</td>

                <td style="
                                        @php
                                            $selectedAppointee = $planPositionDatas->planAppointee
                                                ->where('is_appointee', 0)
                                                ->first();

                                            if ($selectedAppointee &&
                                                $selectedAppointee->personalData &&
                                                $selectedAppointee->personalData->cesStatus &&
                                                (
                                                    Str::contains($selectedAppointee->personalData->cesStatus->description, '-') ||
                                                    Str::contains($selectedAppointee->personalData->cesStatus->description, 'CSEE')
                                                )
                                            ) {
                                                echo 'background: yellow;';
                                            }
                                        @endphp
                                    ">

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 0)
                    ->first())
                    ->personalData
                    ->lastname ?? ''
                    }}

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 0)
                    ->first())
                    ->personalData
                    ->firstname ?? ''
                    }}

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 0)
                    ->first())
                    ->personalData
                    ->middlename ?? ''
                    }}

                    {{ optional($planPositionDatas->planAppointee
                    ->where('is_appointee', 0)
                    ->first())
                    ->personalData
                    ->cesStatus->description ?? ''
                    }}
                </td>
                <td>
                    @php
                    $selectedOccupant = $planPositionDatas->planAppointee
                    ->where('is_appointee', 0)
                    ->first();
                    @endphp

                    @if ($selectedOccupant && $selectedOccupant->appt_date)
                    {{ \Carbon\Carbon::parse($selectedOccupant->appt_date)->format('d/m/Y') }}
                    @endif
                </td>
                <td>
                    <!-- {{ $planPositionDatas->cbasis_remarks ?? ''}} -->
                </td>
            </tr>

            @php
            $totalCount += $count;
            @endphp

            @endif
            @endforeach

            {{-- @if($currentPosDefault !== null)
            <tr class="bold italic" style="font-size:11px">
                <td>
                    <h1>
                        {{ $currentPosDefault }}: {{ $count }}
                    </h1>
                </td>
            </tr>
            @endif --}}

            @endif
            @endforeach

            <tr class="bold italic" style="font-size:11px">
                <td colspan="9">
                    <h1>
                        TOTAL NO. OF POSITIONS: {{ $totalPosition }}
                    </h1>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>