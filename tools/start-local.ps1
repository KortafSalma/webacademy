param(
    [switch]$NoBrowser,
    [switch]$CheckOnly
)

$ErrorActionPreference = 'Stop'
$projectRoot = Split-Path -Parent $PSScriptRoot
Set-Location -LiteralPath $projectRoot
$serverProcess = $null

function Test-WebAcademy([string]$Address) {
    try {
        $response = Invoke-WebRequest -Uri $Address -UseBasicParsing -TimeoutSec 2
        return $response.StatusCode -eq 200 -and
            $response.Headers['X-Request-ID'] -and
            $response.Content.Contains('id="wa-app"') -and
            $response.Content.Contains('WebAcademy')
    } catch { return $false }
}

try {
    Write-Host 'WebAcademy - demarrage automatique' -ForegroundColor Cyan
    Write-Host 'Le serveur PHP sert le backend et le frontend. Aucun npm a lancer.'

    $candidates = @()
    $phpCommand = Get-Command php.exe -ErrorAction SilentlyContinue
    if ($phpCommand) { $candidates += $phpCommand.Source }
    foreach ($base in @('C:\wamp64\bin\php', 'C:\wamp\bin\php')) {
        if (Test-Path -LiteralPath $base) {
            $candidates += Get-ChildItem -LiteralPath $base -Directory |
                Where-Object { $_.Name -match '^php\d+\.\d+\.\d+$' } |
                Sort-Object { [version]($_.Name.Substring(3)) } -Descending |
                ForEach-Object { Join-Path $_.FullName 'php.exe' }
        }
    }
    $candidates += 'C:\xampp\php\php.exe'
    $phpExecutable = $null
    foreach ($candidate in ($candidates | Select-Object -Unique)) {
        if (!(Test-Path -LiteralPath $candidate)) { continue }
        try {
            $runtimeCheck = & $candidate -r "exit(PHP_VERSION_ID >= 80100 && extension_loaded('pdo_sqlite') && extension_loaded('mbstring') && function_exists('proc_open') ? 0 : 1);" 2>&1
            if ($LASTEXITCODE -eq 0) { $phpExecutable = $candidate; break }
        } catch { continue }
    }
    if (!$phpExecutable) {
        throw 'PHP 8.1+ avec pdo_sqlite, mbstring et proc_open est requis. Verifiez votre installation WAMP/XAMPP.'
    }
    Write-Host "PHP : $phpExecutable"
    if (!(Test-Path -LiteralPath (Join-Path $projectRoot 'public\router.php'))) {
        throw 'public\router.php introuvable. Gardez le fichier BAT dans le dossier du projet.'
    }
    if ($CheckOnly) {
        Write-Host 'Configuration valide.' -ForegroundColor Green
        exit 0
    }

    $port = $null
    $address = $null
    foreach ($candidatePort in 8088..8098) {
        $candidateAddress = "http://127.0.0.1:$candidatePort/"
        $probe = New-Object System.Net.Sockets.TcpListener([System.Net.IPAddress]::Loopback, $candidatePort)
        $available = $false
        try { $probe.Start(); $available = $true } catch {} finally { $probe.Stop() }
        if (!$available) {
            if (Test-WebAcademy $candidateAddress) {
                Write-Host "WebAcademy est deja lance : $candidateAddress" -ForegroundColor Green
                if (!$NoBrowser) { Start-Process $candidateAddress }
                exit 0
            }
            continue
        }
        $port = $candidatePort
        $address = $candidateAddress
        break
    }
    if (!$port) { throw 'Les ports 8088 a 8098 sont occupes. Fermez un ancien serveur puis relancez.' }

    $logDirectory = Join-Path $projectRoot 'data'
    if (!(Test-Path -LiteralPath $logDirectory)) {
        New-Item -ItemType Directory -Path $logDirectory | Out-Null
    }
    $errorLog = Join-Path $logDirectory "local-$port.err.log"
    $serverProcess = Start-Process -FilePath $phpExecutable -ArgumentList @('-S', "127.0.0.1:$port", '-t', 'public', 'public/router.php') -WorkingDirectory $projectRoot -WindowStyle Hidden -RedirectStandardOutput (Join-Path $logDirectory "local-$port.out.log") -RedirectStandardError $errorLog -PassThru
    $ready = $false
    foreach ($attempt in 1..30) {
        if ($serverProcess.HasExited) { break }
        if (Test-WebAcademy $address) { $ready = $true; break }
        Start-Sleep -Milliseconds 300
    }
    if (!$ready) { throw "Le serveur ne repond pas. Consultez $errorLog" }

    Write-Host "Projet lance : $address" -ForegroundColor Green
    Write-Host 'Gardez cette fenetre ouverte. Ctrl+C pour arreter le serveur.'
    Write-Host 'PHP et SQLite sont disponibles. MySQL necessite le service WAMP ; Oracle reste indisponible.'
    if (!$NoBrowser) { Start-Process $address }
    while (!$serverProcess.HasExited) { Start-Sleep -Milliseconds 500 }
    if ($serverProcess.ExitCode -ne 0) { throw "Le serveur s'est arrete. Consultez $errorLog" }
} catch {
    Write-Host "Erreur : $($_.Exception.Message)" -ForegroundColor Red
    exit 1
} finally {
    if ($serverProcess -and !$serverProcess.HasExited) {
        Stop-Process -Id $serverProcess.Id -ErrorAction SilentlyContinue
    }
}
