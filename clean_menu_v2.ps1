$path = "resources/views/user/landing_page/menu.blade.php"
$lines = Get-Content $path
$newLines = @()
$skip = $false
foreach ($line in $lines) {
    if ($line -like "<<<<<<<*") { continue }
    if ($line -like "=======*") { $skip = $true; continue }
    if ($line -like ">>>>>>>*") { $skip = $false; continue }
    if (-not $skip) {
        $newLines += $line
    }
}
$newLines | Set-Content $path
