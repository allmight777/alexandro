@extends('employee.homedash')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4 text-primary fw-bold">Demande d’Aide</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border rounded p-4 bg-light">
        <form action="{{ route('send.aide') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="message" class="form-label fw-semibold">Décrivez votre problème</label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                @error('message') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="mdi mdi-send"></i> Envoyer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
