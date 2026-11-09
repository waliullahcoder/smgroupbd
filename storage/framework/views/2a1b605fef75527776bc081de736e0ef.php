<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | <?php echo e($admin_setting->title ?? 'HRM'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style>
    :root {
        --ink: #0f172a;
        --muted: #64748b;
        --line: #e2e8f0;
        --brand: #2563eb;
        --brand-dark: #1d4ed8;
        --bg: #f1f5f9;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Roboto, system-ui, sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px 16px;
        color: var(--ink);
        background:
            radial-gradient(900px 500px at 10% -10%, #dbeafe 0%, transparent 60%),
            radial-gradient(800px 500px at 110% 110%, #e0e7ff 0%, transparent 60%),
            var(--bg);
    }

    .page {
        width: 100%;
        max-width: 400px;
    }

    .logo-box {
        text-align: center;
        margin-bottom: 22px;
    }

    .logo-box img {
        max-width: 190px;
        max-height: 90px;
        object-fit: contain;
    }

    .login-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 20px;
        padding: 32px 28px 28px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, .08);
    }

    .login-card h2 {
        font-size: 24px;
        font-weight: 700;
        text-align: center;
    }

    .subtitle {
        text-align: center;
        color: var(--muted);
        font-size: 14px;
        margin: 6px 0 26px;
    }

    .field {
        position: relative;
        margin-bottom: 14px;
    }

    .field .form-control {
        height: 50px;
        border-radius: 12px;
        border: 1px solid var(--line);
        background: #f8fafc;
        padding: 0 46px;
        font-size: 15px;
        transition: .2s;
    }

    .field .form-control:focus {
        background: #fff;
        border-color: var(--brand);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
    }

    .field .form-control::placeholder {
        color: #94a3b8;
    }

    .field .icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 16px;
        pointer-events: none;
        transition: .2s;
    }

    .field .form-control:focus~.icon {
        color: var(--brand);
    }

    .field .eye {
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        width: 38px;
        height: 38px;
        border: none;
        background: none;
        color: #94a3b8;
        border-radius: 10px;
        cursor: pointer;
    }

    .field .eye:hover {
        color: var(--ink);
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #475569;
        margin: 6px 0 20px;
        cursor: pointer;
    }

    .remember input {
        width: 17px;
        height: 17px;
        accent-color: var(--brand);
    }

    .login-btn {
        width: 100%;
        height: 50px;
        border: none;
        border-radius: 12px;
        background: var(--brand);
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: .2s;
    }

    .login-btn:hover {
        background: var(--brand-dark);
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(37, 99, 235, .3);
    }

    .login-btn:focus-visible {
        outline: 3px solid rgba(37, 99, 235, .35);
        outline-offset: 2px;
    }

    .alert {
        border-radius: 12px;
        font-size: 14px;
        margin-bottom: 16px;
    }

    .footer {
        text-align: center;
        color: var(--muted);
        font-size: 13px;
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <div class="page">

        <div class="logo-box">
            <img src="<?php echo e(asset(@$admin_setting->logo)); ?>" alt="<?php echo e(@$admin_setting->title); ?>">
        </div>

        <div class="login-card">

            <h2>Admin Login</h2>
            <p class="subtitle">Sign in to continue to your dashboard</p>

            <form method="POST" action="<?php echo e(route('admin.login')); ?>">
                <?php echo csrf_field(); ?>

                <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                <?php endif; ?>

                <div class="field">
                    <input type="text" name="user_name" class="form-control" placeholder="Username or mobile number"
                        value="<?php echo e(old('user_name')); ?>" required autofocus>
                    <i class="fas fa-user icon"></i>
                </div>

                <div class="field">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required>
                    <i class="fas fa-lock icon"></i>
                    <button type="button" class="eye" id="togglePassword" aria-label="Show password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <label class="remember">
                    <input type="checkbox" name="remember"> Remember me
                </label>

                <button type="submit" class="login-btn">
                    <i class="fas fa-right-to-bracket"></i>
                    Login
                </button>
            </form>

        </div>

        <div class="footer">
            © <?php echo e(date('Y')); ?> <?php echo e(@$admin_setting->title); ?>

        </div>

    </div>

    <script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function() {
        const show = password.type === 'password';
        password.type = show ? 'text' : 'password';
        toggle.innerHTML = show ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
    });
    </script>

</body>

</html><?php /**PATH E:\laragon\www\smgroupbd\resources\views/auth/login.blade.php ENDPATH**/ ?>