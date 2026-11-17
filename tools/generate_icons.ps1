Add-Type -AssemblyName System.Drawing

$srcPath = "C:\wamp64\www\webacademy\Coding Academy Emblem.png"
if (-not (Test-Path $srcPath)) {
    Write-Error "Source emblem image not found at $srcPath"
    exit 1
}

$srcBitmap = [System.Drawing.Bitmap]::FromFile($srcPath)

function Resize-Image {
    param (
        [System.Drawing.Bitmap]$source,
        [int]$width,
        [int]$height,
        [string]$outputPath,
        [float]$scaleInCanvas = 1.0, # 1.0 = fill canvas, 0.72 = safe zone for adaptive icon
        [System.Drawing.Color]$bgColor = [System.Drawing.Color]::Transparent
    )

    $targetBitmap = New-Object System.Drawing.Bitmap($width, $height, [System.Drawing.Imaging.PixelFormat]::Format32bppArgb)
    $graphics = [System.Drawing.Graphics]::FromImage($targetBitmap)
    $graphics.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $graphics.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
    $graphics.PixelOffsetMode = [System.Drawing.Drawing2D.PixelOffsetMode]::HighQuality
    $graphics.CompositingQuality = [System.Drawing.Drawing2D.CompositingQuality]::HighQuality

    if ($bgColor -ne [System.Drawing.Color]::Transparent) {
        $graphics.Clear($bgColor)
    } else {
        $graphics.Clear([System.Drawing.Color]::FromArgb(0, 0, 0, 0))
    }

    $destW = [int]($width * $scaleInCanvas)
    $destH = [int]($height * $scaleInCanvas)
    $destX = [int](($width - $destW) / 2)
    $destY = [int](($height - $destH) / 2)

    $destRect = New-Object System.Drawing.Rectangle($destX, $destY, $destW, $destH)
    $graphics.DrawImage($source, $destRect, 0, 0, $source.Width, $source.Height, [System.Drawing.GraphicsUnit]::Pixel)
    $graphics.Dispose()

    $parentDir = Split-Path -Parent $outputPath
    if (-not (Test-Path $parentDir)) {
        New-Item -ItemType Directory -Path $parentDir -Force | Out-Null
    }

    $targetBitmap.Save($outputPath, [System.Drawing.Imaging.ImageFormat]::Png)
    $targetBitmap.Dispose()
    Write-Host "Saved: $outputPath ($width x $height)"
}

# 1. Web Assets
Write-Host "=== Generating Web Icons ==="
$webDir = "C:\wamp64\www\webacademy\public\assets\img"
Resize-Image $srcBitmap 512 512 "$webDir\logo.png" 1.0
Resize-Image $srcBitmap 128 128 "$webDir\logo-128.png" 1.0
Resize-Image $srcBitmap 180 180 "$webDir\apple-touch-icon.png" 1.0
Resize-Image $srcBitmap 32 32 "$webDir\favicon-32x32.png" 1.0
Resize-Image $srcBitmap 16 16 "$webDir\favicon-16x16.png" 1.0
Resize-Image $srcBitmap 192 192 "$webDir\android-chrome-192x192.png" 1.0
Resize-Image $srcBitmap 512 512 "$webDir\android-chrome-512x512.png" 1.0

# 2. Android App Icons
Write-Host "=== Generating Android Icons ==="
$resDir = "C:\wamp64\www\webacademy\mobile\android\app\src\main\res"

$densities = @(
    @{ name = "mdpi"; size = 48; fgSize = 108 },
    @{ name = "hdpi"; size = 72; fgSize = 162 },
    @{ name = "xhdpi"; size = 96; fgSize = 216 },
    @{ name = "xxhdpi"; size = 144; fgSize = 324 },
    @{ name = "xxxhdpi"; size = 192; fgSize = 432 }
)

foreach ($d in $densities) {
    $folder = "$resDir\mipmap-$($d.name)"
    # Standard launcher icon (full emblem)
    Resize-Image $srcBitmap $d.size $d.size "$folder\ic_launcher.png" 1.0
    Resize-Image $srcBitmap $d.size $d.size "$folder\ic_launcher_round.png" 1.0
    # Adaptive foreground icon (centered safe zone ~70%)
    Resize-Image $srcBitmap $d.fgSize $d.fgSize "$folder\ic_launcher_foreground.png" 0.72
}

# 3. Splash Screens
Write-Host "=== Generating Android Splash Screens ==="
$splashDrawables = @(
    "$resDir\drawable\splash.png",
    "$resDir\drawable-port-hdpi\splash.png",
    "$resDir\drawable-port-mdpi\splash.png",
    "$resDir\drawable-port-xhdpi\splash.png",
    "$resDir\drawable-port-xxhdpi\splash.png",
    "$resDir\drawable-port-xxxhdpi\splash.png",
    "$resDir\drawable-land-hdpi\splash.png",
    "$resDir\drawable-land-mdpi\splash.png",
    "$resDir\drawable-land-xhdpi\splash.png",
    "$resDir\drawable-land-xxhdpi\splash.png",
    "$resDir\drawable-land-xxxhdpi\splash.png"
)

foreach ($splash in $splashDrawables) {
    if (Test-Path $splash) {
        $existing = [System.Drawing.Image]::FromFile($splash)
        $w = $existing.Width
        $h = $existing.Height
        $existing.Dispose()
        Resize-Image $srcBitmap $w $h $splash 0.60
    }
}

$srcBitmap.Dispose()
Write-Host "=== ALL ICONS GENERATED SUCCESSFULLY ==="
