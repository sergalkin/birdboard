<!DOCTYPE html>

<html>
<head>
    <title></title>
</head>
<body>
<h1>Birdboard</h1>
<ul>
    @forelse($projects as $project)
        <li>
            <a href="{{ $project->path() }}">
                {{ $project->title }}
            </a>
        </li>
    @empty
        <li>No Projects yet.</li>
    @endforelse
</ul>
</body>
</html>