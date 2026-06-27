#!/usr/bin/env python3
"""Split welcome.blade.php into partials for better maintainability."""

import os

SRC = '/root/perkuliahan/portofolio/src/resources/views'
BLADE = f'{SRC}/welcome.blade.php'
PARTIALS = f'{SRC}/partials'

# Read the full file
with open(BLADE, 'r', encoding='utf-8') as f:
    lines = f.readlines()

total = len(lines)
print(f"Total lines: {total}")

# Find key line boundaries
def find_line(needle, start=0):
    for i in range(start, len(lines)):
        if needle in lines[i]:
            return i
    return -1

head_end    = find_line('</head>')          # line after </head>
body_start  = find_line('<body>')
loader_end  = find_line('<!-- ═══════════════════════════════════════ -->')
header_end  = find_line('</header>')
main_start  = find_line('<main>')
about_start = find_line('<section id="about"')
about_end   = find_line('</section>', about_start + 1)
skills_start= find_line('<section id="skills"')
skills_end  = find_line('</section>', skills_start + 1)
exp_start   = find_line('<section id="experience"')
exp_end     = find_line('</section>', exp_start + 1)
proj_start  = find_line('<section id="projects"')
proj_end    = find_line('</section>', proj_start + 1)
org_start   = find_line('<section id="organizations"')
org_end     = find_line('</section>', org_start + 1)
main_end    = find_line('</main>')
footer_start= find_line('<footer>')
footer_end  = find_line('</footer>')
script1_start = find_line('<script>', footer_end)
body_end    = find_line('</body>')

print(f"head: 0-{head_end}")
print(f"body/loader: {body_start}-{loader_end}")
print(f"header: {body_start}-{header_end}")
print(f"about: {about_start}-{about_end}")
print(f"skills: {skills_start}-{skills_end}")
print(f"experience: {exp_start}-{exp_end}")
print(f"projects: {proj_start}-{proj_end}")
print(f"organizations: {org_start}-{org_end}")
print(f"footer: {footer_start}-{footer_end}")
print(f"scripts: {script1_start}-{body_end}")

os.makedirs(f'{PARTIALS}/sections', exist_ok=True)

def write_partial(path, content_lines):
    with open(path, 'w', encoding='utf-8') as f:
        f.writelines(content_lines)
    print(f"Written: {path} ({len(content_lines)} lines)")

# 1. head.blade.php — DOCTYPE + <head> block
write_partial(f'{PARTIALS}/head.blade.php',
    ['<!DOCTYPE html>\n', '<html lang="en">\n', '\n'] +
    lines[3:head_end + 1]   # <head> ... </head>
)

# 2. loader.blade.php — loading overlay
loader_start = find_line('<!-- ═══════════ LOADING SCREEN ═══════════ -->')
write_partial(f'{PARTIALS}/loader.blade.php',
    lines[loader_start:loader_end + 1]
)

# 3. header.blade.php — sticky nav
hdr_start = find_line('<header>')
write_partial(f'{PARTIALS}/header.blade.php',
    lines[hdr_start:header_end + 1]
)

# 4. sections/hero.blade.php
write_partial(f'{PARTIALS}/sections/hero.blade.php',
    ['        {{-- HERO --}}\n'] + lines[about_start:about_end + 1]
)

# 5. sections/skills.blade.php
write_partial(f'{PARTIALS}/sections/skills.blade.php',
    lines[skills_start:skills_end + 1]
)

# 6. sections/experience.blade.php
write_partial(f'{PARTIALS}/sections/experience.blade.php',
    lines[exp_start:exp_end + 1]
)

# 7. sections/projects.blade.php
write_partial(f'{PARTIALS}/sections/projects.blade.php',
    lines[proj_start:proj_end + 1]
)

# 8. sections/organizations.blade.php
write_partial(f'{PARTIALS}/sections/organizations.blade.php',
    lines[org_start:org_end + 1]
)

# 9. footer.blade.php — footer + lofi player + code widget
# includes everything between </main> and the first <script>
write_partial(f'{PARTIALS}/footer.blade.php',
    lines[main_end:script1_start]
)

# 10. scripts.blade.php — all script blocks
write_partial(f'{PARTIALS}/scripts.blade.php',
    lines[script1_start:body_end + 1]
)

# 11. Rewrite welcome.blade.php as clean layout shell
new_welcome = """\
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
"""

with open(BLADE, 'w', encoding='utf-8') as f:
    f.write(new_welcome)

print(f"\nwelcome.blade.php rewritten as layout shell ({len(new_welcome.splitlines())} lines)")
print("Done!")
