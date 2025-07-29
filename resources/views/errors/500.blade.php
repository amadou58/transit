@extends('layouts.app')

@section('content')
    <div class="container"></br>
        <div class="row justify-content-center p-6">
            <div class="col-md-8">
                <div class="alert alert-danger text-center" style="font-size: 24px;">
                    <strong>{{ __('Server Error') }} :</strong> La connexion au serveur de messagerie a échoué lors de l'envoi du mail.
                </div>
                <div class="alert alert-danger text-center" style="font-size: 20px;">
                    <strong>L'enregistrement ou la Signature a tout de même été effectué avec succès</strong>.
                </div>
            </div>
        </div>
    </div>
@endsection
