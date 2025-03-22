<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html(get_option('soonish_title', 'Coming Soon')); ?></title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }
        <?php
        $background = get_option('soonish_background', 'gradient-purple');
        switch ($background) {
            case 'gradient-purple':
                echo 'body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }';
                break;
            case 'gradient-blue':
                echo 'body { background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%); }';
                break;
            case 'gradient-green':
                echo 'body { background: linear-gradient(135deg, #134E5E 0%, #71B280 100%); }';
                break;
            case 'solid-dark':
                echo 'body { background: #1a1a1a; }';
                break;
            case 'solid-light':
                echo 'body { background: #f5f5f5; color: #333; }';
                break;
        }
        ?>
        .container {
            text-align: center;
            padding: 2rem;
            max-width: 600px;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        #countdown {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }
        .countdown-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 8px;
            min-width: 80px;
        }
        .countdown-number {
            font-size: 2rem;
            font-weight: bold;
        }
        .countdown-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        <?php if ($background === 'solid-light'): ?>
        .countdown-item {
            background: rgba(0, 0, 0, 0.05);
        }
        <?php endif; ?>
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo esc_html(get_option('soonish_title', 'Coming Soon')); ?></h1>
        <p><?php echo esc_html(get_option('soonish_description', 'We are working on something awesome. Stay tuned!')); ?></p>
        
        <?php if (get_option('soonish_launch_date')): ?>
        <div id="countdown">
            <div class="countdown-item">
                <div class="countdown-number" id="days">0</div>
                <div class="countdown-label">Days</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="hours">0</div>
                <div class="countdown-label">Hours</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="minutes">0</div>
                <div class="countdown-label">Minutes</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="seconds">0</div>
                <div class="countdown-label">Seconds</div>
            </div>
        </div>

        <script>
        function updateCountdown() {
            const launchDate = new Date('<?php echo esc_js(get_option('soonish_launch_date')); ?>').getTime();
            const now = new Date().getTime();
            const distance = launchDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = days;
            document.getElementById('hours').textContent = hours;
            document.getElementById('minutes').textContent = minutes;
            document.getElementById('seconds').textContent = seconds;

            if (distance < 0) {
                clearInterval(countdownTimer);
                document.getElementById('countdown').innerHTML = '<p>Launch time!</p>';
            }
        }

        const countdownTimer = setInterval(updateCountdown, 1000);
        updateCountdown();
        </script>
        <?php endif; ?>
    </div>
</body>
</html>
