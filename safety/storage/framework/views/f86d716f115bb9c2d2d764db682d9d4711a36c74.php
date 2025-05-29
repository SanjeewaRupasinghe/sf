<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medical Appraisal Guide (MAG) - <?php echo $__env->yieldContent('title', 'Model Appraisal Form'); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        
        .header-section {
            background-color: #ffffff;
            border-bottom: 2px solid #0066cc;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        
        .nhs-logo {
            color: #ffffff;
            background-color: #005eb8;
            padding: 5px 10px;
            font-weight: bold;
            border-radius: 3px;
        }
        
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .section-header {
            background-color: #4a90e2;
            color: white;
            padding: 15px 20px;
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        
        .form-content {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }
        
        .required {
            color: #dc3545;
        }
        
        .form-control, .form-select {
            border: 2px solid #dc3545;
            border-radius: 4px;
            padding: 10px;
            font-size: 14px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }
        
        .table-responsive {
            margin: 20px 0;
        }
        
        .qualification-table {
            border: 2px solid #dc3545;
        }
        
        .qualification-table th {
            background-color: #f8f9fa;
            border: 1px solid #dc3545;
            padding: 12px;
            font-weight: bold;
        }
        
        .qualification-table td {
            border: 1px solid #dc3545;
            padding: 10px;
        }
        
        .btn-add-row {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .btn-remove-row {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }
        
        .btn-nav {
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: #0066cc;
            color: white;
            border: 1px solid #0066cc;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: 1px solid #6c757d;
        }
        
        .progress-info {
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        
        .footer-info {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            color: #666;
        }
        
        .sections-navigation {
            background-color: #e9ecef;
            padding: 15px 20px;
            border-top: 1px solid #dee2e6;
        }
        
        .sections-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sections-list li {
            margin-bottom: 5px;
        }
        
        .sections-list a {
            color: #0066cc;
            text-decoration: none;
        }
        
        .sections-list a:hover {
            text-decoration: underline;
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="header-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">Medical Appraisal Guide (MAG)</h1>
                    <p class="mb-0 text-muted">Model Appraisal Form</p>
                    <small class="text-muted">Version 4.2 (updated 2016)</small>
                </div>
                <div class="col-md-4 text-end">
                    <div class="nhs-logo">NHS England</div>
                    <h3 class="mt-2 mb-0">Welcome!</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/layout/pdf.blade.php ENDPATH**/ ?>