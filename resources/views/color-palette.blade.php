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
        
        .generate-btn {
            margin-top: 40px;
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
    <form method="POST" action="/color-palette">
        @csrf
        <button type="submit" class="generate-btn">Generate color palette</button>
    </form>
    
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
