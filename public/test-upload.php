<?php
// اختبار صلاحية المجلدات
$dir = 'uploads';
if (!is_dir($dir)) {
    mkdir($dir, 0775, true);
}

$testFile = $dir . '/test.txt';
if (file_put_contents($testFile, 'Testing connection and permissions...')) {
    echo "✅ 1. Permissions: Writing to public/uploads is OK.<br>";
    unlink($testFile);
} else {
    echo "❌ 1. Permissions: Cannot write to public/uploads.<br>";
}

// اختبار اتصال Cloudinary
try {
    // افترضنا أنك تستخدم مكتبة Cloudinary
    // هذا الاختبار يحاول فقط رؤية إذا كان المتغير موجوداً
    if (getenv('CLOUDINARY_URL')) {
        echo "✅ 2. Cloudinary: URL variable is found.<br>";
    } else {
        echo "❌ 2. Cloudinary: URL variable is missing in Railway Variables.<br>";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
