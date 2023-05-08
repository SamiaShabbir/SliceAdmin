<head>
    <link rel="stylesheet" href="{{ asset('css/breadcrumb.css') }}">

</head>

<body>
    <div class="row22">
        @unless ($breadcrumbs->isEmpty())
            <ul class="breadcrumb" style=" width:10%; margin-left:25%;">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (!is_null($breadcrumb->url) && !$loop->last)
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}
                            </a></li>
                    @else
                        <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
            </ul>
        @endunless
    </div>

</body>
