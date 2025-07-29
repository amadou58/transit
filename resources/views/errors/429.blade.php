@extends('layouts.app')

@section('content')
    <div class="container"></br>
        <div class="row justify-content-center p-6">
            <div class="col-md-8">
                <div class="alert alert-warning text-center" style="font-size: 24px;">
                    <strong>{{ __('Too Many Requests') }} :</strong> Vous avez émis trop de requêtes en un court laps de temps.
                </div>
                <div class="alert alert-warning text-center" style="font-size: 20px;">
                    <p>Veuillez attendre un moment avant de faire de nouvelles requêtes.</p>
                    <p>Si le problème persiste, veuillez vérifier votre fréquence de requêtes ou contactez le support.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
