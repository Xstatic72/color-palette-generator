<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Palette Generator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            background-color: #f5f5f5;
        }
        
        .input-group {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .color-input {
            padding: 12px 20px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            width: 200px;
            text-align: center;
        }

        .color-input:focus {
            outline: none;
            border-color: #333;
        }

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            display: none;
        }

        .generate-btn {
            padding: 15px 30px;
            font-size: 16px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .generate-btn:hover {
            background-color: #555;
        }
        
        .colors-container {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .color-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 120px;
        }
        
        .color-box {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            border: 2px solid #ddd;
            margin-bottom: 10px;
        }
        
        .hex-value {
            font-size: 14px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form method="POST" action="/color-palette" id="colorForm">
        @csrf
        <div class="input-group">
            <input 
                type="number" 
                name="total_colors" 
                class="color-input" 
                placeholder="Number of colors (1-200)" 
                min="1" 
                max="200" 
                value="5"
                required
            >
            <span class="error-message" id="errorMessage">Please enter a number between 1 and 200</span>
            <button type="submit" class="generate-btn">Generate color palette</button>
        </div>
    </form>

    <script>
        document.getElementById('colorForm').addEventListener('submit', function(e) {
            const input = document.querySelector('input[name="total_colors"]');
            const errorMessage = document.getElementById('errorMessage');
            const value = parseInt(input.value);

            if (isNaN(value) || value < 1 || value > 200) {
                e.preventDefault();
                errorMessage.style.display = 'block';
                input.style.borderColor = '#e74c3c';
            } else {
                errorMessage.style.display = 'none';
                input.style.borderColor = '#ddd';
            }
        });

        document.querySelector('input[name="total_colors"]').addEventListener('input', function() {
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.style.display = 'none';
            this.style.borderColor = '#ddd';
        });
    </script>
    
    @if(isset($colors))
        <div class="colors-container">
            @foreach($colors as $color)
                <div class="color-card">
                    <div class="color-box" style="background-color: {{ $color }};"></div>
                    <span class="hex-value">{{ $color }}</span>
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>
