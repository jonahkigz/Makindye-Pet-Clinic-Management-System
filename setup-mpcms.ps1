Write-Host "========================================="
Write-Host " Makindye Pet Clinic Management System"
Write-Host " Project Scaffolding"
Write-Host "========================================="

# ---------------------------------------
# Views
# ---------------------------------------

$viewFolders = @(
"layouts",
"components",
"dashboard",
"owners",
"pets",
"species",
"breeds",
"appointments",
"medical-records",
"vaccinations",
"prescriptions",
"invoices",
"payments",
"services",
"products",
"inventory",
"suppliers",
"purchases",
"reports",
"notifications",
"audit-logs",
"settings",
"profile",
"errors"
)

foreach ($folder in $viewFolders) {

    New-Item -ItemType Directory -Force -Path "resources\views\$folder" | Out-Null

    if($folder -notin @("layouts","components","dashboard","errors")){

        New-Item -ItemType File -Force -Path "resources\views\$folder\index.blade.php" | Out-Null
        New-Item -ItemType File -Force -Path "resources\views\$folder\create.blade.php" | Out-Null
        New-Item -ItemType File -Force -Path "resources\views\$folder\edit.blade.php" | Out-Null
        New-Item -ItemType File -Force -Path "resources\views\$folder\show.blade.php" | Out-Null

    }
}

# Dashboard

New-Item -ItemType File -Force -Path "resources\views\dashboard\index.blade.php" | Out-Null

# Layouts

New-Item -ItemType File -Force -Path "resources\views\layouts\app.blade.php" | Out-Null
New-Item -ItemType File -Force -Path "resources\views\layouts\guest.blade.php" | Out-Null
New-Item -ItemType File -Force -Path "resources\views\layouts\navigation.blade.php" | Out-Null
New-Item -ItemType File -Force -Path "resources\views\layouts\sidebar.blade.php" | Out-Null
New-Item -ItemType File -Force -Path "resources\views\layouts\footer.blade.php" | Out-Null

# Components

New-Item -ItemType File -Force -Path "resources\views\components\alerts.blade.php" | Out-Null
New-Item -ItemType File -Force -Path "resources\views\components\breadcrumbs.blade.php" | Out-Null
New-Item -ItemType File -Force -Path "resources\views\components\card.blade.php" | Out-Null
New-Item -ItemType File -Force -Path "resources\views\components\modal.blade.php" | Out-Null

# ---------------------------------------
# Public Assets
# ---------------------------------------

$publicFolders = @(
"css",
"js",
"images",
"images\avatars",
"images\pets",
"images\products",
"images\logos",
"images\services",
"images\backgrounds"
)

foreach($folder in $publicFolders){

    New-Item -ItemType Directory -Force -Path "public\$folder" | Out-Null

}

New-Item -ItemType File -Force -Path "public\css\app.css" | Out-Null
New-Item -ItemType File -Force -Path "public\css\dashboard.css" | Out-Null

New-Item -ItemType File -Force -Path "public\js\app.js" | Out-Null
New-Item -ItemType File -Force -Path "public\js\dashboard.js" | Out-Null

# ---------------------------------------
# Storage
# ---------------------------------------

$storageFolders = @(
"pets",
"owners",
"medical-records",
"vaccinations",
"prescriptions",
"invoices",
"receipts",
"documents",
"products",
"exports",
"imports",
"backups",
"reports"
)

foreach($folder in $storageFolders){

    New-Item -ItemType Directory -Force -Path "storage\app\public\$folder" | Out-Null

}

# ---------------------------------------
# Resources
# ---------------------------------------

New-Item -ItemType Directory -Force -Path "resources\css" | Out-Null
New-Item -ItemType Directory -Force -Path "resources\js" | Out-Null

New-Item -ItemType File -Force -Path "resources\css\app.css" | Out-Null
New-Item -ItemType File -Force -Path "resources\css\dashboard.css" | Out-Null

New-Item -ItemType File -Force -Path "resources\js\app.js" | Out-Null

# ---------------------------------------
# Logs
# ---------------------------------------

New-Item -ItemType Directory -Force -Path "storage\logs" | Out-Null

Write-Host ""
Write-Host "Project folders created successfully!"
Write-Host ""
Write-Host "Next run:"
Write-Host "php artisan storage:link"
Write-Host ""
Write-Host "Done."