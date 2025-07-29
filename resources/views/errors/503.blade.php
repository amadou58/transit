@extends('layouts.app')

@section('content')
    <div class="container"></br>
        <div class="row justify-content-center p-6">
            <div class="col-md-8">
                <div class="alert alert-danger text-center" style="font-size: 24px;">
                    <strong>{{ __('Service Unavailable') }} :</strong> Le service que vous demandez n'est pas disponible pour le moment.
                </div>
                <div class="alert alert-danger text-center" style="font-size: 20px;">
                    <p>Cela peut être dû à une maintenance en cours ou à une surcharge temporaire du serveur. Veuillez réessayer plus tard.</p>
                    <p>Si le problème persiste, veuillez contacter le support technique.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
