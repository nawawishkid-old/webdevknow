# Hooks

## Action Hooks
| Functions | Hook | Description |
| --- | --- | --- |
| `register_sidebar` | `widgets_init` | Register area for widgets |
| `add_theme_support` | `after_setup_theme` | Allow user to modify specific part of the theme |
| `register_nav_menu` | `after_setup_theme` | Register area for nav menu |
| `load_theme_textdomain` | `after_setup_theme` | Load theme localization |
| `add_editor_style` | `after_setup_theme` | Add style to text editor for consistent design |
| `add_image_size` | `after_setup_theme` | |
| `wp_enqueue_style` | `wp_enqueue_scripts` | Add CSS `<link>` in document's head |
| `wp_enqueue_script` | `wp_enqueue_scripts` | Add JS `<script>` in document's footer |


## Filter Hooks