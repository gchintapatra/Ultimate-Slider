## 1. Plugin Overview
Ultimate Swiper Slider is a fully responsive WordPress slider plugin that is:

- Elementor compatible (optional)
- Page-level asset loading optimized
- Fully secure and WordPress-standard compliant
- Admin-friendly with a complete settings panel
- Supports theme/child-theme overrides
- Clean uninstall functionality
- Works even if Elementor is not installed, using shortcode [ultimate_slider] or Gutenberg block

## 2. Plugin Folder Structure

ultimate-swiper-slider/
├── ultimate-swiper-slider.php          # Main plugin bootstrap file
├── uninstall.php                       # Safe uninstall script
├── includes/                           # Core PHP includes
│   ├── defaults.php                    # Default plugin settings
│   ├── functions.php                   # Core helper functions, enqueue, theme override detection
│   ├── slider-render.php               # Shortcode and rendering functions
│   └── admin-settings.php              # Admin options page
├── assets/                             # CSS & JS assets
│   ├── slider.css                       # Default plugin CSS
│   └── swiper-init.js                   # JS to initialize Swiper
├── elementor/                           # Elementor widget (optional)
│   └── slider-widget.php                # Elementor widget PHP
└── README.md                            # Complete plugin documentation

# Optional Theme Override (inside active theme)
wp-content/themes/your-active-theme/ultimate-swiper-slider/
├── config.php                          # Optional: theme override for plugin settings
└── slider.css                           # Optional: theme override for slider CSS
