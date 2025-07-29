@extends('layouts.app')

@section('content')
    <div class="container"></br>
        <div class="row justify-content-center p-6">
            <div class="col-md-8">
                <div class="alert alert-danger text-center" style="font-size: 24px;">
                    <strong>{{ __('Not Found') }} :</strong> La page que vous recherchez n'a pas été trouvée.
                </div>
                <div class="alert alert-danger text-center" style="font-size: 20px;">
                    <p>La ressource que vous essayez d'accéder peut avoir été déplacée ou supprimée, ou l'URL que vous avez saisie est incorrecte.</p>
                    <p>Veuillez vérifier l'URL.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
