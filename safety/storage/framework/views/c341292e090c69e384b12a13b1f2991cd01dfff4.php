<style>
    /* Reset and Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        min-height: 100vh;
    }

    /* Header Styles */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 20px;
        background-color: white;
        border-bottom: 1px solid #ddd;
    }

    .header-left h1 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .header-left h2 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .version {
        font-size: 14px;
        color: #666;
    }

    .header-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .nhs-logo {
        background-color: #005eb8;
        color: white;
        padding: 8px 16px;
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 2px;
    }

    .england-text {
        background-color: #005eb8;
        color: white;
        padding: 2px 16px;
        font-style: italic;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .welcome {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    /* Main Content Layout */
    .main-content {
        display: flex;
        min-height: calc(100vh - 140px);
    }

    /* Navigation Menu */
    .nav-menu {
        width: 300px;
        background-color: #f8f8f8;
        padding: 0;
        border-right: 1px solid #ddd;
        overflow-y: auto;
        max-height: calc(100vh - 140px);
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        border-bottom: 1px solid #ddd;
        transition: background-color 0.2s;
    }

    .nav-item:hover {
        background-color: #e8e8e8;
    }

    .nav-item.active {
        background-color: #e3f2fd;
        border-left: 4px solid #1976d2;
    }

    .nav-item.highlighted {
        background-color: #fff3e0;
    }

    .nav-number {
        width: 30px;
        font-weight: bold;
        color: #666;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .nav-link {
        color: #1976d2;
        text-decoration: none;
        font-size: 14px;
        line-height: 1.4;
    }

    .nav-link:hover {
        color: #0d47a1;
        text-decoration: underline;
    }

    /* Content Area */
    .content-area {
        flex: 1;
        background-color: white;
        overflow-y: auto;
        max-height: calc(100vh - 140px);
    }

    /* Content Header */
    .content-header {
        background-color: #d32f2f;
        color: white;
        padding: 20px 30px;
        border-bottom: 2px solid #b71c1c;
    }

    .content-header h1 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        opacity: 0.9;
    }

    .content-header h2 {
        font-size: 22px;
        font-weight: bold;
        margin: 0;
    }

    /* Content Body */
    .content-body {
        padding: 30px;
        background-color: white;
    }

    .content-body p {
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.6;
        text-align: justify;
    }

    .content-body p:last-child {
        margin-bottom: 0;
    }

    .content-link {
        color: #1976d2;
        text-decoration: underline;
    }

    .content-link:hover {
        color: #0d47a1;
    }

    /* Content Subsections */
    .content-subsection {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .content-subsection h3 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .content-subsection ul {
        margin-left: 20px;
        margin-bottom: 20px;
    }

    .content-subsection li {
        margin-bottom: 12px;
        font-size: 14px;
        line-height: 1.6;
    }

    /* Navigation Buttons */
    .nav-button {
        background-color: #1976d2;
        color: white;
        border: none;
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 3px;
        cursor: pointer;
        margin: 0 2px;
    }

    .nav-button:hover {
        background-color: #0d47a1;
    }

    .nav-button.previous {
        margin-right: 5px;
    }

    .nav-button.next {
        margin-left: 5px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .header-right {
            align-items: flex-start;
        }

        .main-content {
            flex-direction: column;
        }

        .nav-menu {
            width: 100%;
            max-height: 300px;
            order: 2;
        }

        .content-area {
            order: 1;
            max-height: none;
        }

        .content-header {
            padding: 15px 20px;
        }

        .content-header h1 {
            font-size: 16px;
        }

        .content-header h2 {
            font-size: 18px;
        }

        .content-body {
            padding: 20px;
        }

        .nav-item {
            padding: 10px 15px;
        }

        .nav-number {
            width: 25px;
            margin-right: 10px;
        }

        .nav-link {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .header-left h1 {
            font-size: 20px;
        }

        .header-left h2 {
            font-size: 16px;
        }

        .content-header {
            padding: 12px 15px;
        }

        .content-header h1 {
            font-size: 14px;
        }

        .content-header h2 {
            font-size: 16px;
        }

        .content-body {
            padding: 15px;
        }

        .content-body p,
        .content-subsection li {
            font-size: 13px;
        }

        .content-subsection h3 {
            font-size: 15px;
        }
    }

    /* Print Styles */
    @media  print {
        .nav-menu {
            display: none;
        }

        .content-area {
            width: 100%;
        }

        .content-header {
            background-color: #d32f2f !important;
            color: white !important;
        }
    }






    .help-icon {
        color: #0066cc;
        cursor: pointer;
        margin-left: 5px;
    }

    .help-text {
        display: none;
        background-color: #e7f3ff;
        border: 1px solid #b3d9ff;
        padding: 0.75rem;
        margin-top: 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.9rem;
    }

    /* .form-section {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            background-color: #fff;
        }
        
        .section-title {
            color: #0066cc;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        } */

    .dynamic-row {
        border: 1px solid #e9ecef;
        border-radius: 0.25rem;
        padding: 1rem;
        margin-bottom: 1rem;
        background-color: #f8f9fa;
    }

    .btn-add-row {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-remove-row {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/layout/appraisal-css.blade.php ENDPATH**/ ?>