
@extends('layouts.app')

@section('content')
    <div class="alert alert-danger">
        <strong> <p>{{ $message }}</p> :</strong> La connexion au serveur de messagerie a échoué.
    </div>
    <div class="alert alert-danger">
        <strong>L'enregistrement ou la Signature a tout de meme ete effectue avec succes</strong>.
    </div>
@endsection