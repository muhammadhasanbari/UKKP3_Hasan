<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f7fa;
        min-height: 100vh;
        color: #333;
    }
    .container { max-width: 900px; margin: 0 auto; padding: 0 20px; }

    .navbar {
        background-color: #2c3e50;
        padding: 12px 0;
        border-bottom: 2px solid #34495e;
    }
    .navbar .container { display: flex; align-items: center; justify-content: space-between; }
    .brand { color: #fff; font-size: 1.3rem; font-weight: bold; text-decoration: none; }
    .brand span { color: #3498db; }
    .nav-user { display: flex; align-items: center; gap: 12px; color: #ecf0f1; font-size: .95rem; }
    .badge { display: inline-block; padding: 4px 10px; border-radius: 4px; font-size: .8rem; font-weight: bold; text-transform: uppercase; }
    .badge-user { background-color: #27ae60; color: #fff; }
    .badge-admin { background-color: #e74c3c; color: #fff; }

    .auth-wrap { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px); padding: 30px 0; }
    .card { background: #fff; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,.1); width: 100%; max-width: 400px; border: 1px solid #ddd; }
    .card-header { padding: 24px 24px 12px; text-align: center; }
    .card-header h1 { font-size: 1.4rem; color: #2c3e50; margin-bottom: 4px; }
    .card-header p { font-size: .9rem; color: #666; }
    .card-body { padding: 18px 24px 28px; }
    .form-group { margin-bottom: 14px; }
    .form-group label { display: block; font-size: .9rem; font-weight: bold; color: #333; margin-bottom: 6px; }
    .form-group input[type=text], .form-group input[type=password] {
        width: 100%; padding: 9px 10px; border: 1px solid #bbb; border-radius: 4px; font-size: .95rem;
    }
    .form-group input:focus { outline: none; border-color: #3498db; }
    .check { display: flex; align-items: center; gap: 6px; font-size: .9rem; color: #333; margin-bottom: 16px; }
    .btn { width: 100%; padding: 10px; border: none; border-radius: 4px; font-size: 1rem; font-weight: bold; cursor: pointer; }
    .btn-primary { background-color: #3498db; color: #fff; }
    .btn-primary:hover { background-color: #2980b9; }
    .btn-sm { width: auto; padding: 7px 14px; font-size: .9rem; }
    .alert { padding: 9px 12px; border-radius: 4px; font-size: .9rem; margin-bottom: 14px; border: 1px solid; }
    .alert-error { background-color: #fdf2f2; color: #c0392b; border-color: #e74c3c; }
    .alert-success { background-color: #f3fff7; color: #27ae60; border-color: #2ecc71; }
    .text-danger { color: #e74c3c; font-size: .85rem; }

    .shell { display: flex; min-height: calc(100vh - 54px); }
    .sidebar { width: 220px; background-color: #2c3e50; padding: 18px 10px; }
    .side-title { color: #7f8c8d; font-size: .75rem; text-transform: uppercase; margin: 14px 8px 6px; }
    .side-link { display: flex; gap: 8px; align-items: center; padding: 9px 12px; color: #ecf0f1; text-decoration: none; border-radius: 4px; margin-bottom: 4px; font-size: .95rem; }
    .side-link:hover { background-color: #34495e; }
    .side-link.active { background-color: #3498db; color: #fff; }
    .main { flex: 1; background-color: #f5f7fa; }
    .content { padding: 26px 30px; max-width: 1000px; }
    .content h1 { color: #2c3e50; font-size: 1.6rem; margin-bottom: 4px; }
    .content .subtitle { color: #666; margin-bottom: 22px; }
    .panel { background: #fff; border: 1px solid #ddd; border-radius: 4px; padding: 18px; margin-bottom: 16px; }
    .panel h2 { font-size: 1.1rem; color: #2c3e50; margin-bottom: 10px; }
    .panel p, .panel li { color: #444; line-height: 1.6; }
    .info-row { display: flex; justify-content: space-between; padding: 7px 0; border-bottom: 1px solid #eee; }
    .info-row:last-child { border-bottom: none; }
    .info-row .label { color: #666; }
    .info-row .value { font-weight: bold; color: #333; }
</style>
