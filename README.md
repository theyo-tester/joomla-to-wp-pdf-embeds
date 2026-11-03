# Joomla to WP PDF Embeds for WordPress

A lightweight WordPress plugin designed to seamlessly render legacy Joomla PDF tags (`{pdf}...{/pdf}`) as responsive PDF iframe embeds—**without requiring database modifications or manual post edits.**

## Overview

When migrating articles containing embedded documents from Joomla to WordPress, legacy plugin syntax (such as `{pdf}/storage/documents/sample.pdf|height:600{/pdf}`) often breaks. 

This plugin dynamically intercepts content during WordPress rendering, parses any custom height/width parameters, and outputs a clean, accessible iframe embed.

## Features

- **Zero Database Changes:** Keeps imported post content clean and untouched.
- **Universal View Support:** Works seamlessly across single posts, homepages, category archives, and blog list loops.
- **Parameter Support:** Handles custom height and width settings passed through pipe delimiters (e.g., `|height:500|width:100%`).
- **Secure Handling:** Validates URLs and sanitizes attributes for safe output.

## Example Syntax

### Legacy Joomla Tag (In Post Content):
```text
{pdf}/storage/2026/document.pdf|height:500|width:100%{/pdf}
```

## Installation

The easiest way to install the plugin is by downloading the pre-built release package:

1. Go to the [Releases](https://github.com/theyo-tester/joomla-to-wp-pdf-embeds/releases) page of this repository and download the latest `.zip` release file.
2. Log in to your WordPress Admin dashboard.
3. Navigate to **Plugins > Add New** (or **Plugins > Add New Plugin** depending on your WordPress version).
4. Click the **Upload Plugin** button at the top of the screen.
5. Choose the downloaded `.zip` file, click **Install Now**, and then click **Activate**.

*(Alternatively, you can manually upload the plugin folder to your `/wp-content/plugins/` directory via FTP/SFTP and activate it from your plugins screen).*

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
