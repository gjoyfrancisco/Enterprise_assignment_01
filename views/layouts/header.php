<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Information Management</title>
    <style>
        /* ---- Reset & Base ---- */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            color: #333;
            min-height: 100vh;
        }

        /* ---- Navbar ---- */
        nav {
            background: #68623b;
            color: #fff;
            padding: 0 24px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,.2);
        }

        nav .brand {
            font-size: 1.15rem;
            font-weight: 600;
            letter-spacing: .5px;
        }

        nav .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-size: .92rem;
            opacity: .9;
            transition: opacity .2s;
        }

        nav .nav-links a:hover { opacity: 1; text-decoration: underline; }

        /* ---- Main Container ---- */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 16px;
        }

        /* ---- Card ---- */
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 6px rgba(0,0,0,.12);
            padding: 32px;
        }

        .card h2 {
            margin-bottom: 24px;
            font-size: 1.35rem;
            color: #68623b;
        }

        /* ---- Alerts ---- */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: .9rem;
        }

        .alert-error   { background: #fdecea; color: #c0392b; border: 1px solid #f5b7b1; }
        .alert-success { background: #e8f5e9; color: #27ae60; border: 1px solid #a9dfbf; }

        /* ---- Forms ---- */
        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: .88rem;
            font-weight: 600;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: .95rem;
            transition: border-color .2s;
            outline: none;
        }

        .form-group input:focus { border-color: #1a73e8; box-shadow: 0 0 0 3px rgba(26,115,232,.15); }

        /* ---- Buttons ---- */
        .btn {
            display: inline-block;
            padding: 10px 22px;
            border: none;
            border-radius: 6px;
            font-size: .92rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, transform .1s;
        }

        .btn:active { transform: scale(.98); }

        .btn-primary   { background: #68623b; color: #fff; }
        .btn-primary:hover { background: #d4b800; }

        .btn-danger    { background: #e53935; color: #fff; }
        .btn-danger:hover  { background: #c62828; }

        .btn-secondary { background: #eee; color: #333; }
        .btn-secondary:hover { background: #ddd; }

        .btn-sm { padding: 6px 14px; font-size: .82rem; }

        /* ---- Table ---- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        th, td {
            padding: 12px 14px;
            text-align: left;
            font-size: .9rem;
        }

        thead th {
            background: #f6f8fc;
            font-weight: 700;
            color: #ecd122;
            border-bottom: 2px solid #dce3f0;
        }

        tbody tr { border-bottom: 1px solid #eee; }
        tbody tr:hover { background: #fafbff; }

        /* ---- Auth link text ---- */
        .auth-link { margin-top: 18px; font-size: .87rem; color: #666; }
        .auth-link a { color: #68623b; }

        /* ---- Table actions row ---- */
        .table-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .table-actions h2 { margin-bottom: 0; }
    </style>
</head>
<body>
