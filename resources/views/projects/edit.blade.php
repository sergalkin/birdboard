@extends ('layouts.app')

@section('content')
    <form method="POST" action="{{ $project->path() }}" class="lg:w-1/2 lg:mx-auto bg-white py-12 px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">Edit Your Project</h1>
        @method('PATCH')
        @include('projects._form', ['buttonText' => 'Edit Project'])
    </form>
@endsection