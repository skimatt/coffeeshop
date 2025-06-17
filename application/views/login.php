<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts for a vibrant, coffee-inspired font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            display: flex;
            overflow: hidden;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }
        .login-box {
            padding: 2.5rem;
            width: 50%;
        }
        .image-box {
            width: 50%;
            background: url('<?php echo base_url('assets/img/logo.png'); ?>') no-repeat center center;
            background-size: cover;
            border-radius: 0 20px 20px 0;
        }
        .btn-coffee {
            background: linear-gradient(90deg, #F4A261, #E76F51);
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .btn-coffee:hover {
            background: linear-gradient(90deg, #E76F51, #F4A261);
            transform: scale(1.05);
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: #E76F51;
            box-shadow: 0 0 0 3px rgba(231, 111, 81, 0.2);
        }
        .title {
            font-family: 'Playfair Display', serif;
            color: #2A2A2A;
        }
        .alert {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 640px) {
            .login-container {
                flex-direction: column;
            }
            .login-box, .image-box {
                width: 100%;
            }
            .image-box {
                height: 200px;
                border-radius: 0 0 20px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2 class="title text-3xl font-bold text-center mb-6">Coffee Omwari</h2>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php echo form_open('welcome/login', ['class' => 'space-y-6']); ?>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" class="input-field mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-opacity-50" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="input-field mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-opacity-50" required>
                </div>
                <button type="submit" class="btn-coffee w-full py-3 px-4 rounded-lg text-white font-semibold text-lg">Login</button>
            <?php echo form_close(); ?>
        </div>
        <div class="image-box"></div>
    </div>
</body>
</html>