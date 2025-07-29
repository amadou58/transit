@extends('layouts.app')

@section('content')
<style>
    body{
        margin: 0;
        padding: 0;
       
    }

.dispach {
    background-image: url('/storage/fond/logo.jpg');
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    backdrop-filter: blur(10px);
    width: 100%;
    height: auto;
    aspect-ratio: 1080 / 801; /* ✅ Respecte le ratio de ton image */
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}


    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        pointer-events: none;
    }

    h1 {
        font-size: 4em; /* Ajuste la taille du texte */
    }
</style>

<div class="dispach">
    <div class="overlay"></div>
</div>
@endsection
