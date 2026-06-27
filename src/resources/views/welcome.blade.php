<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>

    @include('partials.loader')

    <div class="cursor-glow" id="cursor-glow"></div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    @include('partials.header')

    <canvas id="matrix-canvas"></canvas>

    <main>

        @include('partials.sections.hero')

        @include('partials.sections.skills')

        @include('partials.sections.experience')

        @include('partials.sections.projects')

        @include('partials.sections.organizations')

    </main>

    @include('partials.footer')

    @include('partials.scripts')

</body>
</html>
