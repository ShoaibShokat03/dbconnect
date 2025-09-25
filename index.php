<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBConnect Pro - Advanced Database Management Tool</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            color: #2c3e50;
            font-size: 13px;
            line-height: 1.4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px;
        }

        .header {
            background: white;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .connection-only-view {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 80px);
        }

        .connection-card {
            background: white;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            width: 400px;
            max-width: 90vw;
        }

        .connection-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .connection-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #7f8c8d;
        }

        .connection-info.connected {
            color: #27ae60;
        }

        /* Header Layout */
        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
        }

        .header-left {
            flex: 1;
        }

        .header-tabs {
            flex: 2;
            margin: 0 20px;
        }

        /* Tab Navigation */
        .tab-navigation {
            display: flex;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            backdrop-filter: blur(10px);
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .tab-navigation::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            padding: 10px 16px;
            border: none;
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 4px;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 2px;
        }

        .tab-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .tab-btn.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .tab-btn i {
            font-size: 11px;
        }

        /* Tab Content */
        .tab-content {
            flex: 1;
            background: white;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .tab-pane {
            display: none;
            height: 100%;
            overflow-y: auto;
        }

        .tab-pane.active {
            display: block;
        }

        /* Enhanced Card Headers */
        .card-header {
            background: #34495e;
            color: white;
            padding: 10px 15px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
        }

        .table-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .table-controls .form-control {
            min-width: 150px;
        }

        /* Enhanced Buttons */
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            position: relative;
            overflow: hidden;
        }

        .btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover:before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(39, 174, 96, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(39, 174, 96, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(231, 76, 60, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(149, 165, 166, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(149, 165, 166, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(243, 156, 18, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(243, 156, 18, 0.4);
        }

        /* Enhanced Form Controls */
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            font-size: 12px;
            transition: all 0.3s ease;
            background: #fff;
            position: relative;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            transform: translateY(-1px);
        }

        .form-control:hover {
            border-color: #bdc3c7;
        }

        /* Enhanced Query Editor */
        .query-editor {
            min-height: 200px;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 13px;
            padding: 12px;
            resize: vertical;
            background: #fafbfc;
            transition: all 0.3s ease;
            line-height: 1.5;
        }

        .query-editor:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            background: #fff;
        }

        /* Enhanced Results Table */
        .results-container {
            margin-top: 15px;
            max-height: 400px;
            overflow: auto;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .results-table th,
        .results-table td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s ease;
        }

        .results-table th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 10;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        .results-table tr:hover {
            background: #f8f9fa;
        }

        .results-table tr:nth-child(even) {
            background: #fafbfc;
        }

        .results-table tr:nth-child(even):hover {
            background: #f1f3f4;
        }

        /* Enhanced Template Buttons */
        .query-templates {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .template-btn {
            padding: 6px 12px;
            background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
            border: 1px solid #95a5a6;
            border-radius: 20px;
            font-size: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            font-weight: 500;
        }

        .template-btn:hover {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border-color: #3498db;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(52, 152, 219, 0.3);
        }

        /* Enhanced Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
            margin-top: 15px;
        }

        .stat-card {
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .stat-number {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 4px;
            color: #3498db;
        }

        .stat-label {
            font-size: 10px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Enhanced Loading */
        .loading {
            text-align: center;
            padding: 40px 20px;
            color: #7f8c8d;
            font-size: 13px;
            background: #f8f9fa;
            border-radius: 6px;
            border: 2px dashed #dee2e6;
        }

        .loading:before {
            content: '⏳';
            display: block;
            font-size: 24px;
            margin-bottom: 10px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Enhanced Notifications */
        .notification {
            position: fixed;
            top: 15px;
            right: 15px;
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            font-size: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        }

        .notification.error {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .notification.info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        }

        .notification.warning {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        }

        /* Enhanced Table Actions */
        .table-actions {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .table-action {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            font-size: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            opacity: 0;
            transform: scale(0.8);
        }

        .table-item:hover .table-action {
            opacity: 1;
            transform: scale(1);
        }

        .table-action.view {
            background: #3498db;
            color: white;
        }

        .table-action.structure {
            background: #9b59b6;
            color: white;
        }

        .table-action.export {
            background: #27ae60;
            color: white;
        }

        .table-action:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Enhanced Table Data */
        .table-data-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 6px;
        }

        .table-data-content {
            overflow-x: auto;
        }

        .table-structure-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 6px;
        }

        /* Performance Metrics */
        .performance-metrics {
            padding: 20px;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .metric-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .metric-title {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-value {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        /* ER Diagram */
        .er-diagram {
            padding: 20px;
        }

        .diagram-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .diagram-header h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .diagram-header p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .table-entities {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .entity-box {
            background: white;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .entity-box:hover {
            border-color: #3498db;
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.2);
            transform: translateY(-2px);
        }

        .entity-header {
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: white;
            padding: 12px 15px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .entity-fields {
            padding: 15px;
        }

        .field {
            padding: 8px 12px;
            margin-bottom: 8px;
            background: #f8f9fa;
            border-radius: 4px;
            font-size: 12px;
            border-left: 3px solid #bdc3c7;
        }

        .field.key {
            background: #e8f5e8;
            border-left-color: #27ae60;
            font-weight: 600;
        }

        .field.key:before {
            content: "🔑 ";
        }

        /* No Data States */
        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: #7f8c8d;
        }

        .no-data p {
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Responsive Enhancements */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px 10px;
            }

            .header-left {
                flex: none;
            }

            .header-tabs {
                flex: none;
                margin: 0;
                width: 100%;
            }

            .tab-navigation {
                overflow-x: auto;
                scrollbar-width: thin;
                justify-content: center;
            }

            .tab-btn {
                padding: 8px 12px;
                font-size: 10px;
                margin: 1px;
            }

            .table-controls {
                flex-direction: column;
                gap: 10px;
            }

            .table-controls .form-control {
                min-width: 100%;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
            }

            .table-entities {
                grid-template-columns: 1fr;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideIn 0.3s ease;
            position: relative;
        }

        .modal-content.large {
            max-width: 800px;
        }

        .modal-content.small {
            max-width: 400px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            padding: 20px 25px;
            border-bottom: 2px solid #e1e8ed;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: white;
            border-radius: 12px 12px 0 0;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .modal-body {
            padding: 25px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .modal-footer {
            padding: 20px 25px;
            border-top: 2px solid #e1e8ed;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            background: #f8f9fa;
            border-radius: 0 0 12px 12px;
        }

        /* Table Creation Styles */
        .column-definition {
            display: grid;
            grid-template-columns: 2fr 1.5fr auto auto auto auto;
            gap: 10px;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px solid #e1e8ed;
        }

        .column-definition label {
            font-size: 12px;
            color: #495057;
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .column-definition input[type="checkbox"] {
            margin: 0;
        }

        .column-definition .btn {
            padding: 6px 10px;
            font-size: 10px;
        }

        /* Form Enhancements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #2c3e50;
            font-size: 13px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 8px;
        }

        .optional-text {
            color: #7f8c8d;
            font-weight: normal;
            font-size: 11px;
            font-style: italic;
        }

        .form-help-text {
            display: block;
            margin-top: 4px;
            font-size: 11px;
            color: #95a5a6;
            font-style: italic;
        }

        .password-input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-input-container .form-control {
            padding-right: 40px;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .password-toggle:hover {
            color: #3498db;
            background: rgba(52, 152, 219, 0.1);
        }

        .password-toggle:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        /* Text Colors */
        .text-danger {
            color: #e74c3c !important;
        }

        .text-success {
            color: #27ae60 !important;
        }

        .text-warning {
            color: #f39c12 !important;
        }

        .text-info {
            color: #3498db !important;
        }

        /* Loading States */
        .btn.loading {
            position: relative;
            color: transparent !important;
        }

        .btn.loading:after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Enhanced Input Focus */
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            transform: translateY(-1px);
        }

        /* Responsive Modal */
        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                margin: 20px;
            }

            .column-definition {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .modal-footer {
                flex-direction: column;
            }

            .modal-footer .btn {
                width: 100%;
            }
        }

        .header h1 {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .header p {
            font-size: 12px;
            color: #7f8c8d;
            margin: 0;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            height: calc(100vh - 80px);
        }

        .main-content.connected {
            grid-template-columns: 280px 1fr;
        }

        .main-content-area {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card {
            background: white;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-header {
            background: #34495e;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .card-body {
            padding: 12px;
            flex: 1;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-weight: 500;
            color: #34495e;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 6px 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 12px;
            transition: border-color 0.2s ease;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.1);
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background: #229954;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
        }

        .btn-group {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .status-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .status-connected {
            background: #27ae60;
        }

        .status-disconnected {
            background: #e74c3c;
        }

        .query-editor {
            min-height: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 12px;
            padding: 8px;
            resize: vertical;
            background: #fafafa;
        }

        .query-editor:focus {
            outline: none;
            border-color: #3498db;
        }

        .results-container {
            margin-top: 10px;
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .results-table th,
        .results-table td {
            padding: 6px 8px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .results-table th {
            background: #f8f9fa;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 10;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .results-table tr:hover {
            background: #f8f9fa;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .database-info {
            background: white;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .database-info-header {
            background: #2c3e50;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .database-info-body {
            padding: 10px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 11px;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #7f8c8d;
        }

        .info-value {
            color: #2c3e50;
            font-family: monospace;
            font-size: 10px;
        }

        .tables-list {
            background: white;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .tables-list-header {
            background: #27ae60;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .tables-list-body {
            padding: 8px;
            overflow-y: auto;
            flex: 1;
            max-height: 400px;
        }

        .table-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 8px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-radius: 3px;
            margin-bottom: 2px;
        }

        .table-item:hover {
            background: #f8f9fa;
        }

        .table-item:last-child {
            border-bottom: none;
        }

        .table-name {
            font-weight: 500;
            color: #2c3e50;
            font-size: 11px;
        }

        .table-actions {
            display: flex;
            gap: 3px;
        }

        .table-action {
            padding: 3px 6px;
            border: none;
            border-radius: 3px;
            font-size: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .table-action.view {
            background: #3498db;
            color: white;
        }

        .table-action.structure {
            background: #f39c12;
            color: white;
        }

        .table-action.export {
            background: #27ae60;
            color: white;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-size: 11px;
        }

        .error {
            background: #fdf2f2;
            color: #e53e3e;
            padding: 8px;
            border-radius: 4px;
            margin: 6px 0;
            font-size: 11px;
            border-left: 3px solid #e53e3e;
        }

        .success {
            background: #f0fff4;
            color: #38a169;
            padding: 8px;
            border-radius: 4px;
            margin: 6px 0;
            font-size: 11px;
            border-left: 3px solid #38a169;
        }

        .query-templates {
            margin-top: 8px;
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }

        .template-btn {
            padding: 4px 8px;
            background: #ecf0f1;
            border: 1px solid #bdc3c7;
            border-radius: 3px;
            font-size: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .template-btn:hover {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 8px;
            margin-top: 10px;
        }

        .stat-card {
            background: #34495e;
            color: white;
            padding: 8px;
            border-radius: 4px;
            text-align: center;
        }

        .stat-number {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .stat-label {
            font-size: 9px;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
                height: auto;
            }
            
            .main-content.connected {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 16px;
            }
            
            .connection-card {
                width: 95vw;
                margin: 0 10px;
            }
            
            .connection-controls {
                flex-direction: column;
                gap: 6px;
                align-items: flex-end;
            }
            
            .connection-info {
                font-size: 10px;
            }
            
            .tables-list-body {
                max-height: 300px;
            }
        }

        .notification {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 8px 12px;
            border-radius: 4px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            transform: translateX(300px);
            transition: transform 0.3s ease;
            font-size: 11px;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background: #27ae60;
        }

        .notification.error {
            background: #e74c3c;
        }

        .notification.info {
            background: #3498db;
        }

        /* Compact scrollbars */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <h1><i class="fas fa-database"></i> DBConnect Pro</h1>
                <p>Advanced Database Management & Query Tool</p>
            </div>
            
            <!-- Tab Navigation integrated into header -->
            <div class="header-tabs" id="headerTabs" style="display: none;">
                <div class="tab-navigation">
                    <button class="tab-btn active" data-tab="query">
                        <i class="fas fa-terminal"></i> Query
                    </button>
                    <button class="tab-btn" data-tab="table-data">
                        <i class="fas fa-table"></i> Table Data
                    </button>
                    <button class="tab-btn" data-tab="table-structure">
                        <i class="fas fa-cogs"></i> Structure
                    </button>
                    <button class="tab-btn" data-tab="performance">
                        <i class="fas fa-chart-line"></i> Performance
                    </button>
                    <button class="tab-btn" data-tab="visualization">
                        <i class="fas fa-project-diagram"></i> Visualization
                    </button>
                </div>
            </div>
            
            <div id="headerConnectionInfo" class="connection-controls" style="display: none;">
                <div id="connectionInfo" class="connection-info">
                    <span class="status-indicator status-disconnected"></span>
                    <span id="connectionText">Disconnected</span>
                </div>
                <button id="headerDisconnectBtn" class="btn btn-danger" style="display: none;">
                    <i class="fas fa-unlink"></i> Disconnect
                </button>
            </div>
        </div>

        <!-- Connection Only View -->
        <div id="connectionOnlyView" class="connection-only-view">
            <div class="connection-card">
                <div class="card-header">
                    <i class="fas fa-plug"></i> Database Connection
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="dbType">Database Type</label>
                        <select id="dbType" class="form-control">
                            <option value="mysql">MySQL</option>
                            <option value="postgresql">PostgreSQL</option>
                            <option value="sqlite">SQLite</option>
                            <option value="mssql">SQL Server</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="host">Host</label>
                        <input type="text" id="host" class="form-control" placeholder="localhost" value="localhost">
                    </div>
                    
                    <div class="form-group">
                        <label for="port">Port</label>
                        <input type="number" id="port" class="form-control" placeholder="3306" value="3306">
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="root" value="root">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password <span class="optional-text">(Optional)</span></label>
                        <div class="password-input-container">
                            <input type="password" id="password" class="form-control" placeholder="Leave empty for no password">
                            <button type="button" class="password-toggle" onclick="togglePassword()" title="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="form-help-text">Many local database setups don't require a password</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="database">Database</label>
                        <input type="text" id="database" class="form-control" placeholder="database_name">
                    </div>
                    
                    <div class="btn-group">
                        <button id="connectBtn" class="btn btn-primary">
                            <i class="fas fa-link"></i> Connect
                        </button>
                        <button id="testBtn" class="btn btn-secondary">
                            <i class="fas fa-vial"></i> Test
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Application View -->
        <div id="mainAppView" class="main-content" style="display: none;">
            <div class="sidebar">
                <!-- Database Info -->
                <div class="database-info" id="databaseInfo" style="display: none;">
                    <div class="database-info-header">
                        <i class="fas fa-info-circle"></i> Database Information
                    </div>
                    <div class="database-info-body">
                        <div class="info-item">
                            <span class="info-label">Version:</span>
                            <span class="info-value" id="dbVersion">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Charset:</span>
                            <span class="info-value" id="dbCharset">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Size:</span>
                            <span class="info-value" id="dbSize">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tables:</span>
                            <span class="info-value" id="dbTables">-</span>
                        </div>
                    </div>
                </div>

                <!-- Tables List -->
                <div class="tables-list" id="tablesList" style="display: none;">
                    <div class="tables-list-header">
                        <i class="fas fa-table"></i> Tables
                        <button id="refreshTablesBtn" class="btn btn-secondary" style="float: right; padding: 4px 8px; font-size: 10px;">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                    <div class="tables-list-body" id="tablesListBody">
                        <div class="loading">Loading tables...</div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card" id="quickActions" style="display: none;">
                    <div class="card-header">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </div>
                    <div class="card-body">
                        <div class="btn-group" style="flex-direction: column; gap: 6px;">
                            <button id="createTableBtn" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Table
                            </button>
                            <button id="exportAllBtn" class="btn btn-success">
                                <i class="fas fa-download"></i> Export All
                            </button>
                            <button id="optimizeAllBtn" class="btn btn-secondary">
                                <i class="fas fa-tools"></i> Optimize All
                            </button>
                            <button id="backupBtn" class="btn btn-secondary">
                                <i class="fas fa-database"></i> Backup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="main-content-area">
                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Query Tab -->
                    <div id="query-tab" class="tab-pane active">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-terminal"></i> Query Interface
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="queryEditor">SQL Query</label>
                                    <textarea id="queryEditor" class="query-editor" placeholder="Enter your SQL query here...">SELECT * FROM users LIMIT 10;</textarea>
                                </div>
                                
                                <div class="query-templates">
                                    <button class="template-btn" onclick="insertTemplate('SELECT * FROM table_name LIMIT 10;')">Select All</button>
                                    <button class="template-btn" onclick="insertTemplate('DESCRIBE table_name;')">Describe Table</button>
                                    <button class="template-btn" onclick="insertTemplate('SHOW TABLES;')">Show Tables</button>
                                    <button class="template-btn" onclick="insertTemplate('SHOW DATABASES;')">Show Databases</button>
                                    <button class="template-btn" onclick="insertTemplate('SELECT COUNT(*) FROM table_name;')">Count Rows</button>
                                    <button class="template-btn" onclick="insertTemplate('CREATE TABLE new_table (id INT PRIMARY KEY, name VARCHAR(255));')">Create Table</button>
                                </div>
                                
                                <div class="btn-group" style="margin-top: 15px;">
                                    <button id="executeBtn" class="btn btn-success" disabled>
                                        <i class="fas fa-play"></i> Execute
                                    </button>
                                    <button id="explainBtn" class="btn btn-secondary" disabled>
                                        <i class="fas fa-search"></i> Explain
                                    </button>
                                    <button id="clearBtn" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Clear
                                    </button>
                                    <button id="formatBtn" class="btn btn-secondary">
                                        <i class="fas fa-code"></i> Format
                                    </button>
                                    <button id="saveBtn" class="btn btn-secondary">
                                        <i class="fas fa-save"></i> Save Query
                                    </button>
                                </div>
                                
                                <div id="queryResults" class="results-container" style="display: none;">
                                    <!-- Results will be displayed here -->
                                </div>
                                
                                <div id="queryStats" class="stats-grid" style="display: none;">
                                    <div class="stat-card">
                                        <div class="stat-number" id="executionTime">0ms</div>
                                        <div class="stat-label">Execution Time</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-number" id="rowsAffected">0</div>
                                        <div class="stat-label">Rows Affected</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-number" id="rowsReturned">0</div>
                                        <div class="stat-label">Rows Returned</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Data Tab -->
                    <div id="table-data-tab" class="tab-pane">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-table"></i> Table Data
                                <div class="table-controls">
                                    <select id="selectedTable" class="form-control" style="width: auto; display: inline-block; margin-right: 10px;">
                                        <option value="">Select Table</option>
                                    </select>
                                    <button id="loadTableDataBtn" class="btn btn-primary" disabled>
                                        <i class="fas fa-sync-alt"></i> Load Data
                                    </button>
                                    <button id="addRowBtn" class="btn btn-success" disabled>
                                        <i class="fas fa-plus"></i> Add Row
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="tableDataContainer">
                                    <div class="loading">Select a table to view data</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Structure Tab -->
                    <div id="table-structure-tab" class="tab-pane">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-cogs"></i> Table Structure
                                <div class="table-controls">
                                    <select id="selectedTableStructure" class="form-control" style="width: auto; display: inline-block; margin-right: 10px;">
                                        <option value="">Select Table</option>
                                    </select>
                                    <button id="loadStructureBtn" class="btn btn-primary" disabled>
                                        <i class="fas fa-sync-alt"></i> Load Structure
                                    </button>
                                    <button id="addColumnBtn" class="btn btn-success" disabled>
                                        <i class="fas fa-plus"></i> Add Column
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="tableStructureContainer">
                                    <div class="loading">Select a table to view structure</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Tab -->
                    <div id="performance-tab" class="tab-pane">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-chart-line"></i> Performance Analysis
                            </div>
                            <div class="card-body">
                                <div class="btn-group" style="margin-bottom: 15px;">
                                    <button id="loadMetricsBtn" class="btn btn-primary">
                                        <i class="fas fa-chart-bar"></i> Load Metrics
                                    </button>
                                    <button id="loadRecommendationsBtn" class="btn btn-success">
                                        <i class="fas fa-lightbulb"></i> Recommendations
                                    </button>
                                    <button id="analyzeQueryBtn" class="btn btn-secondary">
                                        <i class="fas fa-search"></i> Analyze Query
                                    </button>
                                </div>
                                <div id="performanceContainer">
                                    <div class="loading">Click "Load Metrics" to view performance data</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visualization Tab -->
                    <div id="visualization-tab" class="tab-pane">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-project-diagram"></i> Database Visualization
                            </div>
                            <div class="card-body">
                                <div class="btn-group" style="margin-bottom: 15px;">
                                    <button id="loadERDiagramBtn" class="btn btn-primary">
                                        <i class="fas fa-project-diagram"></i> ER Diagram
                                    </button>
                                    <button id="loadSchemaBtn" class="btn btn-success">
                                        <i class="fas fa-sitemap"></i> Schema Map
                                    </button>
                                    <button id="exportDocBtn" class="btn btn-secondary">
                                        <i class="fas fa-file-pdf"></i> Export Docs
                                    </button>
                                </div>
                                <div id="visualizationContainer">
                                    <div class="loading">Click "ER Diagram" to view database relationships</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notification" class="notification"></div>

    <!-- Modal Components -->
    <!-- Add Row Modal -->
    <div id="addRowModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Add New Row</h3>
                <button class="modal-close" onclick="closeModal('addRowModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addRowForm">
                    <div id="addRowFields">
                        <!-- Dynamic fields will be inserted here -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addRowModal')">Cancel</button>
                <button type="button" class="btn btn-success" onclick="saveNewRow()">
                    <i class="fas fa-save"></i> Save Row
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Row Modal -->
    <div id="editRowModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit Row</h3>
                <button class="modal-close" onclick="closeModal('editRowModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editRowForm">
                    <div id="editRowFields">
                        <!-- Dynamic fields will be inserted here -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editRowModal')">Cancel</button>
                <button type="button" class="btn btn-success" onclick="updateRow()">
                    <i class="fas fa-save"></i> Update Row
                </button>
            </div>
        </div>
    </div>

    <!-- Add Column Modal -->
    <div id="addColumnModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Add New Column</h3>
                <button class="modal-close" onclick="closeModal('addColumnModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addColumnForm">
                    <div class="form-group">
                        <label for="columnName">Column Name</label>
                        <input type="text" id="columnName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="columnType">Data Type</label>
                        <select id="columnType" class="form-control" required>
                            <option value="INT">INT</option>
                            <option value="VARCHAR(255)">VARCHAR(255)</option>
                            <option value="TEXT">TEXT</option>
                            <option value="DATETIME">DATETIME</option>
                            <option value="DATE">DATE</option>
                            <option value="TIME">TIME</option>
                            <option value="DECIMAL(10,2)">DECIMAL(10,2)</option>
                            <option value="BOOLEAN">BOOLEAN</option>
                            <option value="JSON">JSON</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="columnDefault">Default Value</label>
                        <input type="text" id="columnDefault" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="columnNull"> Allow NULL values
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addColumnModal')">Cancel</button>
                <button type="button" class="btn btn-success" onclick="saveNewColumn()">
                    <i class="fas fa-save"></i> Add Column
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Column Modal -->
    <div id="editColumnModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit Column</h3>
                <button class="modal-close" onclick="closeModal('editColumnModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editColumnForm">
                    <div class="form-group">
                        <label for="editColumnName">Column Name</label>
                        <input type="text" id="editColumnName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editColumnType">Data Type</label>
                        <select id="editColumnType" class="form-control" required>
                            <option value="INT">INT</option>
                            <option value="VARCHAR(255)">VARCHAR(255)</option>
                            <option value="TEXT">TEXT</option>
                            <option value="DATETIME">DATETIME</option>
                            <option value="DATE">DATE</option>
                            <option value="TIME">TIME</option>
                            <option value="DECIMAL(10,2)">DECIMAL(10,2)</option>
                            <option value="BOOLEAN">BOOLEAN</option>
                            <option value="JSON">JSON</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editColumnDefault">Default Value</label>
                        <input type="text" id="editColumnDefault" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="editColumnNull"> Allow NULL values
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editColumnModal')">Cancel</button>
                <button type="button" class="btn btn-success" onclick="updateColumn()">
                    <i class="fas fa-save"></i> Update Column
                </button>
            </div>
        </div>
    </div>

    <!-- Create Table Modal -->
    <div id="createTableModal" class="modal">
        <div class="modal-content large">
            <div class="modal-header">
                <h3><i class="fas fa-table"></i> Create New Table</h3>
                <button class="modal-close" onclick="closeModal('createTableModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="createTableForm">
                    <div class="form-group">
                        <label for="tableName">Table Name</label>
                        <input type="text" id="tableName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <h4>Columns</h4>
                        <div id="tableColumns">
                            <div class="column-definition">
                                <input type="text" placeholder="Column Name" class="form-control" required>
                                <select class="form-control">
                                    <option value="INT">INT</option>
                                    <option value="VARCHAR(255)">VARCHAR(255)</option>
                                    <option value="TEXT">TEXT</option>
                                    <option value="DATETIME">DATETIME</option>
                                    <option value="DECIMAL(10,2)">DECIMAL(10,2)</option>
                                </select>
                                <label><input type="checkbox"> Primary Key</label>
                                <label><input type="checkbox"> Auto Increment</label>
                                <label><input type="checkbox"> Not Null</label>
                                <button type="button" class="btn btn-danger" onclick="removeColumn(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addTableColumn()">
                            <i class="fas fa-plus"></i> Add Column
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('createTableModal')">Cancel</button>
                <button type="button" class="btn btn-success" onclick="saveNewTable()">
                    <i class="fas fa-save"></i> Create Table
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="modal">
        <div class="modal-content small">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Confirm Delete</h3>
                <button class="modal-close" onclick="closeModal('deleteConfirmModal')">&times;</button>
            </div>
            <div class="modal-body">
                <p id="deleteConfirmMessage">Are you sure you want to delete this item?</p>
                <p class="text-danger"><strong>This action cannot be undone!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('deleteConfirmModal')">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <script>
        class DBConnect {
            constructor() {
                this.connected = false;
                this.connection = null;
                this.currentTable = null;
                this.initializeEventListeners();
                this.checkConnectionStatus();
            }

            initializeEventListeners() {
                // Connection events
                document.getElementById('connectBtn').addEventListener('click', () => this.connect());
                document.getElementById('headerDisconnectBtn').addEventListener('click', () => this.disconnect());
                document.getElementById('testBtn').addEventListener('click', () => this.testConnection());
                
                // Query events
                document.getElementById('executeBtn').addEventListener('click', () => this.executeQuery());
                document.getElementById('explainBtn').addEventListener('click', () => this.explainQuery());
                document.getElementById('clearBtn').addEventListener('click', () => this.clearQuery());
                document.getElementById('formatBtn').addEventListener('click', () => this.formatQuery());
                document.getElementById('saveBtn').addEventListener('click', () => this.saveQuery());

                // Tab events
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const tabName = btn.getAttribute('data-tab');
                        this.switchTab(tabName);
                    });
                });

                // Table data events
                document.getElementById('loadTableDataBtn').addEventListener('click', () => this.loadTableData());
                document.getElementById('selectedTable').addEventListener('change', (e) => {
                    document.getElementById('loadTableDataBtn').disabled = !e.target.value;
                    document.getElementById('addRowBtn').disabled = !e.target.value;
                });

                // Table structure events
                document.getElementById('loadStructureBtn').addEventListener('click', () => this.loadTableStructure());
                document.getElementById('selectedTableStructure').addEventListener('change', (e) => {
                    document.getElementById('loadStructureBtn').disabled = !e.target.value;
                    document.getElementById('addColumnBtn').disabled = !e.target.value;
                });

                // Performance events
                document.getElementById('loadMetricsBtn').addEventListener('click', () => this.loadPerformanceMetrics());
                document.getElementById('loadRecommendationsBtn').addEventListener('click', () => this.loadRecommendations());
                document.getElementById('analyzeQueryBtn').addEventListener('click', () => this.analyzeQuery());

                // Visualization events
                document.getElementById('loadERDiagramBtn').addEventListener('click', () => this.loadERDiagram());
                document.getElementById('loadSchemaBtn').addEventListener('click', () => this.loadSchemaMap());
                document.getElementById('exportDocBtn').addEventListener('click', () => this.exportDocumentation());

                // Quick actions events
                document.getElementById('createTableBtn').addEventListener('click', () => this.openCreateTableModal());
                document.getElementById('exportAllBtn').addEventListener('click', () => this.exportAllTables());
                document.getElementById('optimizeAllBtn').addEventListener('click', () => this.optimizeAllTables());
                document.getElementById('backupBtn').addEventListener('click', () => this.createBackup());

                // Refresh tables
                document.getElementById('refreshTablesBtn').addEventListener('click', () => this.loadTables());

                // Auto-resize port based on database type
                document.getElementById('dbType').addEventListener('change', (e) => {
                    const ports = {
                        'mysql': 3306,
                        'postgresql': 5432,
                        'sqlite': '',
                        'mssql': 1433
                    };
                    document.getElementById('port').value = ports[e.target.value] || '';
                });

                // Keyboard shortcuts
                document.addEventListener('keydown', (e) => {
                    if (e.ctrlKey && e.key === 'Enter') {
                        e.preventDefault();
                        this.executeQuery();
                    }
                    if (e.ctrlKey && e.key === 'l') {
                        e.preventDefault();
                        this.clearQuery();
                    }
                    if (e.ctrlKey && e.key === 't') {
                        e.preventDefault();
                        this.switchTab('table-data');
                    }
                    if (e.ctrlKey && e.key === 's') {
                        e.preventDefault();
                        this.switchTab('table-structure');
                    }
                });
            }

            async checkConnectionStatus() {
                try {
                    const response = await fetch('backend/api/database/status');
                    const result = await response.json();

                    if (result.status === 'success' && result.data.connected) {
                        this.connected = true;
                        this.updateConnectionStatus(true);
                        this.loadDatabaseInfo();
                        this.loadTables();
                        this.showQuickActions();
                        
                        // Fill in the connection form with stored data
                        const config = result.data.config;
                        document.getElementById('dbType').value = config.type;
                        document.getElementById('host').value = config.host;
                        document.getElementById('database').value = config.database;
                        
                        // Update header connection info
                        const connectionText = document.getElementById('connectionText');
                        connectionText.textContent = `Connected to ${config.type}://${config.host}/${config.database}`;
                        
                        this.showNotification('Restored connection from session', 'info');
                    } else {
                        // Try to restore from localStorage
                        this.restoreFromLocalStorage();
                    }
                } catch (error) {
                    console.log('No existing connection found');
                    // Try to restore from localStorage
                    this.restoreFromLocalStorage();
                }
            }

            restoreFromLocalStorage() {
                try {
                    const storedConfig = localStorage.getItem('dbconnect_config');
                    if (storedConfig) {
                        const config = JSON.parse(storedConfig);
                        document.getElementById('dbType').value = config.type || 'mysql';
                        document.getElementById('host').value = config.host || 'localhost';
                        document.getElementById('port').value = config.port || '3306';
                        document.getElementById('database').value = config.database || '';
                        
                        this.showNotification('Restored connection details from local storage', 'info');
                    }
                } catch (error) {
                    console.log('No stored connection config found');
                }
            }

            async connect() {
                const connectionData = {
                    type: document.getElementById('dbType').value,
                    host: document.getElementById('host').value,
                    port: document.getElementById('port').value,
                    username: document.getElementById('username').value,
                    password: document.getElementById('password').value || '', // Handle empty password
                    database: document.getElementById('database').value
                };

                try {
                    const response = await fetch('backend/api/database/connect', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(connectionData)
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        this.connected = true;
                        this.updateConnectionStatus(true);
                        this.loadDatabaseInfo();
                        this.loadTables();
                        
                        // Update header connection info
                        const connectionText = document.getElementById('connectionText');
                        connectionText.textContent = `Connected to ${connectionData.type}://${connectionData.host}/${connectionData.database}`;
                        
                        // Store connection details in localStorage for persistence
                        localStorage.setItem('dbconnect_config', JSON.stringify({
                            type: connectionData.type,
                            host: connectionData.host,
                            port: connectionData.port,
                            database: connectionData.database
                            // Don't store password for security
                        }));
                        
                        this.showNotification('Connected successfully!', 'success');
                    } else {
                        throw new Error(result.message || 'Connection failed');
                    }
                } catch (error) {
                    this.showNotification('Connection failed: ' + error.message, 'error');
                }
            }

            async testConnection() {
                const connectionData = {
                    type: document.getElementById('dbType').value,
                    host: document.getElementById('host').value,
                    port: document.getElementById('port').value,
                    username: document.getElementById('username').value,
                    password: document.getElementById('password').value || '', // Handle empty password
                    database: document.getElementById('database').value
                };

                try {
                    const response = await fetch('backend/api/database/test', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(connectionData)
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        this.showNotification('Connection test successful!', 'success');
                    } else {
                        throw new Error(result.message || 'Test failed');
                    }
                } catch (error) {
                    this.showNotification('Connection test failed: ' + error.message, 'error');
                }
            }

            async disconnect() {
                try {
                    const response = await fetch('backend/api/database/disconnect', {
                        method: 'POST'
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        this.connected = false;
                        this.updateConnectionStatus(false);
                        
                        // Clear localStorage
                        localStorage.removeItem('dbconnect_config');
                        
                        // Clear form fields
                        document.getElementById('username').value = '';
                        document.getElementById('password').value = '';
                        
                        this.showNotification('Disconnected successfully', 'info');
                    } else {
                        throw new Error(result.message || 'Disconnect failed');
                    }
                } catch (error) {
                    this.showNotification('Disconnect failed: ' + error.message, 'error');
                }
            }

            updateConnectionStatus(connected) {
                const connectionOnlyView = document.getElementById('connectionOnlyView');
                const mainAppView = document.getElementById('mainAppView');
                const headerConnectionInfo = document.getElementById('headerConnectionInfo');
                const headerTabs = document.getElementById('headerTabs');
                const connectionInfo = document.getElementById('connectionInfo');
                const connectionText = document.getElementById('connectionText');
                const headerDisconnectBtn = document.getElementById('headerDisconnectBtn');
                const executeBtn = document.getElementById('executeBtn');
                const explainBtn = document.getElementById('explainBtn');

                if (connected) {
                    // Show main app view, hide connection only view
                    connectionOnlyView.style.display = 'none';
                    mainAppView.style.display = 'grid';
                    mainAppView.classList.add('connected');
                    
                    // Show header tabs and connection info
                    headerTabs.style.display = 'block';
                    headerConnectionInfo.style.display = 'flex';
                    connectionInfo.classList.add('connected');
                    connectionText.textContent = 'Connected';
                    headerDisconnectBtn.style.display = 'inline-flex';
                    
                    // Enable query buttons
                    executeBtn.disabled = false;
                    explainBtn.disabled = false;
                    
                    // Show database info and tables
                    document.getElementById('databaseInfo').style.display = 'block';
                    document.getElementById('tablesList').style.display = 'block';
                } else {
                    // Show connection only view, hide main app view
                    connectionOnlyView.style.display = 'flex';
                    mainAppView.style.display = 'none';
                    mainAppView.classList.remove('connected');
                    
                    // Hide header tabs and connection info
                    headerTabs.style.display = 'none';
                    headerConnectionInfo.style.display = 'none';
                    connectionInfo.classList.remove('connected');
                    connectionText.textContent = 'Disconnected';
                    headerDisconnectBtn.style.display = 'none';
                    
                    // Disable query buttons
                    executeBtn.disabled = true;
                    explainBtn.disabled = true;
                    
                    // Hide database info and tables
                    document.getElementById('databaseInfo').style.display = 'none';
                    document.getElementById('tablesList').style.display = 'none';
                    this.hideQuickActions();
                }
            }

            async loadDatabaseInfo() {
                try {
                    const response = await fetch('backend/api/database/info');
                    const result = await response.json();

                    if (result.status === 'success') {
                        document.getElementById('dbVersion').textContent = result.data.version || '-';
                        document.getElementById('dbCharset').textContent = result.data.charset || '-';
                        document.getElementById('dbSize').textContent = result.data.size || '-';
                        document.getElementById('dbTables').textContent = result.data.tables_count || '-';
                    }
                } catch (error) {
                    console.error('Failed to load database info:', error);
                }
            }

            async loadTables() {
                try {
                    const response = await fetch('backend/api/database/tables');
                    const result = await response.json();

                    if (result.status === 'success') {
                        this.displayTables(result.data);
                    }
                } catch (error) {
                    console.error('Failed to load tables:', error);
                }
            }

            displayTables(tables) {
                const tablesListBody = document.getElementById('tablesListBody');
                
                if (tables.length === 0) {
                    tablesListBody.innerHTML = '<div class="loading">No tables found</div>';
                    return;
                }

                const tablesHtml = tables.map(table => `
                    <div class="table-item">
                        <span class="table-name">${table.name}</span>
                        <div class="table-actions">
                            <button class="table-action view" onclick="dbConnect.viewTable('${table.name}')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="table-action structure" onclick="dbConnect.describeTable('${table.name}')">
                                <i class="fas fa-info"></i>
                            </button>
                            <button class="table-action export" onclick="dbConnect.exportTable('${table.name}')">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                `).join('');

                tablesListBody.innerHTML = tablesHtml;
            }

            async executeQuery() {
                if (!this.connected) {
                    this.showNotification('Please connect to a database first', 'error');
                    return;
                }

                const query = document.getElementById('queryEditor').value.trim();
                if (!query) {
                    this.showNotification('Please enter a query', 'error');
                    return;
                }

                const startTime = performance.now();

                try {
                    const response = await fetch('backend/api/database/query', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ query })
                    });

                    const result = await response.json();
                    const endTime = performance.now();
                    const executionTime = Math.round(endTime - startTime);

                    if (result.status === 'success') {
                        this.displayResults(result.data, executionTime);
                        this.showNotification('Query executed successfully', 'success');
                    } else {
                        throw new Error(result.message || 'Query failed');
                    }
                } catch (error) {
                    this.showNotification('Query failed: ' + error.message, 'error');
                }
            }

            async explainQuery() {
                if (!this.connected) {
                    this.showNotification('Please connect to a database first', 'error');
                    return;
                }

                const query = document.getElementById('queryEditor').value.trim();
                if (!query) {
                    this.showNotification('Please enter a query', 'error');
                    return;
                }

                try {
                    const response = await fetch('backend/api/database/explain', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ query })
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        this.displayResults(result.data, 0);
                        this.showNotification('Query plan generated', 'success');
                    } else {
                        throw new Error(result.message || 'Explain failed');
                    }
                } catch (error) {
                    this.showNotification('Explain failed: ' + error.message, 'error');
                }
            }

            displayResults(data, executionTime) {
                const resultsContainer = document.getElementById('queryResults');
                const statsContainer = document.getElementById('queryStats');
                
                resultsContainer.style.display = 'block';
                statsContainer.style.display = 'grid';

                // Update stats
                document.getElementById('executionTime').textContent = executionTime + 'ms';
                document.getElementById('rowsAffected').textContent = data.affected_rows || 0;
                document.getElementById('rowsReturned').textContent = data.rows ? data.rows.length : 0;

                if (data.rows && data.rows.length > 0) {
                    const table = this.createResultsTable(data.rows);
                    resultsContainer.innerHTML = table;
                } else {
                    resultsContainer.innerHTML = '<div class="success">Query executed successfully. No rows returned.</div>';
                }
            }

            createResultsTable(rows) {
                if (rows.length === 0) return '<div class="loading">No results</div>';

                const headers = Object.keys(rows[0]);
                const headerRow = headers.map(header => `<th>${header}</th>`).join('');
                
                const bodyRows = rows.map(row => {
                    const cells = headers.map(header => {
                        let value = row[header];
                        if (value === null) value = '<em>NULL</em>';
                        else if (typeof value === 'string') value = this.escapeHtml(value);
                        return `<td>${value}</td>`;
                    }).join('');
                    return `<tr>${cells}</tr>`;
                }).join('');

                return `
                    <table class="results-table">
                        <thead><tr>${headerRow}</tr></thead>
                        <tbody>${bodyRows}</tbody>
                    </table>
                `;
            }

            escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            clearQuery() {
                document.getElementById('queryEditor').value = '';
                document.getElementById('queryResults').style.display = 'none';
                document.getElementById('queryStats').style.display = 'none';
            }

            formatQuery() {
                const editor = document.getElementById('queryEditor');
                let query = editor.value;
                
                // Basic SQL formatting
                query = query
                    .replace(/\bSELECT\b/gi, 'SELECT')
                    .replace(/\bFROM\b/gi, '\nFROM')
                    .replace(/\bWHERE\b/gi, '\nWHERE')
                    .replace(/\bORDER BY\b/gi, '\nORDER BY')
                    .replace(/\bGROUP BY\b/gi, '\nGROUP BY')
                    .replace(/\bHAVING\b/gi, '\nHAVING')
                    .replace(/\bJOIN\b/gi, '\nJOIN')
                    .replace(/\bLEFT JOIN\b/gi, '\nLEFT JOIN')
                    .replace(/\bRIGHT JOIN\b/gi, '\nRIGHT JOIN')
                    .replace(/\bINNER JOIN\b/gi, '\nINNER JOIN');
                
                editor.value = query;
            }

            saveQuery() {
                const query = document.getElementById('queryEditor').value;
                if (!query.trim()) {
                    this.showNotification('No query to save', 'error');
                    return;
                }

                const blob = new Blob([query], { type: 'text/plain' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'query.sql';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
                
                this.showNotification('Query saved to file', 'success');
            }

            insertTemplate(template) {
                document.getElementById('queryEditor').value = template;
            }

            async viewTable(tableName) {
                const query = `SELECT * FROM \`${tableName}\` LIMIT 100;`;
                document.getElementById('queryEditor').value = query;
                this.executeQuery();
            }

            async describeTable(tableName) {
                const query = `DESCRIBE \`${tableName}\`;`;
                document.getElementById('queryEditor').value = query;
                this.executeQuery();
            }

            async exportTable(tableName) {
                try {
                    const response = await fetch(`backend/api/database/export/${tableName}`);
                    const result = await response.json();

                    if (result.status === 'success') {
                        const blob = new Blob([result.data], { type: 'text/csv' });
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = `${tableName}.csv`;
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                        URL.revokeObjectURL(url);
                        
                        this.showNotification(`Table ${tableName} exported successfully`, 'success');
                    } else {
                        throw new Error(result.message || 'Export failed');
                    }
                } catch (error) {
                    this.showNotification('Export failed: ' + error.message, 'error');
                }
            }

            showNotification(message, type = 'info') {
                const notification = document.getElementById('notification');
                notification.textContent = message;
                notification.className = `notification ${type}`;
                notification.classList.add('show');

                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }

            // Enhanced Tab Functionality
            switchTab(tabName) {
                // Remove active class from all tabs and panes
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                
                // Add active class to selected tab and pane
                document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
                document.getElementById(`${tabName}-tab`).classList.add('active');

                // Load content when switching to certain tabs
                if (tabName === 'table-data' && this.currentTable) {
                    document.getElementById('selectedTable').value = this.currentTable;
                    this.loadTableData();
                } else if (tabName === 'table-structure' && this.currentTable) {
                    document.getElementById('selectedTableStructure').value = this.currentTable;
                    this.loadTableStructure();
                }
            }

            // Enhanced Table Display
            displayTables(tables) {
                const tablesListBody = document.getElementById('tablesListBody');
                
                if (tables.length === 0) {
                    tablesListBody.innerHTML = '<div class="loading">No tables found</div>';
                    return;
                }

                const tablesHtml = tables.map(table => `
                    <div class="table-item" onclick="dbConnect.selectTable('${table.name}')">
                        <div class="table-name">${table.name}</div>
                        <div class="table-info">
                            <span>${table.rows} rows</span>
                            <span>${table.size_mb} MB</span>
                        </div>
                        <div class="table-actions">
                            <button class="table-action view" onclick="event.stopPropagation(); dbConnect.viewTable('${table.name}')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="table-action structure" onclick="event.stopPropagation(); dbConnect.describeTable('${table.name}')">
                                <i class="fas fa-info"></i>
                            </button>
                            <button class="table-action export" onclick="event.stopPropagation(); dbConnect.exportTable('${table.name}')">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                `).join('');

                tablesListBody.innerHTML = tablesHtml;
                
                // Update table selectors
                this.updateTableSelectors(tables);
            }

            updateTableSelectors(tables) {
                const tableSelect = document.getElementById('selectedTable');
                const structureSelect = document.getElementById('selectedTableStructure');
                
                const options = tables.map(table => 
                    `<option value="${table.name}">${table.name}</option>`
                ).join('');
                
                tableSelect.innerHTML = '<option value="">Select Table</option>' + options;
                structureSelect.innerHTML = '<option value="">Select Table</option>' + options;
            }

            selectTable(tableName) {
                this.currentTable = tableName;
                
                // Remove previous selection
                document.querySelectorAll('.table-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Add selection to clicked item
                event.currentTarget.classList.add('active');
                
                // Insert table name into query editor
                const queryEditor = document.getElementById('queryEditor');
                queryEditor.value = `SELECT * FROM \`${tableName}\` LIMIT 10;`;
                
                // Update table selectors
                document.getElementById('selectedTable').value = tableName;
                document.getElementById('selectedTableStructure').value = tableName;
                
                // Enable buttons
                document.getElementById('loadTableDataBtn').disabled = false;
                document.getElementById('loadStructureBtn').disabled = false;
                document.getElementById('addRowBtn').disabled = false;
                document.getElementById('addColumnBtn').disabled = false;
            }

            // Table Data Management
            async loadTableData() {
                const tableName = document.getElementById('selectedTable').value;
                if (!tableName) {
                    this.showNotification('Please select a table', 'warning');
                    return;
                }

                try {
                    const response = await fetch(`backend/api/database/table/${tableName}/data`);
                    const result = await response.json();

                    if (result.status === 'success') {
                        this.displayTableData(result.data);
                        this.showNotification('Table data loaded successfully', 'success');
                    } else {
                        this.showNotification(result.message || 'Failed to load table data', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error loading table data: ' + error.message, 'error');
                }
            }

            displayTableData(data) {
                const container = document.getElementById('tableDataContainer');
                
                if (Array.isArray(data) && data.length > 0) {
                    const columns = Object.keys(data[0]);
                    const tableHTML = `
                        <div class="table-data-header">
                            <span>${data.length} rows found</span>
                            <button class="btn btn-success" onclick="dbConnect.openAddRowModal()">
                                <i class="fas fa-plus"></i> Add Row
                            </button>
                        </div>
                        <div class="table-data-content">
                            <table class="results-table">
                                <thead>
                                    <tr>
                                        ${columns.map(col => `<th>${col}</th>`).join('')}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${data.map((row, index) => `
                                        <tr>
                                            ${columns.map(col => `<td>${row[col] || ''}</td>`).join('')}
                                            <td>
                                                <button class="btn btn-warning" onclick="dbConnect.editRow(${index})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" onclick="dbConnect.deleteRow(${index})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    `;
                    container.innerHTML = tableHTML;
                } else {
                    container.innerHTML = `
                        <div class="no-data">
                            <p>No data found in table</p>
                            <button class="btn btn-success" onclick="dbConnect.openAddRowModal()">
                                <i class="fas fa-plus"></i> Add First Row
                            </button>
                        </div>
                    `;
                }
            }

            // Table Structure Management
            async loadTableStructure() {
                const tableName = document.getElementById('selectedTableStructure').value;
                if (!tableName) {
                    this.showNotification('Please select a table', 'warning');
                    return;
                }

                try {
                    const response = await fetch(`backend/api/database/table/${tableName}/structure`);
                    const result = await response.json();

                    if (result.status === 'success') {
                        this.displayTableStructure(result.data);
                        this.showNotification('Table structure loaded successfully', 'success');
                    } else {
                        this.showNotification(result.message || 'Failed to load table structure', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error loading table structure: ' + error.message, 'error');
                }
            }

            displayTableStructure(data) {
                const container = document.getElementById('tableStructureContainer');
                
                if (Array.isArray(data) && data.length > 0) {
                    const tableHTML = `
                        <div class="table-structure-header">
                            <span>${data.length} columns found</span>
                            <button class="btn btn-success" onclick="dbConnect.openAddColumnModal()">
                                <i class="fas fa-plus"></i> Add Column
                            </button>
                        </div>
                        <table class="results-table">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Type</th>
                                    <th>Null</th>
                                    <th>Key</th>
                                    <th>Default</th>
                                    <th>Extra</th>
                                    <th>Comment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.map((column, index) => `
                                    <tr>
                                        <td>${column.field}</td>
                                        <td>${column.type}</td>
                                        <td>${column.null}</td>
                                        <td>${column.key}</td>
                                        <td>${column.default || ''}</td>
                                        <td>${column.extra}</td>
                                        <td>${column.comment || ''}</td>
                                        <td>
                                            <button class="btn btn-warning" onclick="dbConnect.editColumn('${column.field}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" onclick="dbConnect.deleteColumn('${column.field}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    `;
                    container.innerHTML = tableHTML;
                } else {
                    container.innerHTML = '<div class="no-data">No structure information available</div>';
                }
            }

            // Performance Analysis
            async loadPerformanceMetrics() {
                try {
                    const response = await fetch('backend/api/database/performance/metrics');
                    const result = await response.json();

                    if (result.status === 'success') {
                        this.displayPerformanceMetrics(result.data);
                        this.showNotification('Performance metrics loaded', 'success');
                    } else {
                        this.showNotification(result.message || 'Failed to load metrics', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error loading metrics: ' + error.message, 'error');
                }
            }

            displayPerformanceMetrics(data) {
                const container = document.getElementById('performanceContainer');
                container.innerHTML = `
                    <div class="performance-metrics">
                        <div class="metrics-grid">
                            <div class="metric-card">
                                <div class="metric-title">Query Cache Hit Rate</div>
                                <div class="metric-value">${data.query_cache_hit_rate || 'N/A'}%</div>
                            </div>
                            <div class="metric-card">
                                <div class="metric-title">Table Locks</div>
                                <div class="metric-value">${data.table_locks || 'N/A'}</div>
                            </div>
                            <div class="metric-card">
                                <div class="metric-title">Slow Queries</div>
                                <div class="metric-value">${data.slow_queries || 'N/A'}</div>
                            </div>
                            <div class="metric-card">
                                <div class="metric-title">Connections</div>
                                <div class="metric-value">${data.connections || 'N/A'}</div>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Visualization
            async loadERDiagram() {
                try {
                    const response = await fetch('backend/api/database/visualization/er-diagram');
                    const result = await response.json();

                    if (result.status === 'success') {
                        this.displayERDiagram(result.data);
                        this.showNotification('ER Diagram loaded', 'success');
                    } else {
                        this.showNotification(result.message || 'Failed to load ER diagram', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error loading ER diagram: ' + error.message, 'error');
                }
            }

            displayERDiagram(data) {
                const container = document.getElementById('visualizationContainer');
                container.innerHTML = `
                    <div class="er-diagram">
                        <div class="diagram-header">
                            <h3>Entity Relationship Diagram</h3>
                            <p>Database: ${data.database || 'Current'}</p>
                        </div>
                        <div class="diagram-content">
                            <div class="table-entities">
                                ${data.tables ? data.tables.map(table => `
                                    <div class="entity-box">
                                        <div class="entity-header">${table.name}</div>
                                        <div class="entity-fields">
                                            ${table.columns ? table.columns.map(col => `
                                                <div class="field ${col.key ? 'key' : ''}">${col.name} (${col.type})</div>
                                            `).join('') : ''}
                                        </div>
                                    </div>
                                `).join('') : '<p>No tables found</p>'}
                            </div>
                        </div>
                    </div>
                `;
            }

            // Quick Actions Management
            showQuickActions() {
                document.getElementById('quickActions').style.display = 'block';
            }

            hideQuickActions() {
                document.getElementById('quickActions').style.display = 'none';
            }

            // Modal Management
            showModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('show');
                    modal.style.display = 'flex';
                }
            }

            closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                }
            }

            // Complete CRUD Implementation
            openAddRowModal() {
                if (!this.currentTable) {
                    this.showNotification('Please select a table first', 'warning');
                    return;
                }
                this.loadTableStructureForModal(this.currentTable, 'add');
            }
            openAddColumnModal() {
                if (!this.currentTable) {
                    this.showNotification('Please select a table first', 'warning');
                    return;
                }
                this.showModal('addColumnModal');
            }

            editRow(index) {
                if (!this.currentTable) {
                    this.showNotification('Please select a table first', 'warning');
                    return;
                }
                // Get row data from the table
                const table = document.querySelector('#tableDataContainer table tbody');
                if (table && table.children[index]) {
                    const row = table.children[index];
                    const cells = row.querySelectorAll('td');
                    const rowData = {};
                    
                    // Get column headers
                    const headers = document.querySelectorAll('#tableDataContainer table thead th');
                    cells.forEach((cell, i) => {
                        if (headers[i] && headers[i].textContent !== 'Actions') {
                            rowData[headers[i].textContent] = cell.textContent;
                        }
                    });
                    
                    this.editRowData = { index, data: rowData };
                    this.loadTableStructureForModal(this.currentTable, 'edit', rowData);
                }
            }

            deleteRow(index) {
                if (!this.currentTable) {
                    this.showNotification('Please select a table first', 'warning');
                    return;
                }
                
                // Get row ID from the table
                const table = document.querySelector('#tableDataContainer table tbody');
                if (table && table.children[index]) {
                    const row = table.children[index];
                    const cells = row.querySelectorAll('td');
                    const idCell = cells[0]; // Assuming first column is ID
                    
                    this.deleteRowData = { index, id: idCell.textContent };
                    this.showDeleteConfirm(`row with ID ${idCell.textContent}`, () => this.performDeleteRow());
                }
            }
            editColumn(columnName) { this.showNotification('Edit Column functionality coming soon!', 'info'); }
            deleteColumn(columnName) { this.showNotification('Delete Column functionality coming soon!', 'info'); }
            loadRecommendations() { this.showNotification('Performance recommendations coming soon!', 'info'); }
            analyzeQuery() { this.showNotification('Query analysis coming soon!', 'info'); }
            loadSchemaMap() { this.showNotification('Schema map coming soon!', 'info'); }
            exportDocumentation() { this.showNotification('Documentation export coming soon!', 'info'); }
            openCreateTableModal() { this.showNotification('Create Table functionality coming soon!', 'info'); }
            exportAllTables() { this.showNotification('Export All Tables coming soon!', 'info'); }
            optimizeAllTables() { this.showNotification('Optimize All Tables coming soon!', 'info'); }
            createBackup() { this.showNotification('Backup functionality coming soon!', 'info'); }

            // Helper Methods for CRUD Operations
            async loadTableStructureForModal(tableName, action, rowData = null) {
                try {
                    const response = await fetch(`backend/api/database/table/${tableName}/structure`);
                    const result = await response.json();

                    if (result.status === 'success') {
                        const fieldsContainer = action === 'add' ? 'addRowFields' : 'editRowFields';
                        const modalId = action === 'add' ? 'addRowModal' : 'editRowModal';
                        
                        this.generateFormFields(result.data, fieldsContainer, rowData);
                        this.showModal(modalId);
                    } else {
                        this.showNotification(result.message || 'Failed to load table structure', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error loading table structure: ' + error.message, 'error');
                }
            }

            generateFormFields(columns, containerId, rowData = null) {
                const container = document.getElementById(containerId);
                container.innerHTML = '';

                columns.forEach(column => {
                    const fieldDiv = document.createElement('div');
                    fieldDiv.className = 'form-group';

                    const label = document.createElement('label');
                    label.textContent = column.field;
                    if (column.null === 'NO') label.textContent += ' *';

                    const input = document.createElement('input');
                    input.type = this.getInputType(column.type);
                    input.name = column.field;
                    input.className = 'form-control';
                    input.required = column.null === 'NO';

                    if (rowData && rowData[column.field]) {
                        input.value = rowData[column.field];
                    }

                    fieldDiv.appendChild(label);
                    fieldDiv.appendChild(input);
                    container.appendChild(fieldDiv);
                });
            }

            getInputType(columnType) {
                const type = columnType.toLowerCase();
                if (type.includes('int') || type.includes('decimal')) return 'number';
                if (type.includes('date')) return 'date';
                if (type.includes('time')) return 'time';
                if (type.includes('datetime')) return 'datetime-local';
                if (type.includes('text')) return 'textarea';
                return 'text';
            }

            async saveNewRow() {
                const form = document.getElementById('addRowForm');
                const formData = new FormData(form);
                const data = Object.fromEntries(formData);

                try {
                    const response = await fetch(`backend/api/database/table/${this.currentTable}/row`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();
                    if (result.status === 'success') {
                        this.showNotification('Row added successfully', 'success');
                        this.closeModal('addRowModal');
                        this.loadTableData();
                    } else {
                        this.showNotification(result.message || 'Failed to add row', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error adding row: ' + error.message, 'error');
                }
            }

            async updateRow() {
                if (!this.editRowData) return;

                const form = document.getElementById('editRowForm');
                const formData = new FormData(form);
                const data = Object.fromEntries(formData);

                try {
                    const response = await fetch(`backend/api/database/table/${this.currentTable}/row/${this.editRowData.data.id}`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();
                    if (result.status === 'success') {
                        this.showNotification('Row updated successfully', 'success');
                        this.closeModal('editRowModal');
                        this.loadTableData();
                    } else {
                        this.showNotification(result.message || 'Failed to update row', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error updating row: ' + error.message, 'error');
                }
            }

            async performDeleteRow() {
                if (!this.deleteRowData) return;

                try {
                    const response = await fetch(`backend/api/database/table/${this.currentTable}/row/${this.deleteRowData.id}`, {
                        method: 'DELETE'
                    });

                    const result = await response.json();
                    if (result.status === 'success') {
                        this.showNotification('Row deleted successfully', 'success');
                        this.closeModal('deleteConfirmModal');
                        this.loadTableData();
                    } else {
                        this.showNotification(result.message || 'Failed to delete row', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error deleting row: ' + error.message, 'error');
                }
            }

            async saveNewColumn() {
                const data = {
                    name: document.getElementById('columnName').value,
                    type: document.getElementById('columnType').value,
                    default: document.getElementById('columnDefault').value,
                    null: document.getElementById('columnNull').checked
                };

                try {
                    const response = await fetch(`backend/api/database/table/${this.currentTable}/column`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();
                    if (result.status === 'success') {
                        this.showNotification('Column added successfully', 'success');
                        this.closeModal('addColumnModal');
                        this.loadTableStructure();
                    } else {
                        this.showNotification(result.message || 'Failed to add column', 'error');
                    }
                } catch (error) {
                    this.showNotification('Error adding column: ' + error.message, 'error');
                }
            }

            showDeleteConfirm(message, callback) {
                document.getElementById('deleteConfirmMessage').textContent = `Are you sure you want to delete ${message}?`;
                this.deleteCallback = callback;
                this.showModal('deleteConfirmModal');
            }

            confirmDelete() {
                if (this.deleteCallback) {
                    this.deleteCallback();
                }
            }

            openCreateTableModal() {
                this.showModal('createTableModal');
            }

            addTableColumn() {
                const container = document.getElementById('tableColumns');
                const columnDiv = document.createElement('div');
                columnDiv.className = 'column-definition';
                columnDiv.innerHTML = `
                    <input type="text" placeholder="Column Name" class="form-control" required>
                    <select class="form-control">
                        <option value="INT">INT</option>
                        <option value="VARCHAR(255)">VARCHAR(255)</option>
                        <option value="TEXT">TEXT</option>
                        <option value="DATETIME">DATETIME</option>
                        <option value="DECIMAL(10,2)">DECIMAL(10,2)</option>
                    </select>
                    <label><input type="checkbox"> Primary Key</label>
                    <label><input type="checkbox"> Auto Increment</label>
                    <label><input type="checkbox"> Not Null</label>
                    <button type="button" class="btn btn-danger" onclick="removeColumn(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                container.appendChild(columnDiv);
            }

            removeColumn(button) {
                button.parentElement.remove();
            }
        }

        // Global functions for modal interactions
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
            }
        }

        function saveNewRow() {
            dbConnect.saveNewRow();
        }

        function updateRow() {
            dbConnect.updateRow();
        }

        function saveNewColumn() {
            dbConnect.saveNewColumn();
        }

        function confirmDelete() {
            dbConnect.confirmDelete();
        }

        function addTableColumn() {
            dbConnect.addTableColumn();
        }

        function removeColumn(button) {
            dbConnect.removeColumn(button);
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.password-toggle i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleButton.className = 'fas fa-eye';
            }
        }

        // Initialize the application
        const dbConnect = new DBConnect();
    </script>
</body>
</html>
