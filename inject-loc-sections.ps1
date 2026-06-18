# inject-loc-sections.ps1
# Injects <?php include 'includes/loc-section.php'; ?> into every location page
# that does NOT already have it, inserting right after the About Us block.
#
# Run from: C:\xampp\htdocs\UX_Pacific\
# Usage:    .\inject-loc-sections.ps1
#           .\inject-loc-sections.ps1 -WhatIf   (dry run — shows what would change)

param(
    [switch]$WhatIf
)

$rootDir   = "C:\xampp\htdocs\UX_Pacific"
$files     = Get-ChildItem "$rootDir\ui-ux-design-agency-in-*.php" -File
$include   = "`n    <?php include 'includes/loc-section.php'; ?>`n"

# The anchor string present in every location page's About section
$anchor    = '<a class="view-more" href="/about"> View More &rarr; </a>' + "`r`n" + '      <br />' + "`r`n" + '    </div>'
$anchorLF  = '<a class="view-more" href="/about"> View More &rarr; </a>' + "`n" + '      <br />' + "`n" + '    </div>'

$marker    = "includes/loc-section.php"  # skip files that already have this

$updated   = 0
$skipped   = 0
$notFound  = 0

foreach ($file in $files) {

    $content = Get-Content $file.FullName -Raw -Encoding UTF8

    # Skip if already injected
    if ($content -like "*$marker*") {
        $skipped++
        continue
    }

    # Try CRLF anchor first, then LF
    if ($content.Contains($anchor)) {
        $newContent = $content.Replace($anchor, $anchor + $include)
        $matched    = $true
    } elseif ($content.Contains($anchorLF)) {
        $newContent = $content.Replace($anchorLF, $anchorLF + $include)
        $matched    = $true
    } else {
        $matched = $false
    }

    if (-not $matched) {
        $notFound++
        Write-Warning "Anchor not found in: $($file.Name)"
        continue
    }

    if ($WhatIf) {
        Write-Host "[DRY RUN] Would update: $($file.Name)"
    } else {
        Set-Content $file.FullName -Value $newContent -Encoding UTF8 -NoNewline
        Write-Host "Updated: $($file.Name)"
    }
    $updated++
}

Write-Host ""
Write-Host "========================================"
if ($WhatIf) {
    Write-Host "DRY RUN complete."
    Write-Host "  Would update : $updated"
} else {
    Write-Host "Injection complete."
    Write-Host "  Updated      : $updated"
}
Write-Host "  Already done : $skipped"
Write-Host "  Anchor miss  : $notFound"
Write-Host "========================================"
