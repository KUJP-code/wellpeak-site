# Wordpress for WELLPEAK

This repository tracks only **custom code** for the Wellpeak site:
- Theme: `wp-content/themes/wellpeak-site`
- Plugin: `wp-content/plugins/wellpeak-forms`

All WordPress core files, media uploads, and database content are **not** version-controlled.

## Local setup

1. Install a fresh WordPress instance locally
2. Copy this repo’s `wp-content/` into your WordPress install.
3. In WP Admin:
   - Activate **Wellpeak Site** under *Appearance → Themes*.
   - Activate **Wellpeak Forms** under *Plugins*.
4. Add content (pages, posts, media) directly via WP Admin.
5. For a decent developer experience, make a local site with LocalWP and link your repo's wp-content to that directory for hot reloading.

## Workflow

- **GitHub**: Track theme & plugin changes here.
- **Staging WordPress**: Add/edit content and upload media. (to be added soon)

## deploy
Sync only 'wp-content/themes/wellpeak-site' and 'wp-content/plugins' to the server.

## Authors
- https://github.com/jaysonpye
- https://github.com/f-michael-95
