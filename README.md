# ASCII Art Tools (PHP) (EN)

A set of PHP scripts for working with ASCII art.  
Includes both **browser-based** and **terminal-based** tools.  
All scripts use the **GD** library.

---

## Browser Scripts

### 1. `image_to_ascii.php`
- Loads an image and displays it as ASCII directly in the browser.
- Supports formats: **JPEG, PNG, GIF**.
- Adjustable number of columns (ASCII width).

**Run:**
```bash
php -S localhost:8000   
```

Then open in browser:
http://localhost:8000/image_to_ascii.php

### 2. `image_to_ascii_color.php`
Same as   `image_to_ascii.php`, but with colored ASCII (each character is colored to match the pixel).

**Run:**
```bash
php -S localhost:8000
```

Then open in browser:
http://localhost:8000/image_to_ascii_color.php

## Terminal Script

### 3. ascii_to_image.php
- Takes an image and saves the result as an **ASCII PNG file**.
- Each character is colored according to the pixel color.
- Requires a monospaced font (e.g., `DejaVuSansMono.ttf`) placed in the project folder.

**Run:**
```bash
php ascii_to_image.php
```

The output will be saved as `ascii.png`

## Configuration

You can change the following parameters in the scripts:
- `file` - source image name.
- `output` - output file name (`ascii_to_image.php`).
- `cols` - number of ASCII colummns.
- `chars` - character set used for ASCII.
- `fontSize`, `charW`, `charH` - font settings for ASCII-to-image generation.

## Installation

1. Make sure PHP (>=8.x) with GD extension is installed:
```bash
php -v
```
2. Clone the repository:
```bash
git clone https://github.com/your-username/ascii-art-tools.git
cd ascii-art-tools
```
3. For `ascii_to_image.php`, place a monospaced .ttf font in the project folder. (Default set DejaVuSansMono.ttf)
4. Run:
   - Browser scripts → `php -S localhost:8000` and open the desired `.php` file in your browser.
   - Terminal script → `php ascii_to_image.php`.

## Examples
- ASCII in browser (black & white):
<img width="493" height="796" alt="Screenshot 2025-09-21 at 20 18 16" src="https://github.com/user-attachments/assets/f4a8641a-bbae-4fba-9c1e-88359cfa46ab" />

- ASCII in browser (colored):
<img width="493" height="796" alt="Screenshot 2025-09-21 at 20 18 29" src="https://github.com/user-attachments/assets/cf2d295a-b1b1-4405-bb95-232915fc58ed" />

- ASCII saved as PNG:
<img width="1600" height="2364" alt="ascii" src="https://github.com/user-attachments/assets/5dafd6ec-3af1-48c9-9a9d-044d916fe7fc" />

## License
MIT - free to use and modify!
